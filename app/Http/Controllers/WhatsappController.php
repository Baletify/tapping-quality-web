<?php

namespace App\Http\Controllers;

use Exception;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Models\AssessmentDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;

class WhatsappController extends Controller
{
    public function sendMessage(Request $request)
    {
        $creds = DB::table('assessment_details')->leftJoin('tappers', 'assessment_details.nik_penyadap', '=', 'tappers.nik')
            ->where('assessment_details.assessment_code', $request->assessment_code)
            ->select('assessment_details.*', 'tappers.name as tapper_name', 'tappers.nik as tapper_nik', 'tappers.no_hp as tapper_phone')
            ->first();
        // dd($creds, $request->all());

        $to = 'whatsapp:' . $creds->tapper_phone;
        $message = "Ini adalah pesan otomatis dari Aplikasi QA\n\n" .
            "Halo {$creds->tapper_name},\n" .
            "Berikut adalah hasil penilaian yang dilakukan pada tanggal {$creds->tanggal_inspeksi}\n" .
            "Inspeksi Oleh: {$creds->inspection_by}\n" .
            "Panel Sadap: {$creds->panel_sadap}\n\n" .
            "Total Nilai: {$request->total_score}\n" .
            "Kelas Sadap: {$request->kelas}\n\n" .
            "Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.\n\n" .
            "Salam,\n\n" .
            "Tim QA";
        $token = config('services.fonnte.token');
        if (!$token) {
            flash()->error('Token Fonnte tidak ditemukan. Silakan periksa konfigurasi.');
            return redirect()->back()->with('error', 'Token Fonnte tidak ditemukan. Silakan periksa konfigurasi.');
        }

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $creds->tapper_phone, // Remove 'whatsapp:' prefix for Fonnte
                    'message' => $message,
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $token,
                ),
            ));

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            // Parse the response
            $responseData = json_decode($response, true);

            Log::info('Fonnte Send Response:', [
                'http_code' => $httpCode,
                'response' => $responseData,
                'target' => $creds->tapper_phone,
                'assessment_code' => $request->assessment_code
            ]);

            if ($httpCode === 200 && isset($responseData['status']) && $responseData['status'] === true) {
                // Message sent successfully
                $messageId = $responseData['id'] ?? null;

                // Fix: Handle array or string message ID
                if (is_array($messageId)) {
                    $messageId = $messageId[0]; // Get first element if it's an array
                }

                try {
                    // Store message tracking info
                    DB::table('whatsapp_messages')->insert([
                        'message_id' => (string) $messageId, // Cast to string
                        'assessment_code' => (string) $request->assessment_code,
                        'target_phone' => (string) $creds->tapper_phone,
                        'tapper_name' => (string) $creds->tapper_name,
                        'message_content' => (string) $message,
                        'status' => 'sent',
                        'sent_at' => now(),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    Log::info("Message stored in database with ID: {$messageId}");

                    Notification::make()
                        ->title('✅ Pesan Berhasil Dikirim')
                        ->body("Pesan terkirim ke {$creds->tapper_name} (ID: {$messageId})")
                        ->success()
                        ->send();

                    return redirect()->back()->with('success', "Pesan berhasil dikirim! Message ID: {$messageId}");
                } catch (Exception $e) {
                    Log::error('Database insert failed:', [
                        'error' => $e->getMessage(),
                        'message_id' => $messageId,
                        'assessment_code' => $request->assessment_code,
                        'trace' => $e->getTraceAsString()
                    ]);

                    // Still show success for message sending, but log database error
                    Notification::make()
                        ->title('✅ Pesan Berhasil Dikirim')
                        ->body("Pesan terkirim ke {$creds->tapper_name}, namun ada masalah dengan penyimpanan data")
                        ->warning()
                        ->send();

                    return redirect()->back()->with('success', "Pesan berhasil dikirim! Message ID: {$messageId}");
                }
            } else {
                // Message failed to send
                $error = $responseData['reason'] ?? 'Unknown error';

                Log::error('Message send failed:', [
                    'error' => $error,
                    'response' => $responseData,
                    'target' => $creds->tapper_phone
                ]);

                Notification::make()
                    ->title('❌ Gagal Mengirim Pesan')
                    ->body("Error: {$error}")
                    ->danger()
                    ->send();

                return redirect()->back()->with('error', "Gagal mengirim pesan: {$error}");
            }
        } catch (Exception $e) {
            Log::error('WhatsApp send exception:', [
                'error' => $e->getMessage(),
                'target' => $creds->tapper_phone ?? null
            ]);

            Notification::make()
                ->title('❌ Gagal Mengirim Pesan')
                ->body('Error: ' . $e->getMessage())
                ->danger()
                ->send();

            return redirect()->back()->with('error', 'Gagal mengirim pesan: ' . $e->getMessage());
        }
    }
    public function deliveryStatus(Request $request)
    {
        // Handle GET request (webhook verification from Fonnte)
        if ($request->isMethod('get')) {
            Log::info('Fonnte Delivery Status Verification (GET):', $request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Delivery status endpoint is active'
            ], 200);
        }

        // Handle POST request (actual delivery status data)
        Log::info('Fonnte Delivery Status Webhook:', [
            'headers' => $request->headers->all(),
            'body' => $request->all(),
            'timestamp' => now()->toDateTimeString()
        ]);

        $data = $request->all();

        // Fonnte delivery status fields:
        // - id: message ID
        // - status: delivered, read, failed
        // - target: recipient phone number
        // - timestamp: when status changed

        if (isset($data['id']) && isset($data['status'])) {
            $messageId = $data['id'];
            $status = $data['status'];
            $target = $data['target'] ?? null;
            $timestamp = $data['timestamp'] ?? now();

            Log::info("Message Status Update: ID {$messageId} → {$status} to {$target}");

            // Update message status in database
            $updateData = [
                'status' => $status,
                'updated_at' => now()
            ];

            if ($status === 'delivered') {
                $updateData['delivered_at'] = $timestamp;
            } elseif ($status === 'read') {
                $updateData['read_at'] = $timestamp;
            }

            $updated = DB::table('whatsapp_messages')
                ->where('message_id', $messageId)
                ->update($updateData);

            if ($updated) {
                Log::info("Message status updated in database for ID: {$messageId}");
            } else {
                Log::warning("Message ID not found in database: {$messageId}");
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Delivery status processed'
        ], 200);
    }

    public function webhook(Request $request)
    {
        // Handle GET request (webhook verification from Fonnte)
        if ($request->isMethod('get')) {
            Log::info('Fonnte Webhook Verification (GET):', $request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Webhook endpoint is active'
            ], 200);
        }

        // Handle POST request (actual webhook data)
        Log::info('Fonnte Incoming Message Webhook:', [
            'headers' => $request->headers->all(),
            'body' => $request->all(),
            'raw_body' => $request->getContent(),
            'method' => $request->method(),
            'timestamp' => now()->toDateTimeString()
        ]);

        $data = $request->all();

        // Fonnte incoming message fields:
        // - device: your device ID
        // - from: sender phone number
        // - message: the message text
        // - type: message type (text, image, etc.)
        // - timestamp: when message was received

        if (isset($data['from']) && isset($data['message'])) {
            $from = $data['from'];
            $message = $data['message'];
            $type = $data['type'] ?? 'text';
            $timestamp = $data['timestamp'] ?? now();

            Log::info("Incoming message from {$from}: {$message}");

            // You can add logic here to:
            // 1. Store the incoming message in database
            // 2. Auto-reply based on message content
            // 3. Forward to specific handlers
            // 4. Match with existing assessment codes

            // Example: Store incoming message (optional)
            DB::table('incoming_messages')->insert([
                'from_phone' => $from,
                'message_content' => $message,
                'message_type' => $type,
                'received_at' => $timestamp,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Log::info("Incoming message stored from: {$from}");
        }

        // Always return 200 OK to acknowledge receipt
        return response()->json([
            'status' => 'success',
            'message' => 'Webhook received and processed',
            'received_at' => now()->toDateTimeString()
        ], 200);
    }
}

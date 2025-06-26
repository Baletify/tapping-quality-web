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
                    'target' => $to,
                    'message' =>  $message,
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $token,
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            Notification::make()
                ->title('Pesan Terkirim')
                ->body('Pesan berhasil dikirim ke ' . $creds->tapper_name)
                ->success()
                ->send();
            return redirect()->back()->with('success', 'Response: ' . $response);
        } catch (Exception $e) {
            flash()->error('Response: ' . $e->getMessage());
            Notification::make()
                ->title('Gagal Mengirim Pesan')
                ->body('Gagal mengirim pesan: ' . $e->getMessage())
                ->danger()
                ->send();
            return  redirect()->back()->with('error', 'Gagal mengirim pesan: ' . $e->getMessage());
        }
    }
}

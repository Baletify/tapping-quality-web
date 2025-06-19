<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsappController;
use App\Http\Controllers\AssessmentController;

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/api/assessment/upload', [AssessmentController::class, 'store'])->name('api.assessment-details.create');
Route::post('/send-message', [WhatsappController::class, 'sendMessage'])
    ->name('whatsapp.send-message');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\WhatsappController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/assessment-upload', [AssessmentController::class, 'store'])->name('api.assessment-details.create');
Route::post('/tree-assessment-upload', [AssessmentController::class, 'storeTree'])->name('api.assessment-details.store-tree');
Route::post('/fonnte/webhook', [WhatsappController::class, 'webhook']);

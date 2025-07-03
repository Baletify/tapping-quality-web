<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WhatsappController;
use App\Http\Controllers\AssessmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/assessment-upload', [AssessmentController::class, 'store'])->name('api.assessment-details.create');
Route::post('/tree-assessment-upload', [AssessmentController::class, 'storeTree'])->name('api.assessment-details.store-tree');
Route::post('/fonnte/webhook', [WhatsappController::class, 'webhook']);
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return response()->json([
        'success' => true,
        'user' => $request->user(),
    ]);
});

<?php

use App\Http\Controllers\AssessmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/api/assessment/upload', [AssessmentController::class, 'store'])->name('api.assessment-details.create');

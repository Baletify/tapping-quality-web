<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssessmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/assessment-upload', [AssessmentController::class, 'store'])->name('api.assessment-details.create');
Route::post('/tree-assessment-upload', [AssessmentController::class, 'storeTree'])->name('api.assessment-details.store-tree');

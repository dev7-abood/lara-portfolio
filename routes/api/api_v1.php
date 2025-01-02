<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiV1\CategoryController;
use App\Http\Controllers\ApiV1\PortfolioController;
use App\Http\Controllers\ApiV1\ResumeController;
use App\Http\Controllers\ApiV1\ContactController;
use App\Http\Controllers\ApiV1\EducationController;
use App\Http\Controllers\ApiV1\HomeController;
use App\Http\Controllers\ApiV1\ServiceController;
use App\Http\Controllers\ApiV1\HireMeController;

Route::get('resume-data', [ResumeController::class, 'resumeData']);
Route::get('home', [HomeController::class, 'index']);
Route::get('services', [ServiceController::class, 'index']);
Route::get('hire-me-button', [HireMeController::class, 'hireMeButton']);

// work section
Route::prefix('portfolio')->group(function () {
    Route::get('/main-section', [PortfolioController::class, 'mainSection']);
    Route::get('/by-categories', [PortfolioController::class, 'byCategories']);
});

Route::prefix('contact')->group(function () {
    Route::get('/', [ContactController::class, 'index']);
    Route::post('/store', [ContactController::class, 'store']);
});


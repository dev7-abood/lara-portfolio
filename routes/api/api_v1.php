<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiV1\CategoryController;
use App\Http\Controllers\ApiV1\PortfolioController;
use App\Http\Controllers\ApiV1\ResumeController;
use App\Http\Controllers\ApiV1\ContactUsController;
use App\Http\Controllers\ApiV1\EducationController;
use App\Http\Controllers\ApiV1\HomeController;
use App\Http\Controllers\ApiV1\ServiceController;

Route::get('resume-data', [ResumeController::class, 'resumeData']);
Route::get('home', [HomeController::class, 'index']);
Route::get('services', [ServiceController::class, 'index']);

// work section
Route::prefix('portfolio')->group(function () {
    Route::get('/main-section', [PortfolioController::class, 'mainSection']);
    Route::get('/by-categories', [PortfolioController::class, 'byCategories']);
    Route::get('/{slug}', [PortfolioController::class, 'show']);
});

Route::prefix('contact-us')->group(function () {
    Route::post('/store', [ContactUsController::class, 'store']);
});


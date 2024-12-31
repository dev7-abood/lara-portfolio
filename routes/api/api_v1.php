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
Route::get('education', [EducationController::class, 'index']);
Route::get('home', [HomeController::class, 'index']);
Route::get('services', [ServiceController::class, 'index']);

Route::prefix('portfolios')->group(function () {
    Route::get('/', [PortfolioController::class, 'index']);
    Route::get('/{id}', [PortfolioController::class, 'show']);
});

Route::prefix('categories')->group(function () {
    Route::get('/portfolios', [CategoryController::class, 'portfolios']);
    Route::get('/skills', [CategoryController::class, 'skills']);
});

Route::prefix('contact-us')->group(function () {
    Route::post('/store', [ContactUsController::class, 'store']);
});


#todo Settings

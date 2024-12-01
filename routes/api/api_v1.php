<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiV1\CategoryController;
use App\Http\Controllers\ApiV1\PortfolioController;
use App\Http\Controllers\ApiV1\AboutMeController;
use App\Http\Controllers\ApiV1\ContactUsController;

Route::get('about-me', [AboutMeController::class, 'aboutMe']);

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

#todo Education Section Need to add it
#todo Portfolio Pagination
#todo Settings

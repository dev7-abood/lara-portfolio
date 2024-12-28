<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiV1\EducationResource;
use Illuminate\Http\Request;
use App\Models\Home;
use App\Http\Resources\ApiV1\HomeResource;

class HomeController extends Controller
{
    public function index()
    {
        $publicHome = Home::query()
            ->where('is_public', true)
            ->orderBy('sort', 'asc')
            ->first();

        return response()->json([
            'success' => true,
            'message' => $publicHome ? 'Home retrieved successfully' : 'No public home available',
            'data' => $publicHome ? new HomeResource($publicHome) : null,
        ], 200);
    }
}

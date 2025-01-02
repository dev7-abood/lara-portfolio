<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HireMe;

class HireMeController extends Controller
{
    public function hireMeButton()
    {
       $hireMe = HireMe::query()->where('is_public', true)->first();

        if (!$hireMe) {
            return response()->json([
                'status' => false,
                'message' => 'No public HireMe record found',
            ], 404);
        }

        // Return the successful response
        return response()->json([
            'status' => true,
            'message' => 'Hire me button',
            'data' => $hireMe,
        ]);

    }
}

<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutMe;
use App\Http\Resources\ApiV1\AboutMeResource;

class AboutMeController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function aboutMe() : \Illuminate\Http\JsonResponse
    {
        $aboutMe = AboutMe::query()
            ->where('is_public', true)
            ->orderBy('sort')
            ->first();

        if (!$aboutMe) {
            return response()->json([
               'status' => false,
               'message' => "About Me not found",
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => "About Me retrieved",
            'data' => new AboutMeResource($aboutMe),
        ]);
    }
}

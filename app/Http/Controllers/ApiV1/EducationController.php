<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Http\Resources\ApiV1\EducationResource;

class EducationController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function index() : \Illuminate\Http\JsonResponse
    {
        $education = Education::query()
            ->where('is_public', true)
            ->orderByDesc('id')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'List education',
            'data' => EducationResource::collection($education)
        ]);
    }
}

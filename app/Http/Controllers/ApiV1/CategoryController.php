<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Skill;
use App\Models\Portfolio;
use App\Http\Resources\ApiV1\CategoryResource;

class CategoryController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function skills() : \Illuminate\Http\JsonResponse
    {
        $categories = Category::query()
            ->where([
                'is_public' => true,
                'categoryable_type' => Skill::class
            ])->orderBy('sort')->get();

        return response()->json([
            'status' => true,
            'message' => 'List of skills categories',
            'data' => CategoryResource::collection($categories)
        ]);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function portfolios() : \Illuminate\Http\JsonResponse
    {
        $categories = Category::query()
            ->where([
                'is_public' => true,
                'categoryable_type' => Portfolio::class
            ])->orderBy('sort')->get();

        return response()->json([
            'status' => true,
            'message' => 'List of portfolio categories',
            'data' => CategoryResource::collection($categories)
        ]);
    }

}

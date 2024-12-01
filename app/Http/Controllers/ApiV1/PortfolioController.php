<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Http\Resources\ApiV1\PortfolioResource;

class PortfolioController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        $portfolios = Portfolio::query()
            ->with([
                'categories' => fn($query) => $query->where('is_public', true)->orderBy('sort'),
                'tags' => fn($query) => $query->where('is_public', true)->orderBy('sort')
            ])
            ->orderBy('sort')
            ->where('is_public', true)
            ->get();

        $portfolioResource = PortfolioResource::collection($portfolios);

        return response()->json([
            'status' => true,
            'message' => 'Portfolio List',
            'data' => $portfolioResource,
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($id) : \Illuminate\Http\JsonResponse
    {
        $portfolio = Portfolio::query()
            ->with([
                'categories' => fn($query) => $query->where('is_public', true)->orderBy('sort'),
                'tags' => fn($query) => $query->where('is_public', true)->orderBy('sort'),
            ])
            ->where('is_public', true)
            ->orderBy('sort')
            ->find($id);

        if (!$portfolio) {
            return response()->json([
                'status' => false,
                'message' => 'Portfolio not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Portfolio retrieved successfully',
            'data' => new PortfolioResource($portfolio),
        ]);
    }

}

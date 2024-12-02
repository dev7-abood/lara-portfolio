<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Resources\ApiV1\PortfolioResource;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) : \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'page' => 'integer|min:1|max:100'
        ]);

        $per_page = $request->query('page', 3);

        $portfolios = Portfolio::query()
            ->with([
                'categories' => fn($query) => $query->where('is_public', true)->orderBy('sort'),
                'tags' => fn($query) => $query->where('is_public', true)->orderBy('sort')
            ])
            ->orderBy('sort')
            ->where('is_public', true)
            ->simplePaginate($per_page);

        $portfolioResource = PortfolioResource::collection($portfolios);

        return response()->json([
            'status' => true,
            'message' => 'Portfolio List',
            'data' => $portfolioResource,
            'pagination' => paginationData($portfolios)
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

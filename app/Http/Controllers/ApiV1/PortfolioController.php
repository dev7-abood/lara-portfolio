<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Resources\ApiV1\PortfolioResource;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;

class PortfolioController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function mainSection(Request $request)
    {
        $portfolios = Portfolio::query()
            ->orderBy('sort')
            ->where('is_public', true)
            ->where('is_main', true)
            ->with('tags')
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
     * @return \Illuminate\Database\Eloquent\Collection
     */


    public function byCategories()
    {
        return Category::with(['portfolios' => function ($query) {
            $query->orderBy('sort')
                ->where('is_public', true)
                ->with('tags');
        }])->get();
    }

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

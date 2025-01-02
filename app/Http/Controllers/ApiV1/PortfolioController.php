<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Resources\ApiV1\PortfolioResource;
use App\Http\Resources\ApiV1\CategoryResource;
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
     * @return \Illuminate\Http\JsonResponse
     */


    public function byCategories()
    {
        $categories = Category::query()->orderBy('sort')
            ->whereHas('portfolios', function ($query) {
            $query->where('is_public', true);
        })
            ->with(['portfolios' => function ($query) {
                $query->orderBy('sort')
                    ->where('is_public', true)
                    ->with('tags');
            }])
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Work List',
            'data' => CategoryResource::collection($categories),
        ]);

    }

}

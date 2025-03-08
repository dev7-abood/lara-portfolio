<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Resources\ApiV1\PortfolioResource;
use App\Http\Resources\ApiV1\CategoryResource;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use App\Models\Home;

class PortfolioController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function mainSection(Request $request) : \Illuminate\Http\JsonResponse
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


    public function byCategories() : \Illuminate\Http\JsonResponse
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


    /**
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|object
     */
    public function profileImage() : \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $portfolios = Home::query()
            ->orderBy('sort')
            ->where('is_public', true)
            ->first();

        if (!$portfolios) {
            return redirect('/');
        }

        return redirect('storage/' . $portfolios->profile_image);

    }

}

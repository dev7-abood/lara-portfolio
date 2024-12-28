<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Resources\ApiV1\ServiceResource;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_public', true)
            ->orderBy('sort', 'asc')
            ->get();

        $response = [
            'success' => true,
            'message' => $services->isNotEmpty() ? 'Services retrieved successfully' : 'No services available',
            'data' => ServiceResource::collection($services),
        ];

        return response()->json($response, 200);
    }
}

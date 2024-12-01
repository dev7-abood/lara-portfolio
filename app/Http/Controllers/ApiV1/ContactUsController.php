<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    #todo telegram receive messages
    #todo dashboard notification

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) : \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required'
        ]);

        ContactUs::query()->create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Thanks for contacting us! We will get back to you soon.'
        ], 201);
    }
}

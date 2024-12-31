<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Models\AboutMe;
use App\Models\Skill;
use App\Models\Education;
use App\Models\Experience;
use App\Http\Resources\ApiV1\ResumeResource;

class ResumeController extends Controller
{
    public function resumeData()
    {
        $aboutMe = [
            'aboutMe' => AboutMe::query()
                ->select('id', 'contact_details', 'description') // Explicitly select fields
                ->where('is_public', true)
                ->first(),

            'skill' => Skill::query()
                ->select('id', 'description', 'skills') // Explicitly select fields
                ->where('is_public', true)
                ->first(),

            'education' => Education::query()
                ->select('id', 'description', 'educations') // Explicitly select fields
                ->where('is_public', true)
                ->whereRaw("JSON_SEARCH(educations, 'one', false, null, '$[*].is_public') IS NULL")
                ->get()
                ->each(function ($item) {
                    $item->educations = collect($item->educations)
                        ->filter(function ($education) {
                            unset($education['is_public']); // Remove is_public from JSON
                            return true;
                        })
                        ->values();
                })
                ->first(),

            'experience' => Experience::query()
                ->select('id', 'description', 'experiences') // Explicitly select fields
                ->where('is_public', true)
                ->whereRaw("JSON_SEARCH(experiences, 'one', false, null, '$[*].is_public') IS NULL")
                ->get()
                ->each(function ($item) {
                    $item->experiences = collect($item->experiences)
                        ->filter(function ($experience) {
                            unset($experience['is_public']); // Remove is_public from JSON
                            return true;
                        })
                        ->values();
                })
                ->first(),
        ];

        $aboutMe = collect($aboutMe);

        return response()->json([
            'status' => true,
            'message' => 'Data retrieved successfully',
            'data' => new ResumeResource($aboutMe),
        ], 200);

    }
}

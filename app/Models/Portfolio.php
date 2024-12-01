<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Portfolio extends Model
{
    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'images' => 'array',
        ];
    }

    public function files() : \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }


    public function tags() : \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }


    public function categories() : \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }


//    protected static function booted()
//    {
//        static::deleting(function ($model) {
//            // Delete the background file if it exists
//            if ($model->background && Storage::exists($model->background)) {
//                Storage::delete($model->background);
//            }
//
//            // Handle images if they are already an array
//            if (is_array($model->images)) {
//                foreach ($model->images as $image) {
//                    if (Storage::exists($image)) {
//                        Storage::delete($image);
//                    }
//                }
//            }
//        });
//    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];


    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class);
    }

}

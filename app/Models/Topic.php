<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = ['id'];

    public function reviews()
    {
        return $this->belongsToMany(Review::class);
    }
}

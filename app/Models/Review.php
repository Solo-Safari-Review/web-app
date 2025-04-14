<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = ['id'];

    public function categorizedReview()
    {
        return $this->hasOne(CategorizedReview::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'reviewstopics');
    }
}

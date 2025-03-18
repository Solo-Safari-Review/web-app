<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorizedReview extends Model
{
    protected $guarded = ['id'];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

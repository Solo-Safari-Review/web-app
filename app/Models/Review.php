<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;

class Review extends Model implements Searchable
{
    protected $guarded = ['id'];

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            Str::limit($this->content, 100, '...'),
            route('reviews.show', Crypt::encryptString($this->id))
        );
    }

    public function categorizedReview()
    {
        return $this->hasOne(CategorizedReview::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
}

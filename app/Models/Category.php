<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Spatie\Searchable\Search;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Category extends Model implements Searchable
{
    protected $guarded = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('categories.show', Crypt::encryptString($this->id));

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    public function categorizedReviews()
    {
        return $this->hasMany(CategorizedReview::class);
    }
}

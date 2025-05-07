<?php

namespace App\Models;

use App\Helpers\HashidsHelper;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model implements Searchable
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            Str::limit($this->content, 200, '...'),
            route('reviews.show', HashidsHelper::encode($this->id))
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

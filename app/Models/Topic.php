<?php

namespace App\Models;

use App\Helpers\HashidsHelper;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Topic extends Model implements Searchable
{
    protected $guarded = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('topics.show', HashidsHelper::encode($this->id));

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    public function reviews()
    {
        return $this->belongsToMany(Review::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}

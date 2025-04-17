<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Topic extends Model implements Searchable
{
    protected $guarded = ['id'];

    public function getSearchResult(): SearchResult
    {
        $url = route('topics.show', Crypt::encryptString($this->id));

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
}

<?php

namespace App\View\Components;

use App\Http\Controllers\SearchController;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class SearchBar extends Component
{
    public $recentSearchs;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->recentSearchs = SearchController::getRecentSearches();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-bar');
    }
}

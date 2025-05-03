<?php

namespace App\View\Components;

use App\Helpers\HashidsHelper;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardCategory extends Component
{
    public $categoryUrl, $category;
    /**
     * Create a new component instance.
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
        $this->categoryUrl = route('reviews.all', ['category' => HashidsHelper::encode($category->id)]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-category');
    }
}

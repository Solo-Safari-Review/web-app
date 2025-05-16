<?php

namespace App\View\Components\sections;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopicsOnCategory extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $topics, public $categoryName)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sections.topics-on-category');
    }
}

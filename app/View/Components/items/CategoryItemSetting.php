<?php

namespace App\View\Components\items;

use App\Helpers\HashidsHelper;
use App\Models\Category;
use App\Models\Topic;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryItemSetting extends Component
{
    public $showUrl, $deleteUrl, $type;
    /**
     * Create a new component instance.
     */
    public function __construct(public ?Category $category)
    {
        $this->showUrl = route('categories.show', HashidsHelper::encode($category->id));
        $this->deleteUrl = route('categories.destroy', HashidsHelper::encode($category->id));
        $this->type = "category";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.items.category-item-setting');
    }
}

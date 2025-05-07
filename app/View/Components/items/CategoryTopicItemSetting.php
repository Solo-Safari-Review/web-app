<?php

namespace App\View\Components\items;

use App\Helpers\HashidsHelper;
use App\Models\Category;
use App\Models\Topic;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryTopicItemSetting extends Component
{
    public $showUrl, $deleteUrl;
    /**
     * Create a new component instance.
     */
    public function __construct(public ?Category $category, public ?Topic $topic, public $type)
    {
        if ($type == "category") {
            $this->showUrl = route('categories.show', HashidsHelper::encode($category->id));
            $this->deleteUrl = route('categories.destroy', HashidsHelper::encode($category->id));
        }

        if ($type == "topic") {
            $this->showUrl = route('topics.show', HashidsHelper::encode($topic->id));
            $this->deleteUrl = route('topics.destroy', HashidsHelper::encode($topic->id));
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.items.category-topic-item-setting');
    }
}

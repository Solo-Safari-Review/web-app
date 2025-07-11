<?php

namespace App\View\Components\Items;

use App\Helpers\HashidsHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopicItemSetting extends Component
{
    public $reviewsCount, $showUrl, $editUrl, $deleteUrl, $type;
    /**
     * Create a new component instance.
     */
    public function __construct(public $topic)
    {
        $this->reviewsCount = $topic->reviews()->count();
        $this->showUrl = route('reviews.all', ['topic' => HashidsHelper::encode($topic->id), 'sort' => 'Jumlah Suka', 'sort-method' => 'Turun']);
        $this->editUrl = route('topics.edit', HashidsHelper::encode($topic->id));
        $this->deleteUrl = route('topics.destroy', HashidsHelper::encode($topic->id));
        $this->type = "topic";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.items.topic-item-setting');
    }
}

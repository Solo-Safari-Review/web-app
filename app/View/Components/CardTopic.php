<?php

namespace App\View\Components;

use App\Helpers\HashidsHelper;
use App\Models\Topic;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardTopic extends Component
{
    public $topicUrl, $topic;
    /**
     * Create a new component instance.
     */
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
        $this->topicUrl = route('reviews.all', ['topic' => HashidsHelper::encode($topic->id)]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-topic');
    }
}

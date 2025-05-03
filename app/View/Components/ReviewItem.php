<?php

namespace App\View\Components;

use App\Helpers\HashidsHelper;
use App\Models\Review;
use Closure;
use Hashids\Hashids;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReviewItem extends Component
{
    public $username, $category, $content, $rating, $reviewStatus, $actionStatus, $answerStatus, $showUrl, $editUrl, $deleteUrl, $review, $info;
    /**
     * Create a new component instance.
     */
    public function __construct(Review $review, $info = null)
    {
        $reviewId = HashidsHelper::encode($review->id);

        $this->username = $review->username;
        $this->category = $review->categorizedReview->category->name ?? "Belum Terkategori";
        $this->content = $review->content;
        $this->rating = $review->rating;
        $this->reviewStatus = $review->categorizedReview->review_status ?? null;
        $this->actionStatus = $review->categorizedReview->action_status ?? null;
        $this->answerStatus = $review->categorizedReview->answer_status ?? null;
        $this->showUrl = route('reviews.show', $reviewId);
        $this->editUrl = route('reviews.edit', $reviewId);
        $this->deleteUrl = route('reviews.destroy', $reviewId);
        $this->review = $reviewId;
        $this->info = $info;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.review-item');
    }
}

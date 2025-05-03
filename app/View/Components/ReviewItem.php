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
    public $username, $category, $content, $rating, $reviewStatus, $actionStatus, $answerStatus, $showUrl, $editUrl, $deleteUrl, $review;
    /**
     * Create a new component instance.
     */
    public function __construct(Review $review)
    {
        $reviewId = HashidsHelper::encode($review->id);

        $this->username = $review->username;
        $this->category = $review->categorizedReview->category->name;
        $this->content = $review->content;
        $this->rating = $review->rating;
        $this->reviewStatus = $review->categorizedReview->review_status;
        $this->actionStatus = $review->categorizedReview->action_status;
        $this->answerStatus = $review->categorizedReview->answer_status;
        $this->showUrl = route('reviews.show', $reviewId);
        $this->editUrl = route('reviews.edit', $reviewId);
        $this->deleteUrl = route('reviews.destroy', $reviewId);
        $this->review = $reviewId;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.review-item');
    }
}

<?php

namespace App\View\Components\Items;

use App\Helpers\HashidsHelper;
use App\Models\Review;
use Closure;
use Hashids\Hashids;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReviewItem extends Component
{
    public $username, $category, $department, $content, $rating, $reviewStatus, $actionStatus, $answerStatus, $showUrl, $editUrl, $deleteUrl, $reviewId, $info;
    /**
     * Create a new component instance.
     */
    public function __construct(Review $review, $info = null, public $type = null)
    {
        $reviewId = HashidsHelper::encode($review->id);

        $this->username = $review->username;
        $this->category = $review->categorizedReview && $review->categorizedReview->category_id ? "Kategori " . $review->categorizedReview->category->name : "Belum Terkategori";
        $this->department = $review->categorizedReview && $review->categorizedReview->department_id ? "Departemen " . $review->categorizedReview->department->name : "";
        $this->content = $review->content;
        $this->rating = $review->rating;
        // $this->reviewStatus = $review->categorizedReview->review_status ?? null;
        $this->actionStatus = $review->categorizedReview->action_status ?? null;
        $this->answerStatus = $review->categorizedReview->answer_status ?? null;
        if ($this->type == 'sampah') {
            $this->showUrl = route('trash.show', $reviewId);
        } else {
            $this->showUrl = route('reviews.show', $reviewId);
        }
        $this->editUrl = route('reviews.edit', $reviewId);
        $this->deleteUrl = route('reviews.destroy', $reviewId);
        $this->reviewId = $reviewId;
        $this->info = $info;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.items.review-item');
    }
}

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
    public function __construct($review = null)
    {
        if ($review == null) {
            $id = 1;
            $this->username = "Yudha Cahya";
            $this->category = "Fasilitas";
            $this->content = "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi modi, quasi quaerat magnam omnis eos totam aperiam quos porro explicabo vel sapiente architecto tenetur deleniti praesentium reprehenderit soluta placeat et officiis aspernatur obcaecati at, beatae earum assumenda. Odit, nesciunt eligendi! Reiciendis animi, quibusdam laboriosam sequi veritatis dolorum libero suscipit id nihil quam ex rem accusamus eveniet inventore quidem doloremque expedita architecto non facere tenetur est! Molestiae repellat velit reiciendis beatae? Aperiam, doloribus! Est sed ab, repudiandae optio nulla nobis. Voluptatem tempora nostrum dolorum, et ab labore eaque eius dolor delectus at, ipsam itaque quam rerum earum, saepe amet ut reprehenderit adipisci sunt. Laboriosam debitis quam recusandae iusto repellat optio voluptatem nam praesentium voluptas beatae ratione labore consequatur vero, est, temporibus minus consequuntur, dolorem amet at eum corrupti reiciendis alias! Commodi, perferendis quibusdam inventore voluptatem dolor, fugiat in placeat amet nulla pariatur ea? Est autem mollitia laborum porro explicabo atque consequatur quisquam nihil rerum corporis natus, quasi maxime ipsa ea quaerat, blanditiis itaque ratione doloremque sit? Fugit quam placeat enim nihil aliquam ipsum voluptas obcaecati eos culpa repellendus, ipsam sapiente tempore temporibus molestiae quibusdam dicta provident in? Molestias asperiores amet soluta deleniti aliquam earum odit? Consectetur eum impedit fuga laboriosam dolores cum expedita esse, non vitae, enim, aperiam sequi dolor repudiandae sapiente corporis accusantium saepe hic! Recusandae deleniti eum natus sed? Minus vel, quam, unde totam blanditiis vitae doloribus hic maiores illum quibusdam neque, veritatis ipsam. Excepturi nemo animi illo laudantium, sed, ipsam dignissimos dolores fugit, sunt error unde. Facere, voluptate!";
            $this->rating = 5;
            $this->reviewStatus = "Belum diteruskan";
            $this->actionStatus = "Belum dikerjakan";
            $this->answerStatus = "Belum dijawab";
            $this->showUrl = route('reviews.show', HashidsHelper::encode($id));
            $this->editUrl = route('reviews.edit', HashidsHelper::encode($id));
            $this->deleteUrl = route('reviews.destroy', HashidsHelper::encode($id));
            $this->review = HashidsHelper::encode($id);
        } else {
            $encodedId = $review;
            $reviewId = HashidsHelper::decode($review);
            $review = Review::find($reviewId);

            $this->username = $review->username;
            $this->category = $review->categorizedReview->category->name;
            $this->content = $review->content;
            $this->rating = $review->rating;
            $this->reviewStatus = $review->categorizedReview->review_status;
            $this->actionStatus = $review->categorizedReview->action_status;
            $this->answerStatus = $review->categorizedReview->answer_status;
            $this->showUrl = route('reviews.show', $encodedId);
            $this->editUrl = route('reviews.edit', $encodedId);
            $this->deleteUrl = route('reviews.destroy', $encodedId);
            $this->review = $encodedId;
        }

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.review-item');
    }
}

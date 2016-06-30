<?php
    /**
     * Created by PhpStorm.
     * User: bahasolaptop2
     * Date: 21/06/16
     * Time: 15:42
     */

    namespace App\Eatnshare\Request;


    use App\Events\UserSubmittedReview;
    use App\Notification;
    use Auth;
    use App\Review;


    class AddReviewForm extends Form
    {
        protected $rules = [
            'rating' => 'required'
        ];

        public function create()
        {
            $review = new Review();
            $notification = new Notification();

            $user = Auth::user();

            if ($this->isValid()) {
                $review_added = $review->create([
                    'recipe_id' => $this->fields('recipe_id'),
                    'user_id'   => $user->id,
                    'rating'    => $this->fields('rating'),
                    'review'    => $this->fields('review')
                ]);

                $recipe = $review_added->recipe()->first();

                $notification_added = $notification->create([
                    'user_id' => $recipe->user_id,
                    'url'     => 'recipe/' . $recipe->slug,
                    'status'  => 'unread',
                    'message' => $user->present()->fullname . 'submit a review on your recipe'
                ]);

                event(new UserSubmittedReview($user->present()->fullname, $notification_added->user_id, $notification_added->url));

                return $review_added;

            } else {
                return false;
            }
        }
    }
<?php
    /**
     * Created by PhpStorm.
     * User: bahasolaptop2
     * Date: 21/06/16
     * Time: 15:42
     */

    namespace App\Eatnshare\Request;


    use App\Eatnshare\Traits\NotificationTraits;
    use App\Events\UserSubmittedReview;
    use App\Notification;
    use Auth;
    use App\Review;


    class AddReviewForm extends Form
    {
        use NotificationTraits;
        
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

                $notification = $this->addNotification($recipe);

                event(new UserSubmittedReview($user->present()->fullname, $notification->user_id,
                    $notification->url,$notification->id,$notification->status));

                return $review_added;

            } else {
                return false;
            }
        }
    }
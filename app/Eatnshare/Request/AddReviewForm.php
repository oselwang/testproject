<?php
    /**
     * Created by PhpStorm.
     * User: bahasolaptop2
     * Date: 21/06/16
     * Time: 15:42
     */

    namespace App\Eatnshare\Request;


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

            if ($this->isValid()) {
                $review_added = $review->create([
                    'recipe_id' => $this->fields('recipe_id'),
                    'user_id'   => Auth::user()->id,
                    'rating'    => $this->fields('rating'),
                    'review'    => $this->fields('review')
                ]);

                return $review_added;
                
            } else {
                return false;
            }
        }
    }
<?php

    namespace App\Http\Controllers;

    use App\Review;
    use Illuminate\Http\Request;

    use App\Http\Requests;

    class ReviewController extends Controller
    {
        private $review;

        public function __construct(Review $review)
        {
            $this->review = $review;
        }

        public function getPositive($recipe_id)
        {
            $reviews = $this->review->where(function($query) use ($recipe_id){
                $query->where('recipe_id',$recipe_id);
                $query->where('rating','<=','3');
            })->orderBy('rating','asc')->get();

            $merge = [];
            foreach($reviews as $review){
                $user = $review->user()->first();
                $profile_photo = ['photo_name' => $user->getProfilePhoto()];
                $review_collection = collect($review);
                $created_at = ['diffForHumans' => $review->created_at->diffForHumans()];
                $merge_user = $review_collection->merge($user->toArray());
                $merge_pp = $merge_user->merge($profile_photo);
                $merge_time = $merge_pp->merge($created_at);
                $merge[] = $merge_time;
            }

            return response()->json($merge);

        }
    }

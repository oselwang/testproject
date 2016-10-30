<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Review;
use Auth;

class ReviewController extends Controller
{
    private $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function getPositive($recipe_id)
    {
        $reviews = $this->review->where(function ($query) use ($recipe_id) {
            $query->where('recipe_id', $recipe_id);
            $query->where('rating', '>=', '3');
        })
            ->orderBy('rating', 'desc')
            ->orderBy('created_at', 'desc')->paginate(10);
        $collection = [];
        foreach ( $reviews as $review ) {
            $collection[] = $this->mergeCollectionReview($review);
        }

        return response()->json($collection);

    }

    public function getLeastPositive($recipe_id)
    {
        $reviews = $this->review->where(function ($query) use ($recipe_id) {
            $query->where('recipe_id', $recipe_id);
            $query->where('rating', '<=', '3');
        })
            ->orderBy('rating', 'asc')
            ->orderBy('created_at', 'desc')->paginate(10);
        $collection = [];
        foreach ( $reviews as $review ) {
           $collection[] = $this->mergeCollectionReview($review);
        }

        return response()->json($collection);

    }

    public function getNewest($recipe_id)
    {
        $reviews = $this->review->where(function ($query) use ($recipe_id) {
            $query->where('recipe_id', $recipe_id);
        })
            ->orderBy('created_at', 'desc')->paginate(10);
        $collection = [];
        foreach ( $reviews as $review ) {
           $collection[] = $this->mergeCollectionReview($review);
        }

        return response()->json($collection);

    }

    public function getHelpful($recipe_id){
        $reviews = $this->review->where('recipe_id',$recipe_id)
            ->orderBy('helpful','desc')
            ->paginate(10);
        $collection = [];
        foreach ( $reviews as $review ) {
            $collection[] = $this->mergeCollectionReview($review);
        }

        return response()->json($collection);
    }

    private function mergeCollectionReview($review){

        $user = $review->user()->first();
        $owner = ['owner' => false];
        $review_liked = ['liked' => false];
        if(Auth::check()){
            $owner = !$review->ownBy(Auth::user()->id) ? ['owner' => false] : ['owner' => true];
            $review_liked = $review->isAlreadyLiked() ? ['liked' => true] : ['liked' => false];
        }
        $logged_in = Auth::check() ? ['login' => true] : ['login' => false];
        $profile_photo = [ 'photo_name' => $user->getProfilePhoto() ];
        $review_collection = collect($user);
        $created_at = [ 'diffForHumans' => $review->created_at->diffForHumans() ];
        $merge_user = $review_collection->merge($review->toArray());
        $merge_pp = $merge_user->merge($profile_photo);
        $merge_time = $merge_pp->merge($created_at);
        $merge_liked = $merge_time->merge($review_liked);
        $merge_owner = $merge_liked ->merge($owner);
        $merge_login = $merge_owner->merge($logged_in);
        $merge = $merge_login;
        return $merge;
    }
}

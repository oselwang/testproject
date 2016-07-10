<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Review;

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
        $merge = [ ];
        foreach ( $reviews as $review ) {
            $user = $review->user()->first();
            $profile_photo = [ 'photo_name' => $user->getProfilePhoto() ];
            $review_collection = collect($review);
            $created_at = [ 'diffForHumans' => $review->created_at->diffForHumans() ];
            $merge_user = $review_collection->merge($user->toArray());
            $merge_pp = $merge_user->merge($profile_photo);
            $merge_time = $merge_pp->merge($created_at);
            $merge[] = $merge_time;
        }

        return response()->json($merge);

    }

    public function getLeastPositive($recipe_id)
    {
        $reviews = $this->review->where(function ($query) use ($recipe_id) {
            $query->where('recipe_id', $recipe_id);
            $query->where('rating', '<=', '3');
        })
            ->orderBy('rating', 'asc')
            ->orderBy('created_at', 'desc')->paginate(10);

        $merge = [ ];
        foreach ( $reviews as $review ) {
            $user = $review->user()->first();
            $profile_photo = [ 'photo_name' => $user->getProfilePhoto() ];
            $review_collection = collect($review);
            $created_at = [ 'diffForHumans' => $review->created_at->diffForHumans() ];
            $merge_user = $review_collection->merge($user->toArray());
            $merge_pp = $merge_user->merge($profile_photo);
            $merge_time = $merge_pp->merge($created_at);
            $merge[] = $merge_time;
        }

        return response()->json($merge);

    }

    public function getNewest($recipe_id)
    {
        $reviews = $this->review->where(function ($query) use ($recipe_id) {
            $query->where('recipe_id', $recipe_id);
        })
            ->orderBy('created_at', 'desc')->paginate(10);

        $merge = [ ];
        foreach ( $reviews as $review ) {
            $user = $review->user()->first();
            $profile_photo = [ 'photo_name' => $user->getProfilePhoto() ];
            $review_collection = collect($review);
            $created_at = [ 'diffForHumans' => $review->created_at->diffForHumans() ];
            $merge_user = $review_collection->merge($user->toArray());
            $merge_pp = $merge_user->merge($profile_photo);
            $merge_time = $merge_pp->merge($created_at);
            $merge[] = $merge_time;
        }

        return response()->json($merge);

    }
}

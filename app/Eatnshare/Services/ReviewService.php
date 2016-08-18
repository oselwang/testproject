<?php

namespace App\Eatnshare\Services;


class ReviewService
{
    public function countRating($reviews)
    {
        $review_count = count($reviews);
        if ( $review_count == 0 ) {
            return null;
        } else {
            $rating = 0;
            foreach ( $reviews as $review ) {
                $rating += $review->rating;
            }
            $average_rating = $rating / $review_count;
            $last_rating = number_format($average_rating, 1);

            return $last_rating;
        }

    }
}
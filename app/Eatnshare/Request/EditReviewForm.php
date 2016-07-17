<?php
namespace App\Eatnshare\Request;


use App\Review;

class EditReviewForm extends Form
{
    public function create()
    {
        // TODO: Implement create() method.
    }

    public function edit()
    {
        $review = new Review();

        $edit_review = $review->where('id',$this->fields('review_id'))->first();
        
        $edit_review->rating = $this->fields('rating');
        $edit_review->review = $this->fields('review');
        $edit_review->save();
        
        return $edit_review;
    }
}
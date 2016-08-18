<?php

namespace App;

use App\Eatnshare\Traits\NotificationTraits;
use App\Events\UserFindedReviewHelpful;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use NotificationTraits;
    
    protected $table = 'reviews';

    protected $fillable = [ 'recipe_id', 'user_id', 'rating', 'review', 'helpful' ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserFullName()
    {
        $user = $this->user()->first();

        return $user->present()->fullname;
    }

    public function getUserProfilePhoto()
    {
        $user = $this->user()->first();

        return $user->getProfilePhoto();
    }

    public function isAlreadyLiked($review_id = null)
    {
        $review_helpful = new ReviewUserHelpful();
        $review_user_helpful = $review_helpful->where(function ($query) use ($review_id) {
            $query->where('user_id', Auth::user()->id);
            $query->where('review_id', $review_id != null ? $review_id : $this->id);
        })->first();

        return !empty($review_user_helpful) ? true : false;
    }

    public function addHelpfulReview(){
        $review_helpful = new ReviewUserHelpful();
        $this->helpful += 1;
        $this->save();
        
        $review_helpful = $review_helpful->create([
            'user_id' => Auth::user()->id,
            'review_id' => $this->id
        ]);
        
        $notification = $this->addNotification($this);
        
        event(new UserFindedReviewHelpful(Auth::user()->present()->fullname, $notification->user_id,
            $notification->url,$notification->id,$notification->status));

        return $this;
    }

    public function subHelpfulReview(){
        $review_helpful = new ReviewUserHelpful();
        $this->helpful -= 1;
        $this->save();
        $review_helpful = $review_helpful->where('review_id',$this->id)->first();
        $review_helpful->delete();

        return $this;
    }

    public function ownBy($user_id){
        $review = $this->where(function($query) use ($user_id){
            $query->where('user_id',$user_id);
            $query->where('id',$this->id);
        })->first();
        return !empty($review) ? true : false;
    }
}

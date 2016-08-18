<?php 
    namespace App\Eatnshare\Traits;
    
    
    use App\Notification;
    use App\Recipe;
    use App\Review;
    use App\ReviewUserHelpful;
    use Auth;

    trait NotificationTraits
    {
        private $notification;

        public function addNotification($model){
            $notification = Notification::create([
                'user_id' => $model->user_id,
                'url'     => $this->getUrlForNotification($model),
                'status'  => 'unread',
                'message' => Auth::user()->present()->fullname . ' ' . $this->getMessageForNotification($model)
            ]);

            return $notification;
        }

        public function getMessageForNotification($model){
            $message = '';
            if($model instanceof Recipe){
                $message = 'submits a review on your recipe';
            }elseif ($model instanceof Review){
                $message = 'finds your review helpful';
            }

            return $message;
        }

        public function getUrlForNotification($model){
            $url = '';
            if($model instanceof Recipe){
                $url = 'recipe/' . $model->slug;
            }elseif ($model instanceof Review){
                $recipe = $model->recipe()->first();
                $url = 'recipe/' . $recipe->slug;
            }

            return $url;
        }
    }
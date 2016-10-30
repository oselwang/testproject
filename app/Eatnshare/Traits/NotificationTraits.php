<?php 
    namespace App\Eatnshare\Traits;
    
    
    use App\Follow;
    use App\Notification;
    use App\Recipe;
    use App\Review;
    use App\User;
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
            }elseif ($model instanceof Follow){
                $message = 'started following you';
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
            }elseif($model instanceof Follow){
                $user = new User();
                $user = $user->where('id',$model->follower_id)->first();
                $user = empty($user->facebook_id) ? $user->username : intval($user->facebook_id);
                $url = 'account/' . $user;
            }

            return $url;
        }
    }
<?php

namespace App\Eatnshare\Repositories;


use App\CoverPhoto;
use App\ProfilePhoto;
use App\User;
use Auth;
use File;
use Illuminate\Http\Request;
use Intervention\Image\Exception\NotWritableException;
use Intervention\Image\ImageManagerStatic as Image;

class UserRepository
{

    protected $request;
    protected $profile_photo;
    protected $cover_photo;
    protected $user;

    public function __construct(Request $request, ProfilePhoto $profilePhoto, CoverPhoto $coverPhoto, User $user)
    {
        $this->user = $user;
        $this->request = $request;
        $this->cover_photo = $coverPhoto;
        $this->profile_photo = $profilePhoto;
    }

    public function changeProfilePhoto($profile_photo)
    {
        $originalname = rtrim($profile_photo->getClientOriginalName(),$profile_photo->getClientOriginalExtension());

        $user = Auth::user();

        $old_profile_photo = Auth::user()->profilephoto()->first();

        $image_name = $originalname . '-' . time() . '-' . $user->firstname . '-' . $user->lastname . '.' . $profile_photo->getClientOriginalExtension();

        $path = public_path('User/ProfilePhoto/' . $image_name);

        if ( !empty($old_profile_photo->photo_name) ) {
            try {
                File::delete($old_profile_photo->photo_name);
            } catch ( \Exception $e ) {
            }
            $this->resizePhoto($path, 280, 200, $profile_photo, $image_name);
            $old_profile_photo->photo_name = 'User/ProfilePhoto/' . $image_name;
            $old_profile_photo->save();

            return $image_name;
        } else {
            $this->resizePhoto($path, 280, 200, $profile_photo, $image_name);

            $this->profile_photo->create([
                'user_id'    => $user->id,
                'photo_name' => 'User/ProfilePhoto/' . $image_name
            ]);

            return $image_name;
        }
    }

    public function changeCoverPhoto($cover_photo)
    {
        $originalname = rtrim($cover_photo->getClientOriginalName(),$cover_photo->getClientOriginalExtension());

        $user = Auth::user();

        $old_cover_photo = Auth::user()->coverphoto()->first();

        $image_name = $originalname .'-' . time() .'-' . $user->firstname . '-' . $user->lastname . '.' . $cover_photo->getClientOriginalExtension();

        $path = public_path('User/CoverPhoto/' . $image_name);

        if ( !empty($old_cover_photo->photo_name) ) {
            try {
                File::delete($old_cover_photo->photo_name);
            } catch ( \Exception $e ) {
            }
            $this->resizePhoto($path, 1360, 300, $cover_photo, $image_name);
            $old_cover_photo->photo_name = 'User/CoverPhoto/' . $image_name;
            $old_cover_photo->save();

            return $image_name;
        } else {
            $this->resizePhoto($path, 1360, 300, $cover_photo, $image_name);

            $this->cover_photo->create([
                'user_id'    => $user->id,
                'photo_name' => 'User/CoverPhoto/' . $image_name
            ]);

            return $image_name;
        }
    }

    public function createFacebookAccount($user)
    {
        $name = explode(' ', $user[ 'name' ]);

        $firstname = $name[ 0 ];
        $lastname = '';
        for ( $i = 1; $i < count($name); $i++ ) {
            $lastname = $name[ $i ];
        }

        $authUser = $this->user->create([
            'facebook_id' => $user['id'],
            'firstname'   => $firstname,
            'lastname'    => $lastname,
            'email'       => $user[ 'email' ],
            'gender'      => $user[ 'gender' ],
            'confirmed'   => true
        ]);
        
        Auth::login($authUser);

        return $authUser;
    }


    public function resizePhoto($path, $width = 0, $height = 0, $photo_file, $image_name)
    {
        try {
            Image::make($photo_file->getRealPath())->resize($width, $height)->save($path);
        } catch ( NotWritableException $e ) {
            $directory = rtrim($path, $image_name);
            File::makeDirectory($directory, $mode = 0777, true, true);
        } finally {
            return Image::make($photo_file->getRealPath())->resize($width, $height)->save($path);
        }

    }

}
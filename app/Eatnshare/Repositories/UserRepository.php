<?php

    namespace App\Eatnshare\Repositories;


    use Auth;
    use App\ProfilePhoto;
    use Illuminate\Http\Request;
    use File;
    use Intervention\Image\ImageManagerStatic as Image;

    class UserRepository
    {

        protected $request;
        protected $profile_photo;

        public function __construct(Request $request, ProfilePhoto $profilePhoto)
        {
            $this->request = $request;
            $this->profile_photo = $profilePhoto;
        }

        public function changeProfilePhoto($profile_photo)
        {
            $user = Auth::user();

            $old_profile_photo = Auth::user()->profilephoto()->first();

            $extension = $profile_photo->getClientOriginalExtension();

            $image_name = time() . $user->firstname . '-' . $user->lastname . '.' . $extension;

            $path = public_path('User/ProfilePhoto/' . $image_name);

            if (!empty($old_profile_photo->photo_name)) {
                try {
                    File::delete($old_profile_photo->photo_name);
                } catch (\Exception $e) {
                }
                $this->resizePhoto($path, 280, 200, $profile_photo);
                $old_profile_photo->photo_name = 'User/ProfilePhoto/' . $image_name;
                $old_profile_photo->save();

                return $image_name;
            } else {
                $this->resizePhoto($path, 280, 200, $profile_photo);

                $this->profile_photo->create([
                    'user_id'    => $user->id,
                    'photo_name' => 'User/ProfilePhoto/' . $image_name
                ]);

                return $image_name;
            }
        }

        public function resizePhoto($path, $width, $height, $photo_file)
        {
            return Image::make($photo_file->getRealPath())->resize($width, $height)->save($path);
        }

    }
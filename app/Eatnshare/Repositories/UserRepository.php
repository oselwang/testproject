<?php

    namespace App\Eatnshare\Repositories;

    use App\Eatnshare\Interfaces\ChangeAblePhoto;
    use Auth;
    use Illuminate\Http\Request;
    use Intervention\Image\ImageManagerStatic as Image;

    class UserRepository implements ChangeAblePhoto
    {

        protected $request;
        public function __construct(Request $request)
        {
            $this->request = $request;
        }

        public function changeProfilePhoto()
        {
            $user = Auth::user();

            $profilephoto = $this->request->file('profilephoto');

            $extension = $profilephoto->getClientOriginalExtension();

            $image_name = time() . $user->firstname . '-' . $user->lastname .   '.' . $extension;

            $path = public_path('User/ProfilePhoto' . $image_name);

            Image::make($profilephoto->getRealPath())->resize(280, 200)->save($path);

            return $image_name;
        }

    }
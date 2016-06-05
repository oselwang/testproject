<?php

    namespace App\Http\Controllers;

    use App\Eatnshare\Request\AddRecipeForm;
    use App\Eatnshare\Request\RegisterPostForm;
    use App\Eatnshare\Services\UserService;
    use App\Events\UserForgotPassword;
    use App\Events\UserHasRegistered;
    use App\Http\Requests;
    use App\User;
    use Carbon\Carbon;
    use Auth;
    use Illuminate\Http\Request;

    class AjaxController extends Controller
    {

        protected $request;
        protected $user;
        protected $user_service;

        public function __construct(Request $request, User $user, UserService $user_service)
        {
            $this->request = $request;
            $this->user = $user;
            $this->user_service = $user_service;
            
        }

        public function recipeOfTheDay()
        {
            if (Carbon::now()->toTimeString() > "11:00:00") {
                return response()->json(false);
            }

            return response()->json(Carbon::now()->createFromTime(11, 0, 0)->toDateTimeString());
        }

        public function postRegister(RegisterPostForm $user)
        {

            $user_registered = $user->create();

            event(new UserHasRegistered($user_registered));

            flash('You need to verify your email address');

            return response()->json('success');
        }

        public function postLogin()
        {
            $credentials = [
                'username' => $this->request->get('username'),
                'password' => $this->request->get('password')
            ];

            if (Auth::attempt($credentials)) {
                flash("Welcome back, You're now logged in");

                return response()->json('success');
            }

            return 'fail';

        }

        public function forgotPassword()
        {
            $user = $this->user->whereUsername($this->request->get('username'))->firstOrFail();

            if ($user->email != $this->request->get('email')) {
                $message = 'fail';
            } else {
                $event = event(new UserForgotPassword($user));
                $user->password = bcrypt($event[0]);
                $user->save();

                return response()->json($user);
            }

            return $message;
        }

        public function addRecipe(AddRecipeForm $recipeForm)
        {
            $this->middleware('auth');
            $recipeForm->create();

            flash('Your recipe successfully created, edit it in your recipe menu');

            return response()->json('success');
        }

        public function changeProfilePhoto()
        {

            $profilephoto = $this->request->file('profilephoto');

            $this->user_service->changeProfilePhoto($profilephoto);

            flash('Profile Photo successfully changed');

            return response()->json('success');

        }

        public function changeCoverPhoto()
        {
            $cover_photo = $this->request->file('coverphoto');

            $this->user_service->changeCoverPhoto($cover_photo);

            flash('Cover Photo sucessfully changed');

            return response()->json('success');
        }
    }

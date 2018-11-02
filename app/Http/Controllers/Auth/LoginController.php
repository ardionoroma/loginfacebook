<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $facebook = Socialite::driver('facebook')->user();

        $find = User::whereEmail($facebook->getEmail())->first();
        if ($find) {
            $find->lastlogin = Carbon::now()->addHours(7);
            $find->save();
            Auth::login($find);
            return redirect('/home');
        } else {
            $user = new User;
            $user->name = $facebook->name;
            $user->email = $facebook->getEmail();
            $user->password = bcrypt(123456);
            $user->lastlogin = Carbon::now()->addHours(7);
            $user->profpic = $facebook->getAvatar();
            $user->save();

            Auth::login($user);
            return redirect('/home');
        }
    }
}

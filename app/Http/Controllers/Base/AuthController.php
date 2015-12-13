<?php

namespace App\Http\Controllers\Base;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('ban');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getRegisterAction()
    {
        return view('base.register');
    }

    public function postRegisterAction()
    {
        $rules = array(
            'user_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password-confirmation' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return redirect('/register')->withErrors(array("Не все поля были заполнены."));
        }
        if(Input::get('password') != Input::get('password_confirmation')){
            return redirect('/register')->withErrors(array("Введенные пароли не совпадают."));
        }
        User::create([
            'user_name' => Input::get('user_name'),
            'email' => Input::get('email'),
            'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
        ]);
        return redirect('/');
    }

    public function getLoginAction()
    {
        if (Auth::check())
        {
            return redirect('/');
        }
        $pre_url = $_SERVER['HTTP_REFERER'];
        return view('base.login', ['url' => $pre_url]);
    }

    public function postLoginAction()
    {
        $rules = array('user_name' => 'required', 'password' => 'required');
        $validator = Validator::make(Input::all(), $rules);
        $pre_url = Input::get('url');
        if($validator->fails()){
            return redirect()->route('user-login')->withErrors(array("Введите логин и пароль."));
        }
        $auth = Auth::attempt(array(
            'user_name' => Input::get('user_name'),
            'password' => Input::get('password'),
        ), false);
        if(! $auth){
            return redirect()->route('user-login')->withErrors(array("Ошибка авторизации."));
        }
        if (Auth::user()->banning_points > 5)
        {
            Auth::logout();
            return redirect()->route('user-login')->withErrors(array("Вы были заблокированы за нарушение правил сайта."));
        }
        return redirect('/');
    }


    public function logoutAction()
    {
        if(! Auth::user()){
            return redirect('/login');
        }
        Auth::logout();
        return redirect('/');
        //return redirect(Input::get('url'));
    }
}

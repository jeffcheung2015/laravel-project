<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function validator(){

    }

    public function processReq(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');

        $checkUsername = DB::table("users")->where(
            'username', $username)->first();

        if(count($checkUsername) > 0){
            if(Hash::Check($password, $checkUsername->password)){
                $request->session()->put('username', $username);
                return redirect('/');
            }
        }
        return redirect('/loginRegis');
    }

    public function logoutReq(){
        
        Session::flush();
        return redirect('/');
    }



}

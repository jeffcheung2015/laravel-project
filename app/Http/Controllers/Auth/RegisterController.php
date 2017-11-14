<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest'); 
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     
    protected function validator(array $data)
    {
   
    }
    */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return DB::table('users')->insert(
            [            
                'age' => $data['age'],
                'name' => $data['name'],
                'gender'=>$data['gender'],            
                'email' => $data['email'],
                'username'=>$data['username'],
                'password' => bcrypt($data['password']),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        );         
    }

    protected function processReq(Request $request){
        $dataArr = [
            "age" => $request->input('age'),
            "name" => $request->input('name'),
            "gender" => $request->input('gender'),
            "email" => $request->input('email'),
            "username" => $request->input('username'),
            "password" => $request->input('password'),
        ];
        $validator = Validator::make($dataArr, [
            'age' => 'required|Integer|min:1',  
            'name' => 'required|string|max:32',
            'gender' => 'required|string',
            'username' => 'required|string|min:1|unique:users',                        
            'email' => 'required|string|email|max:64|unique:users',            
            'password' => 'required|string|min:8'
        ]);
        if ($validator->fails()) {
            return redirect('/loginRegis');
        }

        $this->create($dataArr);

        $request->session()->put('username', $request->input('username'));

        return redirect("/");
    }
}

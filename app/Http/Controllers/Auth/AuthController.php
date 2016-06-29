<?php

namespace App\Http\Controllers\Auth;

use App\User;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function authenticate(Request $request){
        $credentials = $request::only('email','password');

        try{
            if(! $token = JWTAuth::attempt($credentials)){
                return $this->response->errorUnauthorized();
            }
        } catch (JWTException $ex){
            return $this->response->errorInternal();
        }

        return $this->response->array(compact('token'))->setStatusCode(200);

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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}

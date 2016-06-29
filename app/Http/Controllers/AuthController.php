<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth as JWTAuth;

class AuthController extends Controller
{
    public function authenticate(Request $request){
        $credentials = $request::only('email','password');

        try{
            if(! $token = \Tymon\JWTAuth\Facades\JWTAuth::attempt($credentials)){

                return "error: Unauthorized" ;
            }
        } catch (JWTException $ex){
            return "error: internal" ;
        }

        return compact('token') ;

    }

    public function index(){

//        return User::all();

        $data = [
            'id' => 1,
            'name' => 'test',
            'desc' => 'Hello World'
        ];

        \Tymon\JWTAuth\Facades\JWTAuth::attempt($data) ;
        return compact('token');
    }



    public function show(){

        try{
            $user = \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->toUser();
            if(! $user){
                return "error: User not found" ;
            }
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $ex){
            return "error: User not found" ;
        }

        return compact('user');

    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if($validator->passes()) {
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                $token = Auth::user()->createToken('api_token')->accessToken;
                $data = array(
                    'name' => Auth::user()->name , 
                    'email' => Auth::user()->email , 
                    'token' => $token , 
                );
                return ['status_code' => 200 , 'message' => 'Login Success !','data' => $data];
            }else{
                return ['status_code' => 201 , 'message' => 'Wrong email or password !'];
            }
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
}

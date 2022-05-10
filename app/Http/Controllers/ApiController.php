<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ApiController extends Controller
{
    public $successStatus = 200;

    /**
    * login api
    *
    * @return \Illuminate\Http\Response
    */
   public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['roleId'] = Auth::user()->role_id;
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
    * details api
    *
    * @return \Illuminate\Http\Response
    */
    public function getDetails()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {        
        if (Auth::check()) {
            $token = Auth::user()->token();
            $token->revoke();
            return response()->json(['status'=>'Logged out'], $this->successStatus);
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401);
        } 
    }
}

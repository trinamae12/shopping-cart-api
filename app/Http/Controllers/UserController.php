<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    
    public function index() {
        return User::all();
    }

    public function store(Request $request) {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        return response()->json(['success'=>$success], $this->successStatus);
    }
}

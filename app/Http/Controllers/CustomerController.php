<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public $successStatus = 200;

    public function index() {
        return response()->json(['success' => 'Customer Dashboard'], $this->successStatus);
    }
}

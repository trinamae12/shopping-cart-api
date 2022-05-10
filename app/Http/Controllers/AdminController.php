<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public $successStatus = 200;

    public function index() {
        return response()->json(['success' => 'Admin Dashboard'], $this->successStatus);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public $successStatus = 200;

    public function index() {
        return response()->json(['success' => 'Seller Dashboard'], $this->successStatus);
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeCustController extends Controller
{
    public function home()
    {
        return view('customer.home');
    }

    public function homee()
    {
        return view('customer.homee');
    }
}
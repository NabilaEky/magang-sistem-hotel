<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\KeluhanCust;

class DetailCustController extends Controller
{
    public function show($id)
    {
        $keluhan = KeluhanCust::findOrFail($id);

        return view('customer.detail', compact('keluhan'));
    }
}
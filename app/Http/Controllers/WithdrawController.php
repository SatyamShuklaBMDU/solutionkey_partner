<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index()
    {
        return view('withdraw.withdraw_index');
    }
}

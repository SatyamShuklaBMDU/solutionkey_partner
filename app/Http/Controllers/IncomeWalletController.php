<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncomeWalletController extends Controller
{
    public function index()
    {
        return view('income_wallet.index');
    }
}

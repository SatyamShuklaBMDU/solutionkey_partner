<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagerController extends Controller
{
    public function index()
    {
        return view('UserMaster.add_user');
    }

    public function show()
    {
        return view('UserMaster.all_user');
    }
}

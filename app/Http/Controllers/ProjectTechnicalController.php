<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectTechnicalController extends Controller
{
    public function index(){
        return view('projects.project_technical');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectDocumentController extends Controller
{
    public function index()
    {
        return view('projects.project_document');
    }
}

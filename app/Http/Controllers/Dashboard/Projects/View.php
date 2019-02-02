<?php

namespace App\Http\Controllers\Dashboard\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

class View extends Controller
{
    
    function index () {

        $projects = Project::paginate(15);

        return view('dashboard.projects.viewprojects', ['projects' => $projects]);

    }

}

<?php

namespace App\Http\Controllers\Dashboard\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Input;
use App\Project;

class View extends Controller
{
    
    public function index () {

        //Get search field data
        $search = Input::get("search");

        //Check if search filed contains anything
        if (!empty($search)) {

            //Get all projects with a name similar to the search input and paginate them
            $projects = Project::where("project_name", 'LIKE', "%$search%")
            ->paginate(15);

            //Append the search field URL GET parameters to the paginaation
            $projects->appends(request()->input())->links();

        }
        else {
            $projects = Project::paginate(15);
        }

        //Return "Dashborad.Projects.View" with projects data.
        return view('dashboard.projects.viewprojects', ['projects' => $projects]);

    }

}

<?php

namespace App\Http\Controllers\Dashboard\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

class DeleteProjectController extends Controller
{

    public function index ($projectID) {

        $projectData = Project::where("id", $projectID)->first();

        $projectName = $projectData->project_name;

        return view ('dashboard.projects.deleteprojectconfirm', ['projectName' => $projectName]);

    }

}

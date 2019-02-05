<?php

namespace App\Http\Controllers\Dashboard\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Input;
use App\Project;
use Auth;

class View extends Controller
{

    public function itemPerPageAmountSelect (Request $request) {

        if (Auth::user()) {

            if (!$request["items-per-page-select"] == NULL) {

                $request->validate([
                    'items-per-page-select'=>'between:1,3|numeric'
                ]);
                
                if ($request["items-per-page-select"] == 1) {
                    session(['viewProjectsPageItemsPerPage' => 15]);
                }
                elseif ($request["items-per-page-select"] == 2) {
                    session(['viewProjectsPageItemsPerPage' => 30]);
                }
                elseif ($request["items-per-page-select"] == 3) {
                    session(['viewProjectsPageItemsPerPage' => 50]);
                }
                else {
                    session(['viewProjectsPageItemsPerPage' => 15]);
                }

            }
            
            return redirect()->route('projectsView');

        }

    }
    
    public function index () {

        $paginationItemsPerPage = session('viewProjectsPageItemsPerPage');

        //Get search field data
        $search = Input::get("search");

        //Check if search filed contains anything
        if (!empty($search)) {

            //Get all projects with a name similar to the search input and paginate them
            $projects = Project::where("project_name", 'LIKE', "%$search%")
            ->paginate($paginationItemsPerPage);

            //Append the search field URL GET parameters to the paginaation
            $projects->appends(request()->input())->links();

        }
        else {
            $projects = Project::paginate($paginationItemsPerPage);
        }

        //Return "Dashborad.Projects.View" with projects data.
        return view('dashboard.projects.viewprojects', ['projects' => $projects]);

    }

}

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

                session(['viewProjectsPageItemsPerPage' => 15]);
                
                if ($request["items-per-page-select"] == 1) {
                    session(['viewProjectsPageItemsPerPage' => 15]);
                }

                if ($request["items-per-page-select"] == 2) {
                    session(['viewProjectsPageItemsPerPage' => 30]);
                }
                
                if ($request["items-per-page-select"] == 3) {
                    session(['viewProjectsPageItemsPerPage' => 50]);
                }

            }
            
            return redirect()->route('projectsView');

        }

    }
    
    public function index () {

        $itemsPerPage = session('viewProjectsPageItemsPerPage');

        //Get all data from get forms
        $search = Input::get("search");
        $sortBy = Input::get("sort-by");
        
        $field = "id";
        $sortOption = "asc";

        if ($sortBy == 1) {
            $field = "project_name";
            $sortOption = "asc";
        }

        if ($sortBy == 2) {
            $field = "project_name";
            $sortOption = "desc";
        }
        
        if ($sortBy == 3) {
            $field = "id";
            $sortOption = "asc";
        }

        if ($sortBy == 4) {
            $field = "id";
            $sortOption = "desc";
        }

        //Check if search filed contains anything
        if (!empty($search) || !empty($sortBy)) {

            //Get all projects with a name similar to the search input and paginate them
            $projects = Project::where("project_name", 'LIKE', "%$search%")
            ->orderBy($field, $sortOption)
            ->paginate($itemsPerPage);

            //Append the search field URL GET parameters to the pagination
            //$projects->appends(request()->input())->links();
            $projects->appends(['search' => $search, 'sort-by' => $sortBy])->render();

            //Return "Dashborad.Projects.View" with projects data.
            return view('dashboard.projects.viewprojects', ['projects' => $projects]);

        }

        //Get all projects        
        $projects = Project::paginate($itemsPerPage);

        //Return "Dashborad.Projects.View" with projects data.
        return view('dashboard.projects.viewprojects', ['projects' => $projects]);

    }

}

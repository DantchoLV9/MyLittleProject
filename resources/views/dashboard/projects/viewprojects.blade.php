@extends('dashboard.layouts.app')
@extends('dashboard.layouts.navigationbar')
@extends('dashboard.layouts.sidenavigationbar')
@extends('dashboard.layouts.pagedetails')
@section('pagetitle', 'Projects')

@section('content')

        
        <div class="card border-secondary bg-light mt-3">
          <div class="card-header">
            Projects
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Project ID</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Project Description</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($projects as $project)
                  <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <th scope="row">{{ $project->project_name }}</th>
                    <th scope="row">{{ $project->project_description }}</th>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            {{ $projects->links() }}
          </div>
        </div>

@endsection
@extends('dashboard.layouts.app')
@extends('dashboard.layouts.navigationbar')
@extends('dashboard.layouts.sidenavigationbar')
@extends('dashboard.layouts.pagedetails')
@section('pagetitle', 'General Settings')

@section('content')

        <div class="card border-secondary bg-light mt-3">
          <div class="card-header">
            General Settings
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="formGroupExampleInput">Website Name</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Website Name">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Website Address</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Website Address">
              </div>
              <input type="submit" class="btn btn-primary" id="formGroupExampleInput2" placeholder="Another input">
            </form>
          </div>
        </div>

@endsection
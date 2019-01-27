@extends('layouts.app')
@extends('layouts.navigationbar')
@extends('layouts.footer')

@section('content')

    <section class="container">

      @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
          {{ session('status') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      <div class="card border-secondary bg-light mt-3">
        <div class="card-header">
          My Profile
        </div>
        <div class="card-body">
          <div class="text-center">
            <div data-toggle="modal" data-target="#avatarModal">
              <img id="avatar" data-toggle="tooltip" data-placement="auto" title="Click to Upload!" class="avatar rounded-circle border border-dark img-thumbnail" alt="Profile Picture" src="{{ Storage::url('avatars/' . Auth::user()->avatar) }}">
            </div>
            <div class="modal fade" id="avatarModal" role="dialog" aria-labelledby="avatarModalLabel" aria-hidden="true">>
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="avatarModalLabel">Change Avatar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form enctype="multipart/form-data" method="post" action="{{ route('updateUserAvatar', ['username' => mb_strtolower(Auth::user()->username, 'UTF-8')]) }}">

                      @csrf

                      <div class="custom-file mb-3">
                        <input type="file" name="avatar" class="custom-file-input" id="avatarCustomFileUpload">
                        <label class="custom-file-label" for="avatarCustomFileUpload">Choose file...</label>
                      </div>
                    
                      <button name="reset" value="true" type="submit" class="btn btn-primary">Delete</button>
                      <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <h1>{{ Auth::user()->username }}</h1>
            <p>{{ Auth::user()->email }}</p>
          </div>
          <form enctype="multipart/form-data" method="post" action="{{ route('profile', ['username' => mb_strtolower(Auth::user()->username, 'UTF-8')]) }}">
            
            @csrf
            
            <div class="form-group row">
              <label for="inputUsername" class="col-md-4 col-form-label text-md-right">Username</label>
              
              <div class="col-md-6">
                <input type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="inputUsername" value="{{ Auth::user()->username }}" placeholder="Username">
              
                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail" class="col-md-4 col-form-label text-md-right">Email</label>

              <div class="col-md-6">
                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="inputEmail" value="{{ Auth::user()->email }}" placeholder="Email">
                
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="inputNewPassword" class="col-md-4 col-form-label text-md-right">New Password</label>

              <div class="col-md-6">
                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="inputNewPassword" placeholder="New Password">

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="inputConfirmNewPassword" class="col-md-4 col-form-label text-md-right">Confirm New Password</label>

              <div class="col-md-6">
                <input type="password" name="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="inputConfirmNewPassword" placeholder="Confirm New Password">

                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="inputCurrentPassword" class="col-md-4 col-form-label text-md-right">Current Password</label>

              <div class="col-md-6">
                <input type="password" name="current_password" class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" id="inputCurrentPassword" placeholder="Current Password">

                @if ($errors->has('current_password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('current_password') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>    

@endsection
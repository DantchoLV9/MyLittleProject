@extends('layouts.app')
@extends('layouts.navigationbar')
@extends('layouts.footer')

@section('content')

    <section class="container">
      <div class="card border-secondary bg-light mt-3">
        <div class="card-header">
          {{ $username }}'s Profile
        </div>
        <div class="card-body">
          <div class="text-center">
            <img id="avatar" class="avatar rounded-circle border border-dark img-thumbnail" alt="Profile Picture" src="{{ Storage::url('avatars/' . $avatar) }}">
            <h1>{{ $username }}</h1>
            <p class="mb-0">{{ $email }}</p>
          </div>
        </div>
      </div>
    </section>    

@endsection
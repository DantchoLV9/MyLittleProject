@extends('layouts.app')
@extends('layouts.navigationbar')
@extends('layouts.footer')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('resent'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card border-secondary bg-light mt-3">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

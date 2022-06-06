@extends('layouts.auth')

@section('content')
<div class="container guest-account">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="e-card">
                <div class="card-body"> 
                    <div class="e-card-title">{{ __('Verify Your Email Address') }}</div>
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="e-btn e-btn-dark">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

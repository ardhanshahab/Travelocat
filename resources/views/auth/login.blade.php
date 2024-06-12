@extends('layouts.template')
@section('content')
<div class="bg-auth">  
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-white" style="border-radius: 1rem; background:#5AB2FF;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-4 pb-5">
                            <div class="d-flex flex-column align-items-center">
                                <h1 style="color: #000">Login</h1>
                                <div class="text-center" style="color: #000" >
                                    <br>Silahkan login di bawah ini!
                                </div>
                                <form method="POST" action="{{ route('login') }}" class="form-auth">
                                @csrf
                                <div class="mt-5">
                                    <input id="email" type="email" class="form-input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="current-email" autofocus placeholder="Email Address">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <input id="password" type="password" class="form-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" autofocus placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div><br>
                                {{-- @if (Route::has('password.request'))
                                <a class="btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif --}}
                                <br>
                                <button type="submit" class="btn btn-outline mt-2">
                                    {{ __('Sign In') }}
                                </button>
                                <p class="mt-2"  style="color: #000">Don't have an account??
                                    <a href="{{ route('register') }}" class="text-decoration-none" style="color: black"> Register here</a>
                                </p>
                            </div>
                        </div>       
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>        
@endsection
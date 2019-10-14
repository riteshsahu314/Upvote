@extends('layouts.app')

@section('content')
<div class="container p-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <div class="text-center row justify-content-center">
                        <div>
                            <div class="border px-5 py-2 rounded box-shadow mb-2">
                                <a href="{{ url('/login/github') }}" class="social__btn social__btn--github">
                                    <h4 class="m-0">
                                        <i class="fab fa-lg fa-github mr-3"></i><span>Signup with Github</span>
                                    </h4>
                                </a>
                            </div>

                            <div class="border px-5 py-2 rounded box-shadow mb-2">
                                <a href="{{ url('/login/google') }}" class="social__btn social__btn--google">
                                    <h4 class="m-0">
                                        <i class="fab fa-lg fa-google mr-3"></i><span>Signup with Google</span>
                                    </h4>
                                </a>
                            </div>

                            <div class="border px-5 py-2 rounded box-shadow">
                                <a href="{{ url('/login/facebook') }}" class="social__btn social__btn--facebook">
                                    <h4 class="m-0">
                                        <i class="fab fa-lg fa-facebook mr-3"></i><span>Signup with Facebook</span>
                                    </h4>
                                </a>
                            </div>                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

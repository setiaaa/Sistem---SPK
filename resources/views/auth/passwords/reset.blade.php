@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-2">
            <div class="card">
                <div class="card-header"> 
                    <a href="{{ route('login') }}">
                        {!! file_get_contents('icons/arrow-circle-left.svg') !!}
                    </a>
                    {{ __('Reset Password') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-control">
                                <label for="email" class="text-md-end">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control 
                                @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" 
                                required autocomplete="email" 
                                placeholder="Masukan alamat emailmu" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password" class="form-control 
                                @error('password') is-invalid @enderror" name="password" 
                                required autocomplete="new-password"
                                placeholder="Paling tidak 8 karakter">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-control">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

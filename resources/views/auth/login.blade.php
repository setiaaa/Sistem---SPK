@extends('Component.layout')



@section('content')
        <div class=" p-0 main-container vw-100 vh-100">
            <div class="d-flex vw-100 h-100">
                <div class="login-form col-lg-4 h-100">
                    <div class="d-flex flex-column row justify-content-center h-100">
                        <div class="login-form-container vw-100 ps-5 pe-5 pb-5" >
                            <div class="image mb-3">
                                <img src="img/logo_percetakan_bandung.svg" alt="">
                            </div>
                            <div class="">
                                <h4 class="login-text-1">Masuk</h1>
                                <h6 class="login-text-2 mb-3">Masuk ke akun Anda</h1>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="email">Masukan alamat emailmu</label>
                                    <input id="email" type="email" class="form-control 
                                    @error('email') is-invalid @enderror" name="email" 
                                    value="{{ old('email') }}" required autocomplete="email" placeholder="Masukan alamat emailmu" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Masukan kata sandimu</label>
                                    <input id="password" type="password" class="form-control 
                                    @error('password') is-invalid @enderror" name="password" 
                                    required autocomplete="current-password" placeholder="Paling tidak 8 karakter">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
                                {{-- <div class="form-group mb-3">
                                    <div class="">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div> --}}
                                @if (Route::has('password.request'))
                                    <div class="form-group mb-3 text-end">
                                        <a class="text-decoration-none " class="btn btn-link" href="{{ route('password.request') }}">
                                            {{-- {{ __('Forgot Your Password?') }} --}}Lupa Kata Sandi
                                        </a>
                                    </div>
                                    
                                @endif
                                <button type="submit" class="btn btn-primary">
                                    {{-- {{ __('Login') }} --}}Masuk
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="login-hero-image col-lg-8 text-center">
                    <div class="d-flex flex-column align-items-center justify-content-center container h-100 pt-5">
                        <h6 class="greeting-text-1">Senang melihatmu lagi</h6>
                        <h3 class="fw-medium greeting-text-2">Selamat datang kembali</h1>
                        <img src="img/printing-invoices-rafiki-1.svg" width="464vw" alt="">
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Login') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
        
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
        
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
@endsection
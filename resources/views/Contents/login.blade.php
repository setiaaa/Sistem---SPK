@extends('Component.app')

@section('content')

        <!-- Outer Row -->
        {{-- <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6">
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class=" p-0 main-container vw-100 vh-100">
            <div class="d-flex vw-100 h-100">
                <div class="login-form col-lg-4 w-100 h-100">
                    <div class="d-flex flex-column row justify-content-center h-100">
                        <div class="login-form-container vw-100 ps-5 pe-5 pb-5" >
                            <div class="image mb-3">
                                <img src="img/logo_percetakan_bandung.svg" width="200px" alt="">
                            </div>
                            <div class="">
                                <h4 class="login-text-1">Masuk</h1>
                                <h6 class="login-text-2 mb-3">Masuk ke akun Anda</h1>
                            </div>
                            <form class="user">
                                
                                <div class="form-group">
                                    <label for="email">Masukan username alamat emailmu</label>
                                    <input type="email" class="form-control"
                                        id="email" aria-describedby="emailHelp"
                                        placeholder="username_ atau nama@contoh.com">
                                </div>
                                <div class="form-group">
                                    <label for="password">Masukan kata sandimu</label>
                                    <input type="password" class="form-control"
                                        id="password" placeholder="Paling tidak 8 karakter">
                                </div>
                                <div class="form-group text-right">
                                    <a class="text-decoration-none" href="">Lupa kata sandi?</a>
                                </div>
                                <br>
                                <a href="index.html" class="btn btn-primary btn-block">
                                    Masuk
                                </a>
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

    {{-- Bootsrap core JavaScript --}}
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/bootstrap/sb-admin-2.min.js"></script>
@endsection
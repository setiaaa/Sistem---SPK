@extends('Layouts.layout')

@section('content')

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <label for="exampleInputEmail">Masukan username alamat emailmu</label>
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="username_ atau nama@contoh.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword">Masukan kata sandimu</label>
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Paling tidak 8 karakter">
                                        </div>
                                        <a href="index.html" class="btn Primary-70 btn-block">
                                            Masuk
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
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
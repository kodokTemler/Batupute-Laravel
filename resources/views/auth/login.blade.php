<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo/barru.png') }}">
    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <style>
    .logo-img {
        max-width: 250px;
        border-radius: 12px; /* Sesuaikan jika ingin rounded */
        transition: transform 0.3s ease-in-out;
    }

    .logo-img:hover {
        transform: scale(1.1); /* Membesar halus */
    }
    
    @media (max-width: 992px) {
        .logo-img {
            max-width: 180px;
        }
    }
        
    input[type="password"]::-ms-reveal,
    input[type="password"]::-ms-clear {
        display: none;
    }
    </style>
    
</head>

<body class="bg-gradient-success">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center p-4">
                                <img src="{{ asset('assets/img/logo/barru.png') }}" alt="Logo" class="logo-img">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form class="user" action="{{route('login.process')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Email" required>
                                        </div>
                                        <div class="form-group position-relative">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                                            <span toggle="#password" class="fas fa-eye field-icon toggle-password" style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;"></span>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                    @if ($errors->has('email') || $errors->has('password'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <p><strong>Login gagal!</strong> Email atau password salah.</p>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-between">
                                        <a class="small" href="{{route('index')}}">Back</a>
                                        <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.querySelector('.toggle-password');
        const password = document.querySelector('#password');

        toggle.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>

</body>

</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo/barru.png') }}"> 
    <title>Document</title>
</head>
<body>
    <form action="{{route('login.process')}}" method="POST">
        @csrf
        <input type="email" name="email" id="email" required placeholder="oca@gmail.com">
        <input type="password" name="password" id="password" required>

        <button type="submit">Login</button>
    </form>

    <a href="/register">Registrasi</a>
</body>
</html> --}}
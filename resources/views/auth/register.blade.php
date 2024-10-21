<!-- template -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Rental Mobil</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/logos/favicon.png')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-primary">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <h3 class="text-center fw-bold text-primary">Selamat Datang di Rental Mobil</h3>
                                <p class="text-center">Daftar dibawah ini</p>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputtext1" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus id="exampleInputtext1" aria-describedby="textHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Re-Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" id="exampleInputPassword1">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Daftar</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-6 mb-0 fw-bold">Sudah punya akun?</p>
                                        @if (Route::has('login'))
                                        <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Masuk disini</a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @error('name')
    <script>
        Swal.fire({
                title: "{{$message}}",
                icon: "error"
            });
    </script>
    @enderror
    @error('email')
    <script>
        Swal.fire({
                title: "{{$message}}",
                icon: "error"
            });
    </script>
    @enderror
    @error('password')
    <script>
        Swal.fire({
                title: "{{$message}}",
                icon: "error"
            });
    </script>
    @enderror
</body>

</html>
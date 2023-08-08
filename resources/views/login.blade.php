<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">


    <title>Login</title>
</head>

<body style="font-family: 'Inter', sans-serif;">

    <section class="vh-100 m-0 p-0 bg-primary">
        <div class="row m-0 p-0">
            <div class="col-xl-5 col-lg-6 col-md-12 col-12 d-flex bg-primary pt-4 p-0">
                <img src="{{ asset('/assets/img/svg/icon-market.svg') }}" width="80%" class="mt-auto mx-auto" alt="">
            </div>
            <div class="col-xl-7 col-lg-6 col-md-12 col-12 vh-100 d-flex justify-content-center" style="background-color: #fff;">
                <div class="my-auto ">
                    <h3 class="m-0"><b>Login</b></h3>
                    <p class="mt-0 mb-3 text-muted" style="font-size: 16px">Inventory PT. Imbang Tata Alam</p>
                    <form action="{{ route('authenticate') }}" method="post" class="mt-4 mb-4">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="floatingInput" placeholder="username" name="username" value="{{ old('username') }}" style="width: 350px">
                            <label for="floatingInput">Username</label>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" name="password" style="width: 350px">
                            <label for="floatingPassword">Password</label>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3" style="width: 100%;">Login</button>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('/bootstrap/js/bootstrap.bundle.min.js') }}" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('/alert/package/dist/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('/jquery/jquery.min.js') }}"></script>

    @if (session()->has('loginError'))
        <script>
            Swal.fire("Login Gagal", "{{ session('loginError') }}", "error");
        </script>
    @endif
    @if (session()->has('accessError'))
        <script>
            Swal.fire("Warning", "{{ session('accessError') }}", "error");
        </script>
    @endif
</body>

</html>

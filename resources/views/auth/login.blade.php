<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.min.css">
    <!-- swet alert -->
    <link rel="stylesheet" href="/plugins/sweetalert2/sweetalert2.min.css">
    <script src="/plugins/sweetalert2/sweetalert2.min.js"></script>
</head>

<body>
    <div class="row" style="margin-top: 10em;">
        <div class="col-sm-8  mx-auto ">
            @if (session('gagal'))
            <script>
                Swal.fire({
                        icon: 'error',
                        title: "{{ session('gagal') }}",
                        showConfirmButton: false,
                        timer: 2000
                        })
            </script>
            @endif
            @if (session('success'))
            <script>
                Swal.fire({
                        icon: 'success',
                        title: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 2000
                        })
            </script>
            @endif
            <div class="card shadow ">

                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <img src="images/login_page.png" width="100%" alt="login page">
                        </div>
                        <div class="col-md-7 py-5">
                            <h3 style="margin-bottom: -1px">Welcome Back !</h3>
                            <p class="mb-4">login to continue</p>
                            <form action="/actionlogin" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control"
                                        id="exampleInputPassword1">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn  btn-primary px-4 py-2">Login</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script src="plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
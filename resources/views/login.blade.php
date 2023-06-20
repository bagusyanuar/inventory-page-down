<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/css/adminlte.min.css')}}">
    <link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js')}}"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .full-height {
            height: 100vh;
            background-color: blue;
            margin: 0 0;
        }

        .left-panel {
            height: inherit;
            background-color: #3AA6B9;
        }

        .right-panel {
            height: inherit;
            background-color: white;
        }
    </style>
</head>
<body>
@if (\Illuminate\Support\Facades\Session::has('failed'))
    <script>
        Swal.fire("Gagal", '{{\Illuminate\Support\Facades\Session::get('failed')}}', "error")
    </script>
@endif
<div class="row full-height">
    <div class="col-lg-7 col-md-6 p-0 left-panel d-flex align-items-center justify-content-center">

    </div>
    <div class="col-lg-5 col-md-6 pl-5 pr-5 right-panel d-flex align-items-center justify-content-center">
        <div class="text-center">
            <img src="{{ asset('/assets/logo.png') }}" height="70" class="mb-3" alt="logo">
            <p class="mb-0" style="color: grey; font-size: 14px;">Selamat Datang Di Sistem Informasi Inventori Page Down
                Cloth Maker & Merch</p>
            <div class="form-login mt-3 pl-5 pr-5">
                <form method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-username">
                            <i class="fa fa-user-o" aria-hidden="true"></i>
                        </span>
                        </div>
                        <input type="text" placeholder="username" class="form-control" aria-label="Default"
                               aria-describedby="inputGroup-username" name="username">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-password">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        </div>
                        <input type="password" placeholder="password" class="form-control" aria-label="Default"
                               aria-describedby="inputGroup-password" name="password">
                    </div>
                    <hr>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-paper-plane mr-1"></i>
                            <span>Login</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script src="{{ asset('/jQuery/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset ('/adminlte/js/adminlte.js') }}"></script>
<script src="{{ asset('/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/datatables/dataTables.bootstrap4.min.js') }}"></script>
</body>
</html>

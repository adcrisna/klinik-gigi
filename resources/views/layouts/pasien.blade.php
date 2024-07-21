<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Klinik Gigi - {{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('template/lib/animate/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('template/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f1f7f7;
            height: 100%;
            width: 100%;
        }

        html,
        body {
            overflow-x: hidden;
        }

        @media screen and (max-width: 768px) {

            html,
            body {
                overflow-x: hidden;
            }
        }

        @media (max-width: 768px) {

            .newBackground,
            .content {
                width: 100%;
            }
        }

        .profile-dropdown {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 10px;
            border: 1px solid #3156A5;
            border-radius: 5px rgb(204, 204, 204);
            border-radius: 10px;
            width: 160px;
            height: 50px;
            margin-right: 20px;
        }

        .profile-dropdown img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            float: right;
        }
    </style>
    @yield('css')
</head>

<body>
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
        <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>Klinik @doktergigi_</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('pasien.index') }}" class="nav-item nav-link">Home</a>
                <a href="{{ route('pasien.service') }}" class="nav-item nav-link">Service</a>
                <a href="{{ route('pasien.about') }}" class="nav-item nav-link">About</a>
                <a href="{{ route('pasien.booking') }}" class="nav-item nav-link">Booking</a>
                <a href="{{ route('pasien.history') }}" class="nav-item nav-link">History</a>
            </div>
            &nbsp;
            <div class="profile-dropdown">
                <div class="nav-item dropdown">
                    <div class="row mt-3">
                        <div class="col-sm-1" style="margin: 0px !important">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                                style="padding: 0px !important"></a>
                            <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                                <a href="{{ route('pasien.profile') }}" class="dropdown-item">Account Settings</a>
                                <a href="{{ route('logout') }}" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                        <div class="col-sm-5" style="margin-right: 10px">
                            <p style="font-size: 10px !important; margin-top: 5px;">
                                {{ strtoupper(Auth::user()->name) }}</p>
                        </div>
                    </div>
                </div>
                <img src="{{ asset('foto/' . Auth::user()->foto) }}" alt="Foto Pengguna">
            </div>
        </div>
    </nav>
    <div class="bgContent">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('template/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('template/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('template/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('template/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('template/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('template/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('template/js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".close").click(function() {
                $("#alert").hide();
            });
        });
    </script>
    @yield('javascript')
</body>

</html>

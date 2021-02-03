<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                <!-- Navbar, hide nav-links to small breakpoint-->
                <nav class="shadow-sm navbar navbar-marketing navbar-expand-md bg-dark navbar-dark">
                    <!--change the direction of container to column-->
                    <div class="container d-flex flex-column">
                        @if (!Auth::check())
                        <a class="navbar-brand text-white" href="/home"><img class="img-fluid" width="390px" src="{{ asset('assets/img/logoname.png') }}" /></a>
                        <button class="navbar-toggler align-self-end" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!--nav-links-->
                        <div class="collapse navbar-collapse w-100" id="navbarNavAltMarkup">
                            <div class="navbar-nav text-center">
                                <a class="nav-item nav-link active ml-lg-3 border-left border-danger" href="#">Home <span class="sr-only">(current)</span></a>
                                <a class="nav-item nav-link ml-lg-3" href="#">Products</a>
                                <a class="nav-item nav-link ml-lg-3" href="#">Contact us</a>
                                <a class="nav-item nav-link ml-lg-3" href="#">About us</a>
                            </div>
                            <!--Postion login/register to left-->
                            <div class="login-register ml-auto text-center">
                                <a class="btn font-weight-500 mr-2 btn-primary" href="{{ route('login') }}">Login<i class="ml-2" data-feather="arrow-right"> </i></a><a class="btn font-weight-500 btn-primary" href="{{ route('register') }}">Join<i class="ml-2" data-feather="arrow-right"></i></a>                          
                            </div>
                        </div>
                        <!--end of nav-links-->
                        @elseif (Auth::check())
                        <a class="navbar-brand text-white" href="/home"><img class="img-fluid" width="390px" src="{{ asset('assets/img/logoname.png') }}" /></a>
                        <button class="navbar-toggler align-self-end" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse w-100" id="navbarNavAltMarkup">
                            <div class="navbar-nav text-center">
                                <a class="nav-item nav-link active ml-lg-3 border-left border-danger" href="#">Home <span class="sr-only">(current)</span></a>
                                <a class="nav-item nav-link ml-lg-3" href="#">Products</a>
                                <a class="nav-item nav-link ml-lg-3" href="#">Contact us</a>
                                <a class="nav-item nav-link ml-lg-3" href="#">About us</a>
                            </div>
                            <div class="btn-log ml-auto text-center">
                                <a class="btn font-weight-500 mr-2 btn-primary" href="{{ route('login') }}">Dashboard - Overview<i class="ml-2" data-feather="activity"> </i></a>
                            </div>
                        </div>
                        @endif
                    </div>
                </nav>
    
@yield('content')

        <section class="bg-dark py-15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="footer-brand">ONEX IT Solutions</div>
                        <div class="mb-3">We dream high, We aim high.</div>
                        <div class="icon-list-social mb-5">
                            <a class="icon-list-social-link" href="https://www.facebook.com/onexph"><i class="fab fa-facebook"></i></a>
                        </div>

                        <div class="mb-2">Copyright &copy; ONEX IT Solutions 2020</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>-->
        <script src="assets/demo/date-range-picker-demo.js"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init({
                disable: 'mobile',
                duration: 600,
                once: true,
            });
        </script>
    </body> 
</html>
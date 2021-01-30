<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url"           content="http://www.onex.ph" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="ONEX IT SOLUTIONS" />
    <meta property="og:description"   content="Start your E-loading business with ONEX for only &#8369;299. Sign up now and become our partner to success." />
    <meta property="og:image"         content="{{ asset('assets/img/banners/offers.png') }}" />

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon" type="image/x-icon" />

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Navbar-->
    <nav class="shadow-sm navbar navbar-marketing navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            @if (!Auth::check())
            <a class="navbar-brand text-white" href="/home"><img class="img-fluid" width="390px" src="{{ asset('assets/img/logoname.png') }}" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
            <div class="collapse navbar-collapse text-right" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mr-5"></ul>
                <a class="btn font-weight-500 mr-2 btn-primary" href="{{ route('login') }}">Login<i class="ml-2" data-feather="arrow-right"> </i></a><a class="btn font-weight-500 btn-primary" href="{{ route('register') }}">Join<i class="ml-2" data-feather="arrow-right"></i></a>                            
            </div>
            @elseif (Auth::check())
            <a class="navbar-brand text-white" href="/home"><img class="img-fluid" width="390px" src="{{ asset('assets/img/logoname.png') }}" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
            <div class="collapse navbar-collapse text-right" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mr-5"></ul>
                <a class="btn font-weight-500 mr-2 btn-primary" href="{{ route('login') }}">Dashboard - Overview<i class="ml-2" data-feather="activity"> </i></a>
            </div>
            @endif
        </div>
    </nav>

    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-primary shadow-sm" id="sidenavAccordion">
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle"><i data-feather="menu"></i></button>
        <ul class="navbar-nav align-items-center ml-auto">            
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="{{ $path }}" /></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="{{ $path }}" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name"><span class="text-capitalize">{{ $user->fname.' '.$user->lname }}</span><b>{{' @'.$user->uname }}</b></div>
                            <div class="dropdown-user-details-email">{{ $user->email }}</div>
                            <div class="dropdown-user-details-phone">{{ $user->phone }}</div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <div class="dropdown-item-icon"><i data-feather="user"></i></div>
                        Account
                    </a>
                    <a class="dropdown-item" href="#!">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        <span onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                        </span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-dark">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                        <!-- Sidenav Menu Heading (Core)-->
                        <div class="sidenav-menu-heading">Main Menu</div>
                        <!-- Sidenav Accordion (Dashboard)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboard
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse show" id="collapseDashboards" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link" href="{{ route('home') }}">
                                    Overview
                                    <!--<span class="badge badge-primary-soft text-primary ml-auto">Updated</span>-->
                                </a>
                                <a class="nav-link" href="{{ route('affiliates') }}">
                                    Affiliates
                                </a>
                                <a class="nav-link" href="#!">
                                    Earnings
                                    <span class="badge badge-primary-soft text-primary ml-auto">Maintenance</span>
                                </a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseAccount" aria-expanded="false" aria-controls="collapseAccount">
                            <div class="nav-link-icon"><i data-feather="tool"></i></div>
                            Account
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse show" id="collapseAccount" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link" href="{{ route('profile') }}">
                                    Profile
                                    <!--<span class="badge badge-primary-soft text-primary ml-auto">Updated</span>-->
                                </a>
                                <a class="nav-link" href="{{ route('payout') }}">Payout</a>
                                <a class="nav-link" href="{{ route('security') }}">Security</a>
                            </nav>
                        </div>
                </div>
                <!-- Sidenav Footer-->
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title"><span class="text-capitalize">{{ $user->fname.' '.$user->lname }}</span><b>{{ ' @'.$user->uname }}</b></div>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
        </div>
    </div>

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
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>-->
        <script src="assets/demo/date-range-picker-demo.js"></script>
        <script>
            AOS.init({
                disable: 'mobile',
                duration: 600,
                once: true,
            });
        </script>
    </body> 
</html>
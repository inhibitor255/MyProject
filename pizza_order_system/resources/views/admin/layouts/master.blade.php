<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css" rel="stylesheet') }}" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{ route('admin#listPage') }}">
                    <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{ route('admin#listPage') }}">
                                <button>
                                    <i class="fas fa-tachometer-alt"></i>Admins & Customers
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('category#list') }}">
                                <button>
                                    <i class="fas fa-chart-bar"></i>Category
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product#listPage') }}">
                                <button>
                                    <i class="zmdi zmdi-pizza"></i> Products
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('order#listPage') }}">
                                <button>
                                    <i class="zmdi zmdi-receipt"></i> Order
                                </button>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap row">
                        <button class="btn col-1 fs-5 btn btn-dark" onclick=" history.back()">
                            <i class="zmdi zmdi-long-arrow-left "></i>
                        </button>
                        <span class="form-header col-3 ">
                            <h4>Admin Dashboard Panel</h4>
                        </span>
                        <div class="header-button col-3 offset-5 row">
                            <div class="account-wrap ">
                                <div class="account-item clearfix js-item-menu offset-6">
                                    @if (auth()->user()->image == null)
                                        @if (auth()->user()->gender == 'male')
                                            <div class="image">
                                                <img src="{{ asset('image/default-user.jpg') }}" alt=""
                                                    class=" img-thumbnail shadow-sm">
                                            </div>
                                        @else
                                            <div class="image">
                                                <img src="{{ asset('image/default-female-profile.avif') }}"
                                                    alt="" class=" img-thumbnail shadow-sm">
                                            </div>
                                        @endif
                                    @else
                                        <div class="image">
                                            <img src="{{ asset('storage/' . auth()->user()->image) }}"
                                                alt="John Doe" />
                                        </div>
                                    @endif
                                    <div class="content">
                                        {{ auth()->user()->name }} <i class="zmdi zmdi-chevron-down"></i>
                                    </div>
                                    <div class="account-dropdown js-dropdown ">
                                        <div class="info clearfix">
                                            @if (auth()->user()->image == null)
                                                @if (auth()->user()->gender == 'male')
                                                    <div class="image">
                                                        <img src="{{ asset('image/default-user.jpg') }}"
                                                            alt="" class=" img-thumbnail shadow-sm">
                                                    </div>
                                                @else
                                                    <div class="image">
                                                        <img src="{{ asset('image/default-female-profile.avif') }}"
                                                            alt="" class=" img-thumbnail shadow-sm">
                                                    </div>
                                                @endif
                                            @else
                                                <div class="image">
                                                    <img src="{{ asset('storage/' . auth()->user()->image) }}"
                                                        alt="John Doe" />
                                                </div>
                                            @endif
                                            <div class="content">
                                                <h5 class="name">
                                                    <a href="#">
                                                        <button>
                                                            {{ auth()->user()->name }}
                                                        </button>
                                                    </a>
                                                </h5>
                                                <span class="email">{{ auth()->user()->email }}</span>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="{{ route('admin#detailPage') }}">
                                                    <button>
                                                        <i class="zmdi zmdi-account"></i> Account
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="{{ route('admin#listPage') }}">
                                                    <button>
                                                        <i class="zmdi zmdi-accounts-list"></i> Account List
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="{{ route('admin#passwordChangePage') }}">
                                                    <button>
                                                        <i class="zmdi zmdi-key"></i> Change Password
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__footer my-3">
                                            <form action="{{ route('logout') }}" method="post"
                                                class=" d-flex justify-content-center">
                                                @csrf
                                                <button type="submit" class="btn btn-dark text-center col-10">
                                                    <i class="zmdi zmdi-walk"></i> Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER DESKTOP-->

        {{-- Page Container --}}

        <div class="page-container">
            @yield('content')
        </div>
    </div>




    <!-- Jquery JS-->
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>

</body>
@yield('scriptSource')

</html>
<!-- end document-->

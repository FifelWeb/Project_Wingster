<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Home | Datta able Dashboard Template</title>

    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Datta able is trending dashboard template made using Bootstrap 5 design framework. Datta able is available in Bootstrap, React, CodeIgniter, Angular, and .net Technologies." />
    <meta name="keywords" content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard" />
    <meta name="author" content="Codedthemes" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon" />

    <!-- [Font] Family -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />

    <!-- [Icon Fonts] -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}" />

    <!-- [Template CSS] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}" />

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-14K1GBX9FG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-14K1GBX9FG');
    </script>

    <!-- WiserNotify -->
    <script>
        !(function () {
            if (window.t4hto4) console.log('WiserNotify pixel installed multiple time in this page');
            else {
                window.t4hto4 = !0;
                var t = document,
                    e = window,
                    n = function () {
                        var e = t.createElement('script');
                        e.type = 'text/javascript';
                        e.async = !0;
                        e.src = 'https://pt.wisernotify.com/pixel.js?ti=1jclj6jkfc4hhry';
                        document.body.appendChild(e);
                    };
                'complete' === t.readyState ? n() : window.attachEvent ? e.attachEvent('onload', n) : e.addEventListener('load', n, !1);
            }
        })();
    </script>

    <!-- Microsoft Clarity -->
    <script type="text/javascript">
        (function (c, l, a, r, i, t, y) {
            c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments); };
            t = l.createElement(r);
            t.async = 1;
            t.src = 'https://www.clarity.ms/tag/' + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, 'clarity', 'script', 'gkn6wuhrtb');
    </script>
</head>

<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="../dashboard/index.html" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="../assets/images/logo-white.svg" class="img-fluid logo-lg" alt="logo" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                </li>
                <li class="pc-item">
                    <a href="{{route('dashboard.index')}}" class="pc-link">
            <span class="pc-micon">
              <i data-feather="home"></i>
            </span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Data</label>
                    <i data-feather="feather"></i>
                </li>
                <li class="pc-item">
                    <a href="{{route('menu.index')}}" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-utensils fa-lg"></i></span>
                        <span class="pc-mtext">Menu</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{route('transaction.index')}}" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-receipt"></i></span>
                        <span class="pc-mtext">Transaction</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{route('category.index')}}" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-layer-group fa-lg"></i></span>
                        <span class="pc-mtext">Category</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('admin.dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-calendar-check fa-lg"></i></span>
                        <span class="pc-mtext">Reservation</span>
                    </a>
                </li>

                <li class="pc-item">
                    <a href="{{ route('admin.orders.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-shopping-cart"></i></span> <span class="pc-mtext">Order</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Pages</label>
                    <i data-feather="monitor"></i>
                </li>
                <li class="pc-item">
                    <a href="{{route('auth.login')}}" target="_blank" class="pc-link">
                        <span class="pc-micon"><i data-feather="lock"></i></span>
                        <span class="pc-mtext">Login</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{route('auth.register')}}" target="_blank" class="pc-link">
                        <span class="pc-micon"><i data-feather="user-plus"></i></span>
                        <span class="pc-mtext">Register</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
<!-- [ Header Topbar ] start -->
<header class="pc-header">
    <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i data-feather="menu"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i data-feather="menu"></i>
                    </a>
                </li>
                <li class="dropdown pc-h-item">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none m-0 trig-drp-search"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <i data-feather="search"></i>
                    </a>
                    <div class="dropdown-menu pc-h-dropdown drp-search">
                        <form class="px-3 py-2">
                            <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . ." />
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <i data-feather="bell"></i>
                        <span class="badge bg-success pc-h-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h5 class="m-0">Notifications</h5>
                            <a href="#!" class="btn btn-link btn-sm">Mark all read</a>
                        </div>
                        <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
                            <p class="text-span">Today</p>
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img class="img-radius avtar rounded-0" src="../assets/images/user/avatar-1.jpg" alt="Generic placeholder image" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <span class="float-end text-sm text-muted">2 min ago</span>
                                            <h5 class="text-body mb-2">UI/UX Design</h5>
                                            <p class="mb-0"
                                            >Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                                type and scrambled it to make a type</p
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img class="img-radius avtar rounded-0" src="../assets/images/user/avatar-2.jpg" alt="Generic placeholder image" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <span class="float-end text-sm text-muted">1 hour ago</span>
                                            <h5 class="text-body mb-2">Message</h5>
                                            <p class="mb-0">Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-span">Yesterday</p>
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img class="img-radius avtar rounded-0" src="../assets/images/user/avatar-3.jpg" alt="Generic placeholder image" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <span class="float-end text-sm text-muted">2 hour ago</span>
                                            <h5 class="text-body mb-2">Forms</h5>
                                            <p class="mb-0"
                                            >Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                                type and scrambled it to make a type</p
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img class="img-radius avtar rounded-0" src="../assets/images/user/avatar-4.jpg" alt="Generic placeholder image" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <span class="float-end text-sm text-muted">12 hour ago</span>
                                            <h5 class="text-body mb-2">Challenge invitation</h5>
                                            <p class="mb-2"><span class="text-dark">Jonny aber</span> invites to join the challenge</p>
                                            <button class="btn btn-sm btn-outline-secondary me-2">Decline</button>
                                            <button class="btn btn-sm btn-primary">Accept</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img class="img-radius avtar rounded-0" src="../assets/images/user/avatar-5.jpg" alt="Generic placeholder image" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <span class="float-end text-sm text-muted">5 hour ago</span>
                                            <h5 class="text-body mb-2">Security</h5>
                                            <p class="mb-0"
                                            >Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                                type and scrambled it to make a type</p
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center py-2">
                            <a href="#!" class="link-danger">Clear all Notifications</a>
                        </div>
                    </div>
                </li>
                <li class="dropdown pc-h-item header-user-profile">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        data-bs-auto-close="outside"
                        aria-expanded="false"
                    >
                        <i data-feather="user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown p-0 overflow-hidden">
                        <div class="dropdown-header d-flex align-items-center justify-content-between bg-primary">
                            <div class="d-flex my-2">
                                <div class="flex-shrink-0">
                                    <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar wid-35" />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-white mb-1">Carson Darrin 🖖</h6>
                                    <span class="text-white text-opacity-75">carson.darrin@company.io</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-body">
                            <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                                <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-setting-outline"></use>
                </svg>
                <span>Settings</span>
              </span>
                                </a>
                                <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-share-bold"></use>
                </svg>
                <span>Share</span>
              </span>
                                </a>
                                <a href="#" class="dropdown-item">
              <span>
                <svg class="pc-icon text-muted me-2">
                  <use xlink:href="#custom-lock-outline"></use>
                </svg>
                <span>Change Password</span>
              </span>
                                </a>
                                <form method="POST" action="{{ route('auth.logout') }}">
                                <div class="d-grid my-2">
                                    <button class="btn btn-primary">
                                        <svg class="pc-icon me-2"></svg
                                        >Logout
                                    </button>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- [ Header ] end -->



<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="mb-0">@yield('title')</h5>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ul class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">@yield('title')</a></li>
                            <li class="breadcrumb-item" aria-current="page">Home</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->


        @yield('content')


    </div>
</div>
<!-- [ Main Content ] end -->
<footer class="pc-footer">
    <div class="footer-wrapper container-fluid">
        <div class="row">
            <div class="col my-1">
                <p class="m-0">Datta able &#9829; crafted by Team <a href="https://codedthemes.com/" target="_blank">Codedthemes</a></p>
            </div>
            <div class="col-auto my-1">
                <ul class="list-inline footer-link mb-0">
                    <li class="list-inline-item"><a href="../index.html">Home</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>


<!-- [Page Specific JS] start -->
<!-- apexcharts js -->
<script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jsvectormap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/world.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard-default.js') }}"></script>
<!-- [Page Specific JS] end -->

<!-- Required Js -->
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>

<!-- CDN -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $(function () {

        @if(session()->has('gagal'))
        toastr.error('{{Session::get('gagal')}}', 'Error')
        @endif
        @if(session()->has('success'))
        toastr.success('{{Session::get('success')}}', 'Berhasil')
        @endif
    });
</script>

{{--srcipt js transaction--}}
@stack('js')

{{--SweetAlert--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>

<script>
    layout_change('light');
</script>

<script>
    change_box_container('false');
</script>

<script>
    layout_caption_change('true');
</script>

<script>
    layout_rtl_change('false');
</script>

<script>
    preset_change('preset-1');
</script>

<script>
    layout_theme_sidebar_change('false');
</script>


</body>
<!-- [Body] end -->
</html>

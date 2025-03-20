@php
    $menus = [
        [
            'title' => 'Dashboard',
            'icon' => 'bx bx-home',
            'link' => 'dashboard',
        ],
        [
            'title' => 'Invoices',
            'icon' => 'bx bx-food-menu',
            'link' => 'invoice',
            'submenu' => [
                [
                    'title' => 'List',
                    'link' => 'invoice.index',
                ],
                [
                    'title' => 'Create',
                    'link' => 'invoice.create',
                ],
            ],
        ],
        [
            'title' => 'Customers',
            'icon' => 'bx bx-user',
            'link' => 'customer',
            'submenu' => [
                [
                    'title' => 'List',
                    'link' => 'customer.index',
                ],
                [
                    'title' => 'Create',
                    'link' => 'customer.create',
                ],
            ],
        ],

        [
            'title' => 'Products',
            'icon' => 'bx bx-box',
            'link' => 'product',
            'submenu' => [
                [
                    'title' => 'List',
                    'link' => 'product.index',
                ],
                [
                    'title' => 'Create',
                    'link' => 'product.create',
                ],
            ],
        ],
    ];
@endphp
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>GKTAX Portal Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    @stack('css')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('user.layouts.aside')
            <div class="layout-page">
                <!-- Navbar -->
                @include('user.layouts.nav')
                <!-- / Navbar -->
                <!-- Content -->
                <div class="content-wrapper">
                    @yield('content')
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="text-body">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with ❤️ by
                                    <a href="https://blogrator.com" target="_blank" class="footer-link">Blogrator</a>
                                </div>

                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
            <!-- Menu -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper --> </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/sweetAlert.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    @stack('js')
    @if (session('swtSuccess'))
        <script>
            Swal.fire({
                title: "Good job!",
                text: "{{ session('swtSuccess') }}",
                icon: "success"
            });
        </script>
    @endif

</body>

</html>

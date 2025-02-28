<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-wide customizer-hide" dir="ltr"
    data-theme="theme-default" data-assets-path="client/client/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('client/assets/img/favicon/favicon.png') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/fonts/flag-icons.css') }}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('client/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/css/pages/app-logistics-dashboard.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/css/pages/page-pricing.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/css/pages/front-page-payment.css') }}" />

    <link rel="stylesheet" href="{{ asset('client/assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <script src="{{ asset('client/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('client/assets/js/config.js') }}"></script>
    @stack('styles')
</head>
<body>

<!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">

            <x-nav-bar-client/>

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <x-side-client/>

                    <!-- Content -->

                    {{ $slot }}

                    <!--/ Content -->

                    <!-- Footer -->
                    @include('layouts.partials.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!--/ Content wrapper -->
            </div>

            <!--/ Layout container -->
        </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!--/ Layout wrapper -->

<script src="{{ asset('client/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('client/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('client/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('client/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('client/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('client/assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('client/assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('client/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('client/assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('client/assets//js/pages-pricing.js') }}"></script>
<!-- endbuild -->
<!-- Vendors JS -->
<script src="{{ asset('client/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('client/assets/js/main.js') }}"></script>
<script src="{{ asset('client/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('client/assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
<script src="{{ asset('client/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('client/assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('client/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('client/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('client/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>

<script src="{{ asset('client/assets/js/app-logistics-dashboard.js') }}"></script>
<script src="{{ asset('client/assets/js/wizard-ex-create-deal.js') }}"></script>
<script src="{{ asset('client/assets/js/pages-pricing.js') }}"></script>
<script src="{{ asset('client/assets/js/front-page-payment.js') }}"></script>

<script src="{{ asset('client/assets/js/modal-edit-user.js') }}"></script>
<script src="{{ asset('client/assets/js/app-user-view.js') }}"></script>
<script src="{{ asset('client/assets/js/app-user-view-account.js') }}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts />

<script>
var myModalEl = document.getElementById('votreIdModal')
myModalEl.addEventListener('hidden.bs.modal', function (event) {
    location.reload();
})
</script>

</body>
</html>

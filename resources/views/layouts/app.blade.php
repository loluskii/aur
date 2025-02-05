<!doctype html>
<html lang="en">

<head>
    <title>2611 AUR</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ secure_asset('css/app.css') }} crossorigin="anonymous">
    {{--
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ secure_asset('css/bootstrap-side-modals.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ secure_asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ secure_asset('favicon_io/favicon-16x16.png') }}">
    <link href="{{ secure_asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ secure_asset('favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ secure_asset('favicon-32x32.png') }}">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="description"
        content="Shop the best fashion products on AUR2611. From T-Shirts to Sweatshirts to Accessories. Visit 2611-aur.com now!">


    <link rel="manifest" href="/site.webmanifest">
    <!-- Hotjar Tracking Code for https://2611-aur.com -->
    <script>
        (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:3049730,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    {{--
    <link rel="stylesheet" href="{{ secure_asset('go') }}"> --}}
    <style>
        @font-face {
            font-family: 'Century Gothic';
            src: url("{{ secure_asset('gothic/gothic.woff') }}");
        }

        * {
            font-family: 'Century Gothic', Arial, sans-serif;
            line-height: 25px;
            /* letter-spacing: .1rem; */
            text-transform: uppercase;
            color: #000;
            font-size: 15px;
            /* padding: 1.25rem; */
        }

        /* .card{
            max-width: 23rem;
        } */
        .card-body .product-name,
        .card-body p {
            font-size: 15px;
        }

        .wraps {
            min-height: 100vh;
        }

        .container {
            max-width: 1124px;
        }
    </style>
    @yield('styles')




</head>

<body class="bg-light">
    <div id="wraps">
        @if (Route::is('checkout.*'))
        @else
        @include('layouts.header')
        @endif

        @yield('content')

        @include('layouts.footer')

    </div>
    @include('layouts.footer-scripts')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @yield('scripts')

</body>

</html>
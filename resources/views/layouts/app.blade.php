<!doctype html>
<html lang="en">

<head>
    <title>2611</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/header-14.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/reset.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-side-modals.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="/site.webmanifest">
    {{-- <link rel="stylesheet" href="{{ asset('go') }}"> --}}
    <style>
        @font-face {
            font-family: 'Century Gothic';
            src: url("{{ asset('gothic/gothic.woff') }}");
        }
        *{
            font-family: 'Century Gothic',Arial,sans-serif;
            line-height: 25px;
            /* letter-spacing: .1rem; */
            /* text-transform: uppercase; */
            color: #000;
            font-size: 13px;
            /* padding: 1.25rem; */
        }
        .card-body .product-name, .card-body p{
            font-size: 12px;
        }

    </style>
    @yield('styles')




</head>

<body class="bg-white">
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
    <script>
        let navToggle = document.querySelector(".nav__toggle");
        let navWrapper = document.querySelector(".nav__wrapper");
        navToggle.addEventListener("click", function () {
          if (navWrapper.classList.contains("active")) {
            this.setAttribute("aria-expanded", "false");
            this.setAttribute("aria-label", "menu");
            navWrapper.classList.remove("active");
          } else {
            navWrapper.classList.add("active");
            this.setAttribute("aria-label", "close menu");
            this.setAttribute("aria-expanded", "true");
          }
        });
    </script>

</body>

</html>

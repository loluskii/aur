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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/header-14.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/reset.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-side-modals.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;400&display=swap" rel="stylesheet">
    <style>
        /* @font-face {
            font-family: 'Century Gothic';
            src: url('../../public/font/gothic.woff');
        } */
        *{
            font-family: 'Open Sans', sans-serif;
            line-height: 25px;
        }
        .card-body .product-name, .card-body p{
            font-size: 12px;
        }

    </style>
    @yield('styles')




</head>

<body>
    <div id="wraps">
        @include('layouts.header')

        @yield('content')

        @include('layouts.footer')

    </div>
    @include('layouts.footer-scripts')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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

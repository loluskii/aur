<!doctype html>
<html lang="en">

<head>
  <title>2611</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.0.2 -->
  {{--
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css" />
  
  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <style>
    @font-face {
      font-family: 'Century Gothic';
      src: url("{{ asset('gothic/gothic.woff') }}");
    }

    * {
      font-family: 'Century Gothic', Arial, sans-serif;
      line-height: 25px;
      /* letter-spacing: .1rem; */
      /* text-transform: uppercase; */
      /* color: #000; */

      /* padding: 1.25rem; */
    }

    table {
      font-size: 13px;
    }

    .card-body .product-name,
    .card-body p {
      font-size: 12px;
    }
  </style>

  @yield('styles')
</head>

<body>
  @include('admin.layouts.header')
  @include('admin.layouts.sidebar')
  <main class="main" id="main">
    @yield('page-title')
    <section class="section dashboard">
      @yield('content')
    </section>

  </main>
  <!-- Bootstrap JavaScript Libraries -->
  @include('admin.layouts.footer-scripts')
  @stack('scripts')
</body>

</html>
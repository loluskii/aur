<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>2611 AUR</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    {{-- <link href="asset/img/favicon.png" rel="icon"> --}}
    {{-- <link href="asset/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">

    <link href="{{ asset('asset/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <div class="logo">
                {{-- <h1 class="text-light"><a href="index.html"><span>WeBuild</span></a></h1> --}}
                <!-- Uncomment below if you prefer to use an image logo -->
                {{-- <a href="#"><img src="{{ asset('images/2611.png') }}" alt="" class="img-fluid"></a> --}}
            </div>

            <div class="contact-link float-right">
                {{-- <a href="#contact" class="scrollto">Contact Us</a> --}}
            </div>

        </div>
    </header><!-- End #header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
            <img src="{{ asset('images/2611.png') }}" alt="" class="img-fluid mb-5">
            <h2 class="text-dark">COUNTDOWN TO LAUNCH</h2>
            <div class="countdown text-dark" data-count="2022/4/31" data-template="%d days %h:%m:%s"></div>

            <form action="{{ route('subscribe') }}" method="post" class="php-email-form">
                @csrf
                <div class="row no-gutters">
                    <div class="col-md-12 form-group pr-md-1">
                        <input type="text" name="email" class="form-control mb-3" id="name" placeholder="Your Email" required>
                    </div>
                </div>
                <button class="btn btn-dark btn-block" type="submit">Get notified!</button>
            </form>
        </div>
    </section><!-- End Hero -->

    {{-- <main id="main">

        <!-- ======= Contact Us Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2>Contact Us</h2>
                </div>

                <div class="row contact-info">

                    <div class="col-md-4">
                        <div class="contact-address">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <address>A108 Adam Street, NY 535022, USA</address>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-phone">
                            <i class="bi bi-phone"></i>
                            <h3>Phone Number</h3>
                            <p><a href="tel:+155895548855">+1 5589 55488 55</a></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-email">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p><a href="mailto:info@example.com">info@example.com</a></p>
                        </div>
                    </div>

                </div>

                <div class="form">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                    required>
                            </div>
                            <div class="col-md form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                                required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message"
                                required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>
        </section>

    </main> --}}

    <script src="{{ asset('asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/js/main.js') }}"></script>
    @include('layouts.footer-scripts')

</body>

</html>
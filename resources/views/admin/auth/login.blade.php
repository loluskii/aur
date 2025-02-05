@extends('admin.layouts.login-layout')

@section('content')
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">


                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    {{-- <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5> --}}
                                    <div class="d-flex justify-content-center py-4">
                                        <a href="index.html" class="d-flex align-items-center w-auto">
                                            <img src="{{ secure_asset('images/2611.png') }}" alt="">
                                        </a>
                                    </div>
                                    <p class="text-center small">Enter your email & password to login</p>
                                </div>
                                <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.login') }}">
                                    @csrf
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <input name="email" type="email" class="form-control"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input id="password" type="password" class="form-control" name="password" required
                                            autocomplete="current-password">
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-dark btn-lg w-100" type="submit">Login</button>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <div class="col-12">
                                            <p class="small mb-0"> <a href="">Forgot
                                                    password</a></p>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

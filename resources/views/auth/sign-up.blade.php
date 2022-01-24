@extends('layouts.app')

@section('styles')
<style>
</style>
@endsection

@section('content')
<div class="container py-5" style="height: 70vh">
    <div class="row justify-content-center h-100">
        <div class="col-md-6 my-auto">
            <div class="">
                <div class="text-center">
                    <p class="font-weight-bold" style="font-size: 25px;">Create your Account
                    <p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register-user') }}">
                        @csrf
                        <div class="row g-2 mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="fname" placeholder="First Name"
                                        class="rounded-0 form-control form-control-lg @error('fname') is-invalid @enderror"
                                        required aria-describedby="helpId">
                                    @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="lname" placeholder="Last Name"
                                        class="rounded-0 form-control form-control-lg @error('lname') is-invalid @enderror"
                                        required aria-describedby="helpId">
                                    @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="email" placeholder="Email Address"
                                        class="rounded-0 form-control form-control-lg @error('email') is-invalid @enderror"
                                        required aria-describedby="helpId">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="phone_no" placeholder="Phone Number"
                                        class="rounded-0 form-control form-control-lg @error('phone_no') is-invalid @enderror"
                                        required aria-describedby="helpId">
                                    @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="address_line_1" placeholder="Address Line 1"
                                class="rounded-0 form-control form-control-lg @error('email') is-invalid @enderror"
                                aria-describedby="helpId">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" name="address_line_2" placeholder="Address Line 2"
                                class="rounded-0 form-control form-control-lg @error('address_line_2') is-invalid @enderror"
                                aria-describedby="helpId">
                            @error('address_line_2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="city" placeholder="City"
                                        class="rounded-0 form-control form-control-lg @error('city') is-invalid @enderror"
                                        required aria-describedby="helpId">
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="state" placeholder="State"
                                        class="rounded-0 form-control form-control-lg @error('state') is-invalid @enderror"
                                        required aria-describedby="helpId">
                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="zip" placeholder="ZIP/ Post-code"
                                        class="rounded-0 form-control form-control-lg @error('zip') is-invalid @enderror"
                                        required aria-describedby="helpId">
                                    @error('zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="country" placeholder="Country"
                                        class="rounded-0 form-control form-control-lg @error('country') is-invalid @enderror"
                                        required aria-describedby="helpId">
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="password" placeholder="Password"
                                class="rounded-0 form-control form-control-lg @error('password') is-invalid @enderror"
                                aria-describedby="helpId">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="d-grid gap-2">
                            <button class="btn btn-lg border bg-dark rounded-0 text-white" id="btn-sign-in"
                                type="submit">Continue</button>
                        </div>
                        <p class="text-center pt-2">Already have an account?
                            <a class="text-center" href="{{ route('login') }}">
                                Sign In
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="body container py-5" style="height: 74vh">
    <div class="row justify-content-center h-100">
        <div class="col-md-5 my-auto">
            <div class="">
                <div class="text-center">
                    <p class="font-weight-bold" style="font-size: 25px;">Create your Account
                    <p>
                </div>

                <div class="card-body" style="text-transform: none;">
                    <form method="POST" action="{{ route('register-user') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <input type="text" name="fname" style="text-transform: none;" placeholder="First Name"
                                class="rounded-0 form-control @error('fname') is-invalid @enderror"
                                required aria-describedby="helpId">
                            @error('fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" name="lname" style="text-transform: none;" placeholder="Last Name"
                                class="rounded-0 form-control @error('lname') is-invalid @enderror"
                                required aria-describedby="helpId">
                            @error('lname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row g-2 mb-3">

                            <div class="form-group">
                                <input type="text" name="email"  style="text-transform: none;" placeholder="Email Address"
                                    class="rounded-0 form-control @error('email') is-invalid @enderror"
                                    required aria-describedby="helpId">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="password" style="text-transform: none;" placeholder="Password"
                                class="rounded-0 form-control @error('password') is-invalid @enderror"
                                aria-describedby="helpId">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="d-grid gap-2">
                            <button class="btn  border bg-dark rounded-0 text-white" id="btn-sign-in"
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
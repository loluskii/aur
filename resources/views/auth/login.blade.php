@extends('layouts.app')

@section('styles')
<style>
    #btn-sign-in:hover{
        background-color: black;
        color: white;
    }
    form, .form-control{
        text-transform: none;
    }
</style>
@endsection

@section('content')
<div class="container" >
    <div class="row justify-content-center h-100">
        <div class="col-md-5 my-auto">
            <div class="">
                <div class="text-center">
                    <p style="font-size: 25px;">Sign In
                    <p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login.custom') }}" autocomplete="off">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="email" name="email" placeholder="Email Address"
                                class="rounded-0 form-control form-control-lg @error('email') is-invalid @enderror"
                                aria-describedby="helpId">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <input type="password" name="password" placeholder="Password"
                                class="rounded-0 form-control form-control-lg @error('password') is-invalid @enderror"
                                required aria-describedby="helpId">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn border rounded-0 bg-dark btn-lg text-white" id="btn-sign-in" type="submit">Sign In</button>
                        </div>
                        <p class="text-center pt-2">Don't have an account?
                            <a class="text-center" href="{{ route('register') }}">
                                Sign Up
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


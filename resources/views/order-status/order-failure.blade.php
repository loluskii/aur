@extends('layouts.app')

@section('content')

    <div class="row mt-5 pt-sm-5">
        <div class="col-10 mx-auto align-items-center justify-content-center">
            <main class="pt-4">
                <div id="confirmation card">
                    <div class="status success card-body text-center">
                        <h1 style="color: #2A707D;">An Error Occurred! 😕</h1>
                        <p>It's not you, it's us. We're Sorry your order didn't go through. Please try again</p> <br>
                        <span class="text-danger">{{ $error }}</span>

                        <p><a href="" class="btn btn-lg">Back to Store</a></p>
                    </div>

                </div>
            </main>
        </div>
    </div>


    @endsection

@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('video/css/video.css') }}">
<style>
    .subscribe {
        background-image: url("{{ asset('images/backgorund-2.jpg') }}");
        background-position: center;
        background-size: cover;

    }

    .subscribe h2,
    .subscribe p {
        text-shadow: 2px 2px #000000;
    }

    .subscribe button {
        font-size: 14px;
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="container mb-5">
    <div class="iframe-container placeholder-glow" id="atlanticlight">
        <video width="1220" height="520" controls>
            <source src="https://res.cloudinary.com/deumzc82y/video/upload/v1642159679/Untitled_gdenrn.mp4"
                type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" id="playpause"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>Play</title>
                <polygon points="12,0 25,11.5 25,39 12,50" id="leftbar" />
                <polygon points="25,11.5 39.7,24.5 41.5,26 39.7,27.4 25,39" id="rightbar" />
                <animate to="7,3 19,3 19,47 7,47" id="lefttopause" xlink:href="#leftbar" attributeName="points"
                    dur=".3s" begin="indefinite" fill="freeze" />
                <animate to="12,0 25,11.5 25,39 12,50" id="lefttoplay" xlink:href="#leftbar" attributeName="points"
                    dur=".3s" begin="indefinite" fill="freeze" />
                <animate to="31,3 43,3 43,26 43,47 31,47" id="righttopause" xlink:href="#rightbar"
                    attributeName="points" dur=".3s" begin="indefinite" fill="freeze" />
                <animate to="25,11.5 39.7,24.5 41.5,26 39.7,27.4 25,39" id="righttoplay" xlink:href="#rightbar"
                    attributeName="points" dur=".3s" begin="indefinite" fill="freeze" />
            </svg>
        </button>
        <script>
            var atlanticlight = document.querySelector("#atlanticlight video"),
            playpause = document.getElementById("playpause"),
              lefttoplay = document.getElementById("lefttoplay"),
              righttoplay = document.getElementById("righttoplay"),
              lefttopause = document.getElementById("lefttopause"),
              righttopause = document.getElementById("righttopause");
              atlanticlight.removeAttribute("controls");
              playpause.style.display = "block";
              playpause.addEventListener('click',function(){
                if (atlanticlight.paused) {
                  atlanticlight.play();
                  playpause.classList.add("playing");
                  lefttopause.beginElement();
                  righttopause.beginElement();
                } else {
                  atlanticlight.pause();
                  lefttoplay.beginElement();
                  righttoplay.beginElement();
                  playpause.classList.remove("playing");
            }

            },false);
        </script>
    </div>
</div>
<div class="container">
    <div class="row g-4">
        @foreach ($products as $product)
            <div class="col-md-4 col-12 mb-5 pe-2">
                <a href="{{ route('product.show', $product->tag_number) }}">
                    <div class="card shadow-sm border-0 p-2">
                        <div class="card-img-header">
                            <img class="card-img-top img-fluid" src="{{ $product->images()->first()->image_url }}" style="width: 100%; height: 360px; object-fit: contain;" alt="">
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 card-title product-name">{{ $product->name }}</h4>
                            <p class="card-text">${{ $product->price }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
<div class="subscribe">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-md-10">
                <h2 class="h5 text-white text-start fw-bold mb-3">SIGN UP FOR THE UPDATES</h2>
                <p class="mb-3 text-white text-start" style="font-weight: 600">By clicking the subscribe
                    button, you agree to the Privacy Policy and Terms & Condition</p>
                <form action="{{ route('subscribe') }}" method="post">
                @csrf
                    <div class="row g-1 w-100">
                        <div class="col-md-6">
                            <div class="form-group pl-0">
                                <input type="text" name="email" id="" class="form-control form-control-lg rounded-0"
                                    style="border: 1px solid black" placeholder="Your email" aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn bg-white btn-lg rounded-0" style="border: 1px solid black">
                                <span class="d-md-none d-sm-block">&#8594;</span> <span
                                    class="d-sm-none d-md-block">Subscribe</span> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

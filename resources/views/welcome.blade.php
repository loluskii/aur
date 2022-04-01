@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ secure_asset('video/css/video.css') }}">
    {{-- <style>
        .subscribe {
            background-image: url("{{ secure_asset('images/backgorund-2.jpg') }}");
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

    </style> --}}
    
    <style>


body{
    overflow: hidden;
}

#background-video {
  width: 100vw;
  height: 100vh;
  object-fit: cover;
  position: fixed;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  z-index: -1;
}


.content {
  background: rgba(0, 0, 0, 0.5);
  color: #f1f1f1;
  width: 100%;
  padding-top: 40px;
}








        /* general styling */
        :root {
          --smaller: .75;
        }
        
        
        .container {
          color: #333;
          margin: 0 auto;
          text-align: center;
        }
        
        h1 {
          font-weight: bold;
          text-transform: uppercase;
          font-size: 30px;
        }
        
        li {
          display: inline-block;
          font-size: 2.5em;
          list-style-type: none;
          padding: 1em;
          text-transform: uppercase;
          font-weight: bolder;
        }
        
        li span {
          display: block;
          font-size: 6.5rem;
          font-weight: bolder;
        }
        
        .emoji {
          display: none;
          padding: 1rem;
        }
        
        .emoji span {
          font-size: 4rem;
          padding: 0 .5rem;
        }
        
        @media all and (max-width: 768px) {
          h1 {
            font-size: calc(1.5rem * var(--smaller));
          }
          
          li {
            font-size: calc(1.125rem * var(--smaller));
          }
          
          li span {
            font-size: calc(3.375rem * var(--smaller));
          }
        }</style>
@endsection

@section('content')
<video id="background-video" class="background-tint" loop autoplay="true" muted="muted" webkit-playsinline="true" playsinline="true">
    <source src="{{ secure_asset('cm-chat-media-video-1:06e9ceca-d11c-55fc-be4f-4c344b1fafb9:1008:0:0.MOV') }}" type="video/mp4">
    Your browser does not support the video tag.
</video>
    <div class="container mb-5">
        <div class="iframe-container placeholder-glow" id="atlanticlight">
            <div class="container content" style="margin-top: 20%">
            
                <h1 class="text-white" id="headline">Countdown to launch</h1>
                <div id="countdown">
                  <ul>
                    <li class="mb-5 text-white"><span class="mb-5 text-white" id="days"></span>days</li>
                    <li class="mb-5 text-white"><span class="mb-5 text-white" id="hours"></span>Hours</li>
                    <li class="mb-5 text-white"><span class="mb-5 text-white" id="minutes"></span>Minutes</li>
                    <li class="mb-5 text-white"><span class="mb-5 text-white" id="seconds"></span>Seconds</li>
                  </ul>
                </div>
                <div id="content" class="emoji">
                  <span>🥳</span>
                  <span>🎉</span>
                  <span>🎂</span>
                </div>
              </div>
            {{-- <video width="1220" height="500" loop autoplay="true" muted="muted" webkit-playsinline="true"
                playsinline="true">
                <source
                    src="{{ secure_asset('cm-chat-media-video-1:06e9ceca-d11c-55fc-be4f-4c344b1fafb9:1008:0:0.MOV') }}"
                    type="video/mp4">
                Your browser does not support the video tag.
            </video> --}}
            
            {{-- <button>
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
        </button> --}}
            {{-- <script>
        
            var atlanticlight = document.querySelector("#atlanticlight video");
            // atlanticlight.play();
            // playpause = document.getElementById("playpause"),
            //   lefttoplay = document.getElementById("lefttoplay"),
            //   righttoplay = document.getElementById("righttoplay"),
            //   lefttopause = document.getElementById("lefttopause"),
            //   righttopause = document.getElementById("righttopause");
            //   atlanticlight.removeAttribute("controls");
            //   playpause.style.display = "block";
            //   atlanticlight.play();
            //   playpause.addEventListener('click',function(){
            //     if (atlanticlight.paused) {
            //       atlanticlight.play();
            //       playpause.classList.add("playing");
            //       lefttopause.beginElement();
            //       righttopause.beginElement();
            //     } else {
            //       atlanticlight.pause();
            //       lefttoplay.beginElement();
            //       righttoplay.beginElement();
            //       playpause.classList.remove("playing");
            // }

            // },false);
        </script> --}}
        </div>
    </div>
    {{-- <div class="container">
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-md-4 col-12 mb-5 pe-2">
                    <a href="{{ route('product.show', $product->tag_number) }}">
                        <div class="border-0 p-2">
                            <div class="card-img-header">
                                <img class="card-img-top img-fluid"
                                    src="{{ $product->images()->first()->image_url ?? '' }}"
                                    style="width: 100%; height: 400px; object-fit: cover; object-position: top;" alt="">
                            </div>
                            <div class="card-body px-0 d-flex justify-content-between align-items-center">
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
    </div> --}}
@endsection

@section('scripts')
    <script>
        (function () {
  const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

  //I'm adding this section so I don't have to keep updating this pen every year :-)
  //remove this if you don't need it
  let today = new Date(),
      dd = String(today.getDate()).padStart(2, "0"),
      mm = String(today.getMonth() + 1).padStart(2, "0"),
      yyyy = today.getFullYear(),
      nextYear = yyyy + 1,
      dayMonth = "05/01/",
      birthday = dayMonth + yyyy;
  
  today = mm + "/" + dd + "/" + yyyy;
  if (today > birthday) {
    birthday = dayMonth + nextYear;
  }
  //end
  
  const countDown = new Date(birthday).getTime(),
      x = setInterval(function() {    

        const now = new Date().getTime(),
              distance = countDown - now;

        document.getElementById("days").innerText = Math.floor(distance / (day)),
          document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
          document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
          document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

        //do something later when date is reached
        if (distance < 0) {
          document.getElementById("headline").innerText = "It's my birthday!";
          document.getElementById("countdown").style.display = "none";
          document.getElementById("content").style.display = "block";
          clearInterval(x);
        }
        //seconds
      }, 0)
  }());
    </script>
@endsection

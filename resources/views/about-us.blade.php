@extends('layouts.app')
@section('styles')
    <style>
        #about-us p{
            /* font-size: 23px; */
            line-height: 35px;
            text-transform: none;
        }
    </style>
@endsection
@section('content')
    <div class="container pt-1 pb-5 py-lg-5 py-md-4" id="about-us" style="min-height: 78vh">
    
        <div class="row">
            <h4 class="text-center mb-4 fw-bolder">ABOUT US</h4>
            <div class="col-md-8 mx-auto col-lg-9 col-sm-12 text-center ">
                {{-- <p>This is 2611AUR, a clothing, fashion brand represents the, Afro, Retro, Urban Lifestyle, and this is where our brand name comes from.</p> --}}
                <p>This is 2611 AUR, is a clothing fashion brand that represents Afro, Retro and Urban Lifestyle. 2611 represents the day and month the idea was born . </p>
                <p>2611 AUR took the power from the amazing heritage of African culture thus the first mission
                    of the brand is being able to represent whatever belongs to African culture and spread it
                    around urban life with retro spirit.
                    </p>
                <p>2611 wants to make sure every piece we make is very comfortable , representing cultures and
                    media , finding comfort , creating awareness of Afro, Retro, Urban cultures through fashion. </p>
                <p>2611 represents the birth of a movement that goes through the struggle and success of our
                    everyday life and gives room to an area of thought .</p>
            </div>
        </div>
    </div>
@endsection
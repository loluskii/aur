@extends('layouts.app')
@section('styles')
    <style>
        #about-us p, #about-us h6{
            font-size: 14px;
            line-height: 30px;
            text-transform: none;
        }
    </style>
@endsection
@section('content')
    <div class="container pt-3 pb-5" id="about-us" style="min-height: 70vh">
    
        <div class="row">
            
            <div class="col-md-10 mx-auto col-lg-10 col-sm-12">
                
                <section class="py-3 text-black text-center">
                    <h6 class="text-center fw-bolder pb-3">CONTACT US</h6>
                    {{-- <p class="pt-5 pb-4">CONTACTS</p> --}}
                    <div class="col-4 mx-auto border-top border-bottom mb-5">
                        <p class="py-4 mb-0">Yapracik Mah 3291 . Cadde Angora Yasam Evleri A Blok No :100 Etimesgut , Ankara</p>
                    </div>
                    <p>For Shipping and Customer Service enquires, please contact: <br> <span class="fw-bold"><a href="mailto:orders@aur2611.com"> orders@2611-aur.com</a></span></p>
                    <p class="py-4">For Store buyers, please contact: <br> <span class="fw-bold"><a href="mailto:orders@aur2611.com"> store@2611-aur.com</a></span></p>
                    <p>For Shipping and Customer Service enquires, please contact: <br> <span class="fw-bold"><a href="mailto:orders@aur2611.com"> work@2611-aur.com</a></span></p>
                </section>
                
            </div>
        </div>
    </div>
@endsection
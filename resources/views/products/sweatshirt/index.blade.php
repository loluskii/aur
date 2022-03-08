@extends('layouts.app')

@section('styles')
    
@endsection

@section('content')
<div class="container">
    <div class="row  g-5 justify-content-center">
        @if ($products)
            @foreach ($products as $product)
                <div class="col-md-4 col-sm-12 col-lg-4 mb-3">
                    <a href="{{ route('product.show',$product->tag_number) }}">
                        <div class="text-center p-2">
                            <p></p>
                            <img class="card-img-top img-fluid" src="{{ $product->images()->first()->image_url ?? '' }}" alt="">
                            <div class="card-body px-0 d-flex justify-content-between align-items-center">
                                <h4 class="mb-0 card-title product-name">{{ $product->name }}</h4>
                                <p class="card-text">${{ $product->price }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <div class="row" style="height: 470px">
                <div class="col my-auto text-center">
                    <h1>COMING SOON</h1>
                    <p>We are working on it. Please check back in a few days</p>
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
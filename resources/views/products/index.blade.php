@extends('layouts.app')

@section('styles')
    <style>
        .card-body .product-name, .card-body p{
            font-size: 12px;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 col-6 mb-3 pe-2">
                <a href="{{ route('product.show',$product->id) }}">
                    <div class="">
                        <img class="card-img-top img-fluid shadow-sm" src="{{ $product->image }}" alt="">
                        <div class="card-body px-0 d-flex justify-content-between align-items-center"">
                            <h4 class="mb-0 card-title product-name">{{ $product->name }}</h4>
                            <p class="card-text">£{{ $product->price }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
</div>
@endsection

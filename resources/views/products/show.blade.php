@extends('layouts.app')

@section('styles')
<style>
    .img-small-wrap .item-gallery {
        width: 60px;
        height: 60px;
        border: 1px solid rgb(245, 245, 245);
        margin: 7px 2px;
        /* display: block; */
        overflow: hidden;
    }

    .img-small-wrap {
        text-align: center;
    }

    .img-small-wrap img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
        border-radius: 4px;
    }
</style>
@endsection

@section('content')
<!------ Include the above in your HEAD tag ---------->

<div class="container mb-5" style="min-height: 70vh">
    <div class="border-0 mb-5">
        <div class="row">
            <aside class="col-md-7 text-center border-end pb-5">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-12 order-lg-first order-md-first order-last">
                        <div
                            class="img-small-wrap d-flex justify-content-center flex-lg-column flex-md-column flex-sm-row order-lg-1">
                            @foreach ($product->images->take(4) as $image)

                            <div class="item-gallery">
                                <a href="#" class="thumbnail" data-big="{{ $image->image_url ?? '' }}">
                                    <img src="{{ $image->image_url ?? '' }}">
                                </a> 
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-11 col-md-11 col-sm-12 order-lg-last order-md-last order-first">
                        <img src="{{ $product->images()->first()->image_url ?? '' }}" style="height: 650px"
                            class="primary img-fluid">
                    </div>
                </div>
            </aside>
            <aside class="col-md-5">
                <article class="card-body p-lg-5 p-md-5 p-sm-2">
                    <header class="pt-4 mb-4 d-flex flex-lg-column flex-md-column flex-sm-row justify-contentr-between align-items-lg-start align-items-md-start">
                        <h4 class="text-uppercase font-weigh mb-1 me-auto fw-bold">{{ $product->name }}</h4>

                        <p class="price-detail-wrap">
                            <span class="price h6" style="font-weight: 500">
                                <span class="currency">$</span><span class="num font-weight-bold">{{ $product->price
                                    }}</span>
                            </span>
                        </p>
                    </header>
                    <dl class="item-property mb-4" style="max-width: 500px">
                        {{-- <dt>Description</dt> --}}
                        <dd>
                            <p>{{ $product->description }}</p>
                        </dd>
                    </dl>
                    <dl class="item-property mb-4">
                        <dt>Quantity Available</dt>
                        <dd>
                            <p>22 Units remaining</p>
                        </dd>
                    </dl>
                    <dl class="item-property mb-4">
                        <dt class="fw-bold">AUR2611 WEBSITE EXCLUSIVE</dt>
                    </dl>
                    <a href="{{ route('cart.add', $product->id) }}"
                        class="btn  btn-outline-dark rounded-0 text-uppercase"> Add to cart </a>
                </article>
            </aside>
        </div>
    </div>
    @if($similar->count() > 1)
    <div class="row my-5 pt-4">
        <h5 class="pb-3">More Products like this one</h5>
        @foreach ($similar as $item)
        <div class="col-md-4 col-lg-4 col-12 mb-3 pe-2">
            <a href="{{ route('product.show',$item->tag_number) }}">
                <div class="text-center p-2">
                    <img class="card-img-top img-fluid" src="{{ $item->images()->first()->image_url ?? '' }}" style="width: 100%; height: 360px; object-fit: contain;"  alt="">
                    <div class="card-body px-0 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 card-title product-name">{{ $item->name }}</h4>
                        <p class="card-text fw-bold">£{{ $item->price }}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif


</div>





@endsection


@section('scripts')
<script>
    $('.thumbnail').on('click', function(e) {
        e.preventDefault();
        console.log('clicked');
        var clicked = $(this);
        var newSelection = clicked.data('big');
        var $img = $('.primary').attr("src", newSelection);
        clicked.parent().find('.thumbnail').removeClass('selected');
        clicked.addClass('selected');
        $('.primary').empty().append($img.hide().fadeIn('slow'));
        
    });

</script>
@endsection

{{-- style="width: 100%; height: 360px; object-fit: contain;" --}}
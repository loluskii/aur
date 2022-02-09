@extends('layouts.app')

@section('styles')
<style>
    .img-big-wrap img {
        height: 450px;
        width: auto;
        display: inline-block;
        cursor: zoom-in;
    }


    .img-small-wrap .item-gallery {
        width: 60px;
        height: 60px;
        border: 1px solid rgb(245, 245, 245);
        margin: 7px 2px;
        display: inline-block;
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
    <div class="card border-0 mb-5">
        <div class="row">
            <aside class="col-md-6 text-center border-end">
                <img src="{{ $product->images()->first()->image_url }}" style="height: 480px" class="primary img-fluid">
                <div class="img-small-wrap">
                    @foreach ($product->images->take(4) as $image)
                    <a href="#" class="thumbnail" data-big="{{ $image->image_url }}">
                        <div class="item-gallery"> <img src="{{ $image->image_url }}"> </div>
                    </a>
                    @endforeach
                </div>
            </aside>
            <aside class="col-md-6">
                <article class="card-body p-5">
                    <header class="mb-5">
                        <h4 class="text-uppercase font-weigh mb-1" style="font-weight: bold">{{ $product->name }}</h4>

                        <p class="price-detail-wrap">
                            <span class="price h6" style="font-weight: 500">
                                <span class="currency">$</span><span class="num font-weight-bold">{{ $product->price
                                    }}</span>
                            </span>
                        </p>
                    </header>
                    <dl class="item-property mb-3">
                        <dt>Description</dt>
                        <dd>
                            <p>{{ $product->description }}</p>
                        </dd>
                    </dl>
                    <dl class="item-property mb-3">
                        <dt>Quantity Available</dt>
                        <dd>
                            <p>22 Units remaining</p>
                        </dd>
                    </dl>
                    <a href="{{ route('cart.add', $product->id) }}"
                        class="btn btn-lg btn-outline-dark rounded-0 text-uppercase"> Add to cart </a>
                </article>
            </aside>
        </div>
    </div>
    @if($similar->count() > 1)
    <div class="row my-5 pt-4">
        <h5 class="pb-3">More Products like this one</h5>
        @foreach ($similar as $item)
        <div class="col-md-3 col-6 mb-3 pe-2">
            <a href="{{ route('product.show',$item->tag_number) }}">
                <div class="">
                    <img class="card-img-top img-fluid" src="{{ asset('images/'.$item->image) }}" alt="">
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
    var alterClass = function() {
        var ww = document.body.clientWidth;
        if (ww < 768) {
            $('.modal-dialog').removeClass('modal-dialog-centered');
            $('.modal').addClass('modal-bottom');
            $('.modal-header').addClass('rounded-top');
        } else if (ww >= 768) {
            $('.modal-dialog').addClass('modal-dialog-centered');
            $('.modal').removeClass('modal-bottom');
            $('.modal').addClass('modal-right');
        };
    };
    $(window).resize(function(){
        alterClass();
    });
    //Fire it when the page first loads:
    alterClass();
    
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
@extends('layouts.app')

@section('styles')
<style>
</style>
@endsection

@section('content')
<!------ Include the above in your HEAD tag ---------->

<div class="container mb-5" style="min-height: 70vh">
    <div class="card border-0 mb-5">
        <div class="row">
            <aside class="col-md-6 text-center border-end">
                <img src="{{ $product->image }}" style="height: 500px" class="img-fluid">
            </aside>
            <aside class="col-md-6">
                <article class="card-body p-5">
                    <header class="mb-5">
                        <h4 class="text-uppercase font-weigh mb-1" style="font-weight: bold">{{ $product->name }}</h4>

                        <p class="price-detail-wrap">
                            <span class="price h6" style="font-weight: 500">
                                <span class="currency">$</span><span class="num font-weight-bold">{{ $product->price }}</span>
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
                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-lg btn-outline-dark rounded-0 text-uppercase">  Add to cart </a>
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


@section('script')
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

</script>
@endsection

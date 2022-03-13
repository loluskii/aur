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

        .cat {
            margin: 4px;
            background-color: transparent;
            border-radius: 50%;
            border: 1px solid #000;
            overflow: hidden;
            float: left;
        }

        .cat label {
            float: left;
            width: 32px;
            height: 32px;
        }

        .cat label span {
            text-align: center;
            padding: 3px 0;
            display: block;
        }

        .cat label input {
            position: absolute;
            display: none;
            color: #fff !important;
        }
        .cat label input+span {
            color: #000;
        }
        .cat input:checked+span {
            color: #ffffff;
            background-color: #000;
            text-shadow: 0 0 6px rgba(0, 0, 0, 0.8);
        }
        .action input:checked+span {
            background-color: #000;
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
                        <header
                            class="pt-4 mb-4 d-flex flex-lg-column flex-md-column flex-sm-row justify-contentr-between align-items-lg-start align-items-md-start">
                            <h4 class="text-uppercase font-weigh mb-1 me-auto fw-bold">{{ $product->name }}</h4>

                            <p class="price-detail-wrap">
                                <span class="price h6" style="font-weight: 500">
                                    <span class="currency">$</span>
                                    <span class="num font-weight-bold">{{ $product->price }}</span>
                                </span>
                            </p>
                        </header>
                        <dl class="item-property mb-4" style="max-width: 500px">
                            {{-- <dt>Description</dt> --}}
                            <dd>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam veritatis, id illum magni pariatur aspernatur doloribus ipsa, consectetur rerum soluta, nemo sunt inventore repellat possimus quibusdam eos recusandae? Quisquam, nobis?</p>
                            </dd>
                        </dl>
                        <form class="pt-4" action="{{ route('cart.add',$product->id) }}" method="post">
                            @csrf
                            <div class="d-flex justify-content-start mb-3">
                                <div class="cat action">
                                    <label>
                                        <input type="radio" name="size" value="XS"><span>XS</span>
                                    </label>
                                </div>
                                <div class="cat action">
                                    <label>
                                        <input type="radio" name="size" value="S"><span>S</span>
                                    </label>
                                </div>
                                <div class="cat action">
                                    <label>
                                        <input type="radio" name="size" value="M"><span>M</span>
                                    </label>
                                </div>
                                <div class="cat action">
                                    <label>
                                        <input type="radio" name="size" value="L"><span>L</span>
                                    </label>
                                </div>
                                <div class="cat action">
                                    <label>
                                        <input type="radio" name="size" value="XL"><span>XL</span>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn  btn-outline-dark rounded-0 text-uppercase w-100 fw-bold"> Add to Bag </button>
                        </form>
                        {{-- <dl class="item-property mb-4">
                            <dt class="fw-bold">AUR2611 WEBSITE EXCLUSIVE</dt>
                        </dl> --}}
                        
                    </article>
                </aside>
            </div>
        </div>
        @if ($similar->count() > 1)
            <div class="row my-5 pt-4">
                <h5 class="pb-3">More Products like this one</h5>
                @foreach ($similar as $item)
                    <div class="col-md-4 col-lg-4 col-12 mb-3 pe-2">
                        <a href="{{ route('product.show', $item->tag_number) }}">
                            <div class="text-center p-2">
                                <img class="card-img-top img-fluid" src="{{ $item->images()->first()->image_url ?? '' }}"
                                    style="width: 100%; height: 360px; object-fit: contain;" alt="">
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

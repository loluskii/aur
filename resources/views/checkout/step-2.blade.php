@extends('layouts.app')

@section('styles')
<style>
*{
    text-transform: none;
}
    .main {
        padding-top: 40px;
        padding-right: 40px;
        padding-bottom: 30px;
        padding-left: 20px;

    }

    .wrapper {
        /* padding-left: 30px;
        padding-right: 30px;
        margin-left: 30px;
        margin-right: 30px; */
    }
    
    button, button span {
        color: #ffffff;
        border-radius: 4px;
        border: 0;
        cursor: pointer;
        display: block;
        transition: all 0.2s ease;
        box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
        width: 100%;
    }
    .btn:focus {
        outline: none;
        box-shadow: none;
    }


    button:hover {
        filter: contrast(115%);
    }

    button:disabled {
        opacity: 0.5;
        cursor: default;
    }

    /* spinner/processing state, errors */
    .spinner,
    .spinner:before,
    .spinner:after {
        border-radius: 50%;
    }

    .spinner {
        color: #ffffff;
        font-size: 22px;
        text-indent: -99999px;
        /* margin: 0px auto; */
        margin-left: auto;
        margin-right: auto;
        position: relative;
        width: 20px;
        height: 20px;
        box-shadow: inset 0 0 0 2px;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
    }

    .spinner:before,
    .spinner:after {
        position: absolute;
        content: "";
    }
    .hidden{
        display: none;
    }

    .spinner:before {
        width: 10.4px;
        height: 20.4px;
        background: #212529;
        border-radius: 20.4px 0 0 20.4px;
        top: -0.2px;
        left: -0.2px;
        -webkit-transform-origin: 10.4px 10.2px;
        transform-origin: 10.4px 10.2px;
        -webkit-animation: loading 2s infinite ease 1.5s;
        animation: loading 2s infinite ease 1.5s;
    }

    .spinner:after {
        width: 10.4px;
        height: 10.2px;
        background: #212529;
        border-radius: 0 10.2px 10.2px 0;
        top: -0.1px;
        left: 10.2px;
        -webkit-transform-origin: 0px 10.2px;
        transform-origin: 0px 10.2px;
        -webkit-animation: loading 2s infinite ease;
        animation: loading 2s infinite ease;
    }

    @-webkit-keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }


    .form-control::placeholder {
        color: #837C7C;
        opacity: 1;
        font-size: 15px;
        font-weight: 500px;
    }
    .product__description__variant{
        font-size: 13px;
    }
    @media only screen and (max-width: 595px) {
        .main {
            padding: 20px;
        }
        .wrapper {
            padding-left: 0px;
            padding-right: 0px;
            margin-left: 0px;
            margin-right: 0px;
        }
    }

</style>

@endsection

@section('content')
<div class="" >
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row mb-5" style="min-height: 90vh">
                <div class="col-md-7 col-lg-7">
                    <div class="main">
                        <div class="header">
                            <img src="{{ asset('images/2611.png') }}" class="img-fluid" style="height: 2em;" alt="">
                            <nav aria-label="breadcrumb" class="py-4">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item" aria-current="page"><a href="#">Cart</a></li>
                                    <li class="breadcrumb-item"><a href="#">Information</a></li>
                                    <li class="breadcrumb-item fw-bold">Shipping</li>
                                    <li class="breadcrumb-item ">Payment</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="body py-3">
                            <div class="d-flex justify-content-between">
                                {{-- <h4 class="mb-4">Contact Information</h4> --}}
                            </div>
                            <form action="{{ route('checkout.step_two') }}" method="post" id="shipping-form" class="shipping-form pb-5">
                                @csrf
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <div class="contact d-flex justify-content-between align-items-center">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="text-muted fw-bold">Contact</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class=" text-wrap">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>
                                            <a href=""><small  class="text-danger fw-bold">Change</small></a>
                                        </div>
                                        <hr style="width: auto">
                                        <div class="shipping d-flex justify-content-between align-items-center">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="text-muted fw-bold">Ships to</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="text-wrap">{{ $order->shipping_address }},{{ $order->shipping_zipcode }} {{ $order->shipping_state }}, {{ $order->shipping_zipcode }}</span>
                                                </div>
                                            </div>
                                            <a href="{{ route('checkout.index') }}"><small class="text-danger fw-bold">Change</small></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="shipping-information">
                                    <h5 class="mb-4 fw-bold">Shipping Method</h5>
                                    
                                    <label class="card py-4 px-3 checkbox-label d-flex w-100" id="planbox">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <input type="radio" class="me-4" checked value="{{ $conditionValue }}" name="shipping">
                                                <input type="hidden" name="subtotal" value="{{ Cart::session(auth()->id())->getSubTotal() }}"> 
                                                <input type="hidden" name="grand_total" value="{{ Cart::session(auth()->id())->getTotal() }}">
                                                <h5 class="fw-bold text-muted">Standard Shipping</h5>
                                            </div>
                                            <span class="fw-bold">${{ $conditionValue }}</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-12 pt-3">
                                    <button id="card-button" type="submit" class="btn btn-lg btn-dark py-3 px-3 me-2 btn-block"> <div class="spinner hidden my-1" id="spinner"></div>
                                        <span id="button-text">Continue to Payment</span></button>
                                        <a href="{{ route('checkout.index') }}" class="btn btn-lg py-3 px-3 text-danger"><small>Back to previous step</small></a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-md-5 col-lg-5 d-sm-none d-md-block border-start ps-4 pt-5">
                    <div class="product border-bottom">
                        <table class="table table-borderless">
                            <tbody>
                            @foreach ($cartItems as $item)
                            <tr class="d-flex align-items-center">
                                <td scope="row" style="width: 20%;">
                                    <img class="img-fluid img-thumbnail" style="height: 60px;" src="{{ asset('images/'.$item->associatedModel->image) }}" alt="">
                                </td>
                                <td style="width: 60%;">
                                    <span class="product__description__variant order-summary__small-text text-uppercase" style="display: block;">{{ $item->name }}</span>
                                </td>
                                <td style="width: 20%;">
                                    ${{ number_format($item->price,2) }}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="price border-bottom">
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span>Subtotal</span>
                            <span>${{ number_format(Cart::session(auth()->id())->getSubTotal(),2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span>Shipping</span>
                            <span>${{ $conditionValue }}</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-4">
                        <span>Order Total</span>
                        <h2>${{ number_format(Cart::session(auth()->id())->getTotal(),2) }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        var form = document.getElementById('shipping-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        setLoading(true);
        setTimeout(function () {
            $(".shipping-form").submit();
        }, 5000);
    });

    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            document.querySelector("#card-button").classList.add("disabled");
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#button-text").classList.add("hidden");
        } else {
            document.querySelector("#card-button").classList.remove("disabled");
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#button-text").classList.remove("hidden");
        }
    }

    </script>
@endsection

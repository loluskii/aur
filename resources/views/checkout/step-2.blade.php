@extends('layouts.app')

@section('styles')
    <style>
        * {
            text-transform: none;
            font-size: 14px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", sans-serif;
            line-height: 1.3em;
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
            -webkit-font-smoothing: subpixel-antialiased;
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

        form button,
        form button span {
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

        .form-control::placeholder {
            color: #837C7C;
            opacity: 1;
            font-size: 15px;
            font-weight: 500px;
        }

        .product__description__variant {
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

        .accordion-button:not(.collapsed) {
            color: #000;
            background-color: #fff;
            box-shadow: inset 0 -1px 0 rgb(0 0 0 / 13%);
        }

        .accordion-body {
            padding: 1rem 1.25rem;
            background-color: #e6e6e6;
        }

    </style>
@endsection

@section('content')
    <div class="">
        <div class="container px-0">
            <div class="wrapper px-0">
                <div class="row mb-5" style="min-height: 90vh">
                    <div class="col-md-7 col-lg-7">
                        <div class="main">
                            <div class="header">
                                <a href="/"><img src="{{ secure_asset('images/2611.png') }}" class="img-fluid" style="height: 2em;" alt=""></a>
                                <nav aria-label="breadcrumb" class="py-4">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item" aria-current="page"><a
                                                href="{{ route('shop') }}">Cart</a></li>
                                        <li class="breadcrumb-item active"><a
                                                href="{{ route('checkout.index') }}">Information</a></li>
                                        <li class="breadcrumb-item" style="font-weight: 500">Shipping</li>
                                        <li class="breadcrumb-item ">Payment</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="body py-3">
                                <div class="accordion accordion-flush mb-4 d-sm-block d-md-none d-lg-none"
                                    id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed px-1 fw-bold border-bottom"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="true" aria-controls="flush-collapseOne">
                                                <i class="bi bi-cart4 me-2" style="font-size: 25px"></i> Show Order Summary
                                                ${{ number_format(\Cart::session(auth()->check() ? auth()->id() : 'guest')->getTotal(), 2) }}
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="product border-bottom">
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            @foreach ($cartItems as $item)
                                                                <tr class="d-flex align-items-center">
                                                                    <td scope="row" style="width: 20%;">
                                                                        <img class="img-fluid img-thumbnail"
                                                                            style="height: 60px;"
                                                                            src="{{ $item->associatedModel->image }}"
                                                                            alt="">
                                                                    </td>
                                                                    <td style="width: 60%;">
                                                                        <span
                                                                            class="product__description__variant order-summary__small-text text-uppercase"
                                                                            style="display: block;">{{ $item->name }}</span>
                                                                    </td>
                                                                    <td style="width: 20%;">
                                                                        ${{ number_format($item->price, 2) }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="price border-bottom">
                                                    <div class="d-flex justify-content-between align-items-center py-3">
                                                        <span>Subtotal</span>
                                                        <span>${{ number_format(Cart::session(auth()->check() ? auth()->id() : 'guest')->getSubTotal(), 2) }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center py-3">
                                                        <span>Shipping</span>
                                                        <span>Calculated at the next step</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center py-4">
                                                    <span>Order Total</span>
                                                    <h3>${{ number_format(Cart::session(auth()->check() ? auth()->id() : 'guest')->getTotal(), 2) }}
                                                    </h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-between">
                                    {{-- <h4 class="mb-4">Contact Information</h4> --}}
                                </div>
                                <form action="{{ route('checkout.step_two') }}" method="post" id="shipping-form"
                                    class="shipping-form pb-5">
                                    @csrf
                                    <div class="card mb-5">
                                        <div class="card-body">
                                            <div class="contact d-flex justify-content-between align-items-center">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span class="text-muted">Contact</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <span
                                                            class=" text-wrap">{{ Auth::user()->email ?? $order->shipping_email }}</span>
                                                    </div>
                                                </div>
                                                <a href=""><small
                                                        style="color: #bf7a49; font-weight: 500">Change</small></a>
                                            </div>
                                            <hr style="width: auto">
                                            <div class="shipping d-flex justify-content-between align-items-center">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span class="text-muted">Ships to</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <span
                                                            class="text-wrap">{{ $order->shipping_address }},{{ $order->shipping_state }},
                                                            {{ $order->shipping_country }}</span>
                                                    </div>
                                                </div>
                                                <a href="{{ route('checkout.index') }}"><small
                                                        style="color: #bf7a49; font-weight: 500">Change</small></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="shipping-information">
                                        <h4 style="font-weight: normal" class="mb-4">Shipping Method</h4>

                                        <label class="card p-3 checkbox-label d-flex w-100" id="planbox">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <input type="radio" class="me-4" checked
                                                        value="{{ $conditionValue }}" name="shipping">
                                                    <input type="hidden" name="subtotal"
                                                        value="{{ \Cart::session(auth()->check() ? auth()->id() : 'guest')->getSubTotal() }}">
                                                    <input type="hidden" name="grand_total"
                                                        value="{{ \Cart::session(auth()->check() ? auth()->id() : 'guest')->getTotal() }}">
                                                    <h5 class="h6 text-muted">Standard Shipping</h5>
                                                </div>
                                                <span>${{ $conditionValue }}</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-12 pt-3 text-center">
                                        <button id="card-button" style="padding: 1.4em 1.7em;" type="submit"
                                            class="btn btn-dark btn-block">
                                            <div class="spinner hidden my-1" id="spinner"></div>
                                            <span id="button-text">Continue to Payment</span>
                                        </button>
                                        <a href="{{ redirect()->back() }}"
                                            class="btn btn-lg py-2 px-3 text-danger"><small>Back to previous
                                                step</small></a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    @include('checkout.cart-content')
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
            setTimeout(function() {
                $(".shipping-form").submit();
            }, 500);
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

@extends('layouts.app')

@section('styles')
<style>
    * {
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
</style>

@endsection

@section('content')
<div class="">
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row mb-5" style="min-height: 90vh">
                <div class="col-md-7 col-lg-7">
                    <div class="main">
                        <div class="header">
                            <img src="{{ asset('images/2611.png') }}" class="img-fluid" style="height: 2em;" alt="">
                            <nav aria-label="breadcrumb" class="py-4">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Cart</a></li>
                                    <li class="breadcrumb-item"><a href="#">Information</a></li>
                                    <li class="breadcrumb-item">Shipping</li>
                                    <li class="breadcrumb-item ">Payment</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="body py-3">
                            <div class="d-flex justify-content-between">
                                {{-- <h4 class="mb-4">Contact Information</h4> --}}
                            </div>
                            <form action="{{ route('checkout.step_one') }}" method="post" class="pb-5">
                                @csrf
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <div class="contact d-flex justify-content-between align-items-center">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="text-muted fw-bold">Contact</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="text-uppercase text-wrap">{{ Auth::user()->email
                                                        }}</span>
                                                </div>
                                            </div>
                                            <a href=""><small class="text-danger fw-bold">Change</small></a>
                                        </div>
                                        <hr style="width: auto">
                                        <div class="shipping d-flex justify-content-between align-items-center">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="text-muted fw-bold">Ships to</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="">{{ $order->shipping_address }},{{
                                                        $order->shipping_zipcode }} {{ $order->shipping_state }}, {{
                                                        $order->shipping_zipcode }}</span>
                                                </div>
                                            </div>
                                            <a href=""><small class="text-danger fw-bold">Change</small></a>
                                        </div>
                                        <hr style="width: auto">
                                        <div class="method d-flex justify-content-between align-items-center">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="text-muted fw-bold">Method</span>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="">Standard Shipping . $50 </span>
                                                </div>
                                            </div>
                                            {{-- <a href=""><small class="text-danger fw-bold">Change</small></a> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="shipping-information">
                                    <h4 class="fw-bold">Payment</h4>
                                    <p>All payments are secure and encrypted. We will never share your details with
                                        anyone</p>


                                </div>
                                <div class="col-12 pt-3">
                                    {{-- <div class="card driving-license-settings" id="accordion">
                                        <div class="card">
                                            <div class="card-heading">
                                                <h4 class="card-title">
                                                    <div class="checkbox">
                                                        <label data-toggle="collapse" data-target="#collapseOne">
                                                            <input type="checkbox" /> I have Driver License
                                                        </label>
                                                    </div>
                                                </h4>

                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="driving-license-kind">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"
                                                                aria-label="Amount (to the nearest dollar)">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-lock"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label"></label>
                                                            <input
                                                                type="text|password|email|number|submit|date|datetime|datetime-local|month|color|range|search|tel|time|url|week"
                                                                name="" id="" class="form-control" placeholder=""
                                                                aria-describedby="helpId">
                                                            <small id="helpId" class="text-muted">Help text</small>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> --}}
                                    <div class="accordion bg-white" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header bg-light" id="headingOne">
                                                {{-- <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <input type="checkbox" /> 
                                                </button> --}}
                                                <div class="checkbox py-3 px-3">
                                                    <label data-bs-toggle="collapse" class="w-100" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <div class="d-flex justify-content-between">
                                                            <h4>Credit Card</h4>
                                                            <div class="d-flex align-items-center images">
                                                                <img src="{{ asset('images/payment/visa.svg') }}" class="img-fluid mx-1" alt="" srcset="">
                                                                <img src="{{ asset('images/payment/master.svg') }}" class="img-fluid mx-1" alt="" srcset="">
                                                                <img src="{{ asset('images/payment/american_express.svg') }}" class="img-fluid mx-1" alt="" srcset="">
                                                                <img src="{{ asset('images/payment/discover.svg') }}" class="img-fluid" alt="" srcset="">
                                                                {{-- <span>and more ...</span> --}}
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show "
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-lg" placeholder="Card Number"  aria-label="Amount (to the nearest dollar)">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-lock fa-2x text-mute py-1"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="" class="form-label"></label>
                                                        <input type="text" class="form-control form-control-lg" name="" id="" aria-describedby="emailHelpId" placeholder="Name on Card">
                                                    </div>
                                                    <div class="row g-3 mb-3">
                                                        <div class="col mt-0">
                                                            <div class="form-group">
                                                                <label for="" class="form-label"></label>
                                                                <input type="text" class="form-control form-control-lg" name="" id="" aria-describedby="emailHelpId" placeholder="Expiration Date (MM / YY)">
                                                            </div>
                                                        </div>
                                                        <div class="col mt-0">
                                                            <div class="form-group">
                                                                <label for="" class="form-label"></label>
                                                                <input type="text" class="form-control form-control-lg" name="" id="" aria-describedby="emailHelpId" placeholder="Security Code">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                        <img class="img-fluid img-thumbnail" style="height: 60px;"
                                            src="{{ $item->associatedModel->image }}" alt="">
                                    </td>
                                    <td style="width: 60%;">
                                        <span
                                            class="product__description__variant order-summary__small-text text-uppercase"
                                            style="display: block;">{{ $item->name }}</span>
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
                            <span>${{ $condition_value }}</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-4">
                        <span>Shipping</span>
                        <h2>${{ number_format(Cart::session(auth()->id())->getTotal(),2) }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


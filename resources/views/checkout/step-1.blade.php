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
    <div class="container">
        <div class="wrapper">
            <div class="row mb-5">
                <div class="col-md-7 col-lg-7 col-12">
                    <div class="main">
                        <div class="header">
                            <img src="{{ asset('images/2611.png') }}" class="img-fluid" style="height: 2em;" alt="">
                            <nav aria-label="breadcrumb" class="py-4">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item" aria-current="page"><a
                                            href="{{ route('shop') }}">Cart</a></li>
                                    <li class="breadcrumb-item active fw-bold"><a
                                            href="{{ route('checkout.index') }}">Information</a></li>
                                    <li class="breadcrumb-item">Shipping</li>
                                    <li class="breadcrumb-item ">Payment</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="body py-3">
                            <div class="mb-4 d-sm-block d-md-none d-lg-none">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed px-1 fw-bold border-bottom"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseOne" aria-expanded="true"
                                                aria-controls="flush-collapseOne">
                                                <i class="bi bi-cart4 me-2" style="font-size: 25px"></i> Show Order
                                                Summary
                                                $4055
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
                                                        <span>${{
                                                            number_format(Cart::session(auth()->id())->getSubTotal(),2)
                                                            }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center py-3">
                                                        <span>Shipping</span>
                                                        <span>Calculated at the next step</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center py-4">
                                                    <span>Order Total</span>
                                                    <h3>${{ number_format(Cart::session(auth()->id())->getTotal(),2) }}
                                                    </h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h4 class="mb-4">Contact Information</h4>
                                @if (!Auth::check())
                                <small>Have an account already? <a href="">Log in</a></small>
                                @endif
                            </div>
                            <form action="{{ route('checkout.step_one') }}" method="post" class="pb-5">
                                @csrf
                                @if (Auth::check())
                                <div class="card-body mb-3 ps-0">
                                    <h6>{{ Auth::user()->fname }} {{ Auth::user()->lname }} ({{ Auth::user()->email }})
                                    </h6>
                                    <a href="{{ route('signout') }}"><small class="text-danger">Logout</small></a>
                                </div>
                                @else
                                <div class="mb-5">
                                    <input type="email" class="form-control "
                                        placeholder="Contact Information" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone
                                        else.</div>
                                </div>
                                @endif
                                <div class="shipping-information">
                                    <h5 class="mb-4">Shipping Address</h5>
                                    <div class="mb-3">
                                        <!-- <small class="text-muted">Country/Region</small> -->
                                        <select class="form-select" name="shipping_country" required
                                            aria-label="Default select example">
                                            <option value="NG">Nigeria</option>
                                        </select>
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col">
                                            <!-- <small class="text-muted">First Name</small> -->
                                            <input type="text" name="shipping_fname"
                                                class="form-control " required placeholder="First name"
                                                value="{{ Auth::user()->fname }}" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <!-- <small class="text-muted">Last Name</small> -->
                                            <input type="text" name="shipping_lname"
                                                class="form-control " required placeholder="Last name"
                                                value="{{ Auth::user()->lname }}" aria-label="Last name">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label for="exampleInputEmail1" class="form-label">Address</label> -->
                                        <input type="address" name="shipping_address" placeholder="Address" required
                                            class="form-control "
                                            value="{{ $order_details->shipping_address ?? '' }}" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label for="exampleInputEmail1" class="form-label">Apartment, suite, etc. (optional)</label> -->
                                        <input type="text" name="shipping_landmark"
                                            placeholder="Apartment, suite, etc. (optional)"
                                            class="form-control " id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col">
                                            <!-- <small class="text-muted">City</small> -->
                                            <input type="text" name="shipping_city" class="form-control "
                                                value="{{ $order_details->shipping_city ?? '' }}" required
                                                placeholder="City">
                                        </div>
                                        <div class="col">
                                            <!-- <small class="text-muted">City</small> -->
                                            <input type="text" name="shipping_state"
                                                class="form-control "
                                                value="{{ $order_details->shipping_state ?? '' }}" required
                                                placeholder="State">
                                        </div>
                                        <div class="col">
                                            <!-- <small class="text-muted">Postal Code</small> -->
                                            <input type="text" name="shipping_zipcode"
                                                value="{{ $order_details->shipping_zipcode ?? '' }}"
                                                class="form-control " required placeholder="Postal Code"
                                                aria-label="Postal Code">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label for="exampleInputEmail1" class="form-label">Contact Information</label> -->
                                        <input type="text" name="shipping_phone"
                                            value="{{ $order_details->shipping_phone ?? '' }}"
                                            placeholder="Phone Number" required class="form-control "
                                            id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-12 pt-3">
                                    <button type="submit" class="btn btn-primary btn-dark py-2 px-3">Continue to
                                        shipping</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-md-5 col-lg-5 d-sm-none d-md-block border-start ps-4 pt-5 d-sm-block d-none">
                    <div class="product border-bottom">
                        <table class="table table-borderless">
                            <tbody>
                                @foreach ($cartItems as $item)
                                <tr class="d-flex align-items-center">
                                    <td scope="row" style="width: 20%;">
                                        <img class="img-fluid img-thumbnail" style="height: 60px;"
                                            src="{{ $item->associatedModel->images()->first()->image_url ?? '' }}" alt="">
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
                            <span>Calculated at the next step</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-4">
                        <span>Order Total</span>
                        <h3>${{ number_format(Cart::session(auth()->id())->getSubTotal(),2) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
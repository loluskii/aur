@extends('layouts.app')

@section('styles')
<style>
    .main {
        padding-right: 40px;

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
<div class="">
    <div class="container">
        <div class="wrapper">
            <div class="row mb-5">
                <div class="col-md-7 col-lg-7">
                    <div class="main">
                        <div class="header">
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
                                <h4 class="mb-4">Contact Information</h4>
                                @if (!Auth::check())
                                    <small>Have an account already? <a href="">Log in</a></small>
                                @endif
                            </div>
                            <form action="" method="post" class=" pb-5">
                                @if (Auth::check())
                                <div class="card-body mb-3 ps-0">
                                    <h6>{{ Auth::user()->fname }} {{ Auth::user()->lname }} ({{ Auth::user()->email }})</h6>
                                    <a href="{{ route('signout') }}"><small class="text-danger">Logout</small></a>
                                </div>
                                @else
                                <div class="mb-5">
                                    <input type="email" class="form-control form-control-lg"
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
                                        <select class="form-select form-select-lg"
                                            aria-label="Default select example">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col">
                                            <!-- <small class="text-muted">First Name</small> -->
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="First name" value="{{ Auth::user()->fname }}" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <!-- <small class="text-muted">Last Name</small> -->
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Last name" value="{{ Auth::user()->lname }}" aria-label="Last name">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label for="exampleInputEmail1" class="form-label">Address</label> -->
                                        <input type="address" placeholder="Address"
                                            class="form-control form-control-lg" value="{{ Auth::user()->address_line_1 }}" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label for="exampleInputEmail1" class="form-label">Apartment, suite, etc. (optional)</label> -->
                                        <input type="email" placeholder="Apartment, suite, etc. (optional)"
                                            class="form-control form-control-lg" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col">
                                            <!-- <small class="text-muted">City</small> -->
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="City" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <!-- <small class="text-muted">Postal Code</small> -->
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Postal Code" aria-label="Last name">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label for="exampleInputEmail1" class="form-label">Contact Information</label> -->
                                        <input type="email" placeholder="Phone Number"
                                            class="form-control form-control-lg" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-12 pt-3">
                                    <button type="submit" class="btn btn-primary btn-dark py-3 px-3">Continue to
                                        shipping</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-md-5 col-lg-5 d-sm-none d-md-block border-start ps-4">
                    <div class="product border-bottom">
                        <table class="table table-borderless">
                            <tbody>
                            @foreach ($cartItems as $item)
                            <tr class="d-flex align-items-center">
                                <td scope="row" style="width: 20%;">
                                    <img class="img-fluid img-thumbnail" style="height: 60px;" src="{{ $item->associatedModel->image }}" alt="">
                                </td>
                                <td style="width: 60%;">
                                    <span class="product__description__variant order-summary__small-text text-uppercase" style="display: block;">{{ $item->name }}</span>
                                </td>
                                <td style="width: 20%;">
                                    ${{ $item->price }}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="price border-bottom">
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span>Subtotal</span>
                            <span>{{ Cart::session(auth()->id())->getSubTotal(); }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span>Shipping</span>
                            <span>Calculated at the next step</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-4">
                        <span>Shipping</span>
                        <h3>${{ Cart::session(auth()->id())->getTotal(); }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

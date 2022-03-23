@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row g-5 justify-content-center">
            @php
                $cartItems = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getContent();
            @endphp
            @foreach ($cartItems as $item)
                <div class="col-md-5 col-sm-12 col-lg-5 mb-3 border-bottom">
                    <div class="d-flex flex-column  py-3">
                        {{-- <div class="d-flex w-100"> --}}
                        <img src="{{ $item->associatedModel->images()->first()->image_url ?? '' }}" class="img-fluid"
                            style="height: ;" alt="" srcset="">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="mt-3" style="line-height: 1.2">CHENILLE VARSITY JACKET L /
                                TAN/GREEN</small>
                            <small class="mt-3"
                                style="line-height: 1.2">${{ number_format($item->price) }}</small>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                        <small>QUANTITY</small>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                <input type="number" onchange="this.form.submit()" class="qty-text" id="qty2" step="1"
                                    min="1" max="99" name="quantity"
                                    style="width: 50px; text-align: center; border-radius: 3px; border: 1px solid rgb(228, 228, 228)"
                                    value="{{ $item->quantity }}">
                            </form>
                        </div>
                        {{-- <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                <input type="number" onchange="this.form.submit()" class="qty-text me-5"
                                    id="qty2" step="1" min="1" max="99" name="quantity"
                                    style="width: 50px; text-align: center; border-radius: 3px; border: 1px solid rgb(228, 228, 228)"
                                    value="{{ $item->quantity }}">
                            </form> --}}
                        <div class="ms-3 d-flex">

                            {{-- <small class="bg-light mb-2"><a class="ps-1" style="font-size: 13px" href="{{ route('cart.destroy', $item->id) }}">DELETE</a></small> --}}
                            {{-- <div class="d-flex justify-content-between">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                        @csrf
                                        <input type="number" onchange="this.form.submit()" class="qty-text me-5"
                                            id="qty2" step="1" min="1" max="99" name="quantity"
                                            style="width: 50px; text-align: center; border-radius: 3px; border: 1px solid rgb(228, 228, 228)"
                                            value="{{ $item->quantity }}">
                                    </form>
                                    <small>${{ number_format($item->price) }}</small>
                                </div> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 col-lg-5 mx-auto">
                <div class="d-flex justify-content-between mt-3">
                    <small>SUBTOTAL</small>
                    <p class="mb-0 font-weight-bold">
                        ${{ number_format(Cart::session(auth()->check() ? auth()->id() : 'guest')->getSubTotal(), 2) }}
                    </p>

                </div>
                <div class="d-flex">
                    <a href="{{ route('shop') }}"
                    class="btn btn-dark btn-block w-100 btn-lg rounded-0 fw-bold py-3 me-3  mt-3 {{ $cartItems->count() > 0 ? '' : 'disabled' }}">BACK TO STORE</a>
                    <a href="{{ route('checkout.index') }}"
                    class="btn btn-dark btn-block w-100 btn-lg rounded-0 fw-bold py-3  mt-3 {{ $cartItems->count() > 0 ? '' : 'disabled' }}">CHECKOUT</a>
                </div>
                <div class="text-center">
                    <small class="text-center" style="font-size: 10px">SHIPPING & TAXES CALCULATED AT CHECKOUT</small>
                </div>
            </div>

        </div>
    </div>
@endsection

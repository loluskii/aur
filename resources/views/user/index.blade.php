@extends('layouts.app')
@section('styles')
<style>
    #about-us p,
    #about-us h6 {
        font-size: 14px;
        line-height: 30px;
        text-transform: none;
    }
</style>
@endsection
@section('content')
<div class="container pt-3 pb-5" id="about-us" style="min-height: 75vh">

    <div class="row">

        <div class="col-md-4 col-lg-4 col-sm-12 border-end">
            <section class="py-3 px-3">
                <h6 class="text-start fw-bolder">ACCOUNT INFORMATION</h6>
                <p class="mb-0">{{ Auth::user()->getFullName() }}</p>
                <p>{{ Auth::user()->email }} | {{ Auth::user()->phone_no ?? 'No Phone Contact' }}</p>
            </section>
            <section class="pt-3 pb-5 px-3">
                <h6 class="text-start fw-bolder">DEFAULT ADRRESS</h6>
                @if ($address)
                <p>{{ $address }}</p>
                <div class="d-flex">
                    <a href="{{ route('account.address.edit') }}" class="text-decoration-underline me-3">EDIT</a>
                    <a href="{{ route('account.address.delete', $address_id->id) }}"
                        class="text-decoration-underline">DELETE</a>
                </div>
                @else
                <p class="mb-0">No default address</p>
                <a href="{{ route('account.address.add') }}" class="text-decoration-underline">ADD ADDRESS</a>
                @endif
                <p></p>
            </section>
            <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" id="" class="d-none d-md-block d-lg-block d-xl-block px-3 py-2 btn btn-dark fw-bold">LOG OUT</button>
            <form id="logout-form" action="{{ route('signout') }}" method="POST" class="d-none">
                @csrf
            </form>


        </div>
        <div class="col-md-8 col-lg-8 col-sm-12">
            <section class="py-3 px-lg-3 px-md-3 px-3">
                <h6 class="text-start fw-bolder">Recent Orders</h6>
                @if ($orders->count() < 1) <p>No recent orders</p>
                    @else
                        @foreach ($orders as $order)
                            @php
                                if($order->status == 1){
                                    $status = 'Pending';
                                }elseif ($order->status == 2) {
                                    $color = 'bg-warning';
                                    $status = 'Awaiting Pickup';
                                }elseif ($order->status == 3) {
                                    $color = 'bg-info';
                                    $status = 'Shipping in Progress';
                                }elseif ($order->status == 4) {
                                    $color = 'bg-success';
                                    $status = 'Shipped';
                                }elseif ($order->status == 5) {
                                    $color = 'bg-danger';
                                    $status = 'Cancelled';
                                }else {
                                    $status = 'Unknown';
                                }
                            @endphp
                            <div class="py-2 border-top-0 border-left-0 border-right-0 rounded-0 border-bottom mb-3">
                                <div class="card-body px-1 px-lg-2 px-md-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <div class="col-md-1 ms-3 me-4 col-lg-1 col-sm-1 d-flex align-items-center justify-content-center">
                                                <i class="bi bi-box text-danger" style="font-size: 30px"></i>
                                            </div>
                                            <div class="col-md-11 col-lg-11 col-sm-11">
                                                <blockquote class="blockquote mb-0">
                                                    <h6 class="fw-bold mb-0">Order {{ $order->order_number }}</h6>
                                                    <p>{{ $order->created_at->diffForHumans() }} | <span class="badge {{ $color ?? 'bg-secondary' }}">{{ $status }}</span></p>
                                                </blockquote>
                                            </div>
                                        </div>
                                        <a href="{{ route('account.order.show', $order->order_reference) }}" class="btn btn-dark btn-sm"> <span class="d-lg-none d-md-none d-xl-none"><i class="bi bi-eye-fill" style="color: white"></i></span> <span style="color: white" class="d-none d-lg-block d-md-block d-xl-block">View Details</span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
            </section>


        </div>
    </div>
</div>
@endsection
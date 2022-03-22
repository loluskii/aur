@extends('admin.layouts.app')\

@section('page-title')
<div class="pagetitle d-flex justify-content-between align-items-center">
    <div>
        <h1>Orders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item ">Orders</li>
                <li class="breadcrumb-item active">Order {{ $order->order_number }}</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->
@endsection

@section('styles')
<style>
    .invoice-title h2,
    .invoice-title h3 {
        display: inline-block;
    }

    .table>tbody>tr>.no-line {
        border-top: none;
    }

    .table>thead>tr>.no-line {
        border-bottom: none;
    }

    .table>tbody>tr>.thick-line {
        border-top: 2px solid;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Order Total</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6>${{ number_format($order->grand_total,2) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Sales Card -->

        <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Item Count</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $order->item_count }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Sales Card -->
        
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body text-dark py-4">
                    <div class="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between text-dark">
                                    <h3>Invoice</h2>
                                        <h5 class="pull-right">Order {{ $order->order_number }}
                                    </h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Billed To:</strong><br>
                                            {{ $order->shipping_fname }} {{ $order->shipping_lname }}<br>
                                            {{ $order->shipping_address }}<br>
                                            {{ $order->shipping_state }}
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <address>
                                            <strong>Shipped To:</strong><br>
                                            {{ $order->shipping_fname }} {{ $order->shipping_lname }}<br>
                                            {{ $order->shipping_address }}<br>
                                            {{ $order->shipping_state }}
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Payment Method:</strong><br>
                                            {{ $order->user->pm_type }} **** {{ $order->user->pm_last_four }}<br>
                                            {{ $order->user->email }}
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <address>
                                            <strong>Order Date:</strong><br>
                                            {{ $order->created_at }}<br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row pt-4">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading mb-4">
                                        <h3 class="panel-title"><strong>Order summary</strong></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-condensed text-start text-dark">
                                                <thead>
                                                    <th>Item name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total</th>

                                                </thead>
                                                <tbody>
                                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->

                                                    @foreach ($order->items as $item)
                                                    @php
                                                    $total = $item->pivot->quantity * $item->pivot->price;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->pivot->quantity }}</td>
                                                        <td>{{ number_format($item->pivot->price, 2) }}</td>
                                                        <td> {{ number_format($total, 2) }}</td>
                                                    </tr>
                                                    @endforeach

                                                    <tr>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line text-start"><strong>Subtotal</strong>
                                                        </td>
                                                        <td class="thick-line text-right">${{
                                                            number_format($order->subtotal,2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-start"><strong>Shipping</strong>
                                                        </td>
                                                        <td class="no-line text-right">$50.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-start"><strong>Total</strong></td>
                                                        <td class="no-line text-start">${{
                                                            number_format($order->grand_total, 2) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>
    <!-- Content Row -->
</div>
@endsection

@section('third_party_scripts')
<script>
    $('#recentOrders').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
});
</script>


@endsection
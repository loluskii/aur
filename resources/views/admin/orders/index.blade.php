@extends('admin.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Orders</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Orders</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Sales <span>| This Month</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $orders->count() }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Revenue <span>| This Month</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>${{ number_format($sales, 2) }}</h6>

                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Revenue Card -->

        <div class="col-12">
            <div class="card recent-sales">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Orders</h5>

                    <table class="table table-borderless" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Order Number</th>
                                <th scope="col">Item Count</th>
                                <th scope="col">Order Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $order->shipping_fname }} {{ $order->shipping_lname }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->item_count }}</td>
                                <td>${{ number_format($order->grand_total, 2) }}</td>
                                <td> <a name="" id="" class="btn btn-primary btn-sm"
                                        href="{{ route('admin.orders.show', $order->order_reference) }}"
                                        role="button">View</a> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div><!-- End Recent Sales -->

    </div>
</section>

@endsection
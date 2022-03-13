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
                            <h6>{{ $monthlySalesCount }}</h6>
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
                            <h6>${{ number_format($monthlyRevenue, 2) }}</h6>

                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Revenue Card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Pending Orders </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $pendingOrders }}</h6>

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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orders as $key => $order)
                            @php
                            if($order->status == 1){
                            // $color == null;
                            $status = 'Pending';
                            }elseif ($order->status == 2) {
                            // $color = null;
                            $status = 'Awaiting Pickup';
                            }elseif ($order->status == 3) {
                            // $color = null;
                            $status = 'Shipping in Progress';
                            }elseif ($order->status == 4) {
                            // $color = 'bg-warning';
                            $status = 'Shipped';
                            }elseif ($order->status == 5) {
                            // $color = 'bg-success';
                            $status = 'Delivered';
                            }elseif ($order->status == 6) {
                            $color = 'bg-danger';
                            $status = 'Cancelled';
                            }else {
                            $color = 'bg-secondary';
                            $status = 'Unknown';
                            }
                            @endphp
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $order->shipping_fname ?? 'Guest' }} {{ $order->shipping_lname ?? 'User' }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->item_count }}</td>
                                <td>${{ number_format($order->grand_total, 2) }}</td>
                                <td><span class="p-2 badge {{ $color ?? 'bg-secondary' }}">{{ $status }}</span></td>
                                <td>
                                    @if ($order->status == 0)
                                    <button class="btn btn-info btn-sm">Refund</button>
                                    @elseif ($order->status != 5)
                                    <a name="" id="" class="btn btn-primary btn-sm"
                                        href="{{ route('admin.orders.show', $order->order_reference) }}"
                                        role="button">View</a>
                                    <a name="" id="" data-bs-toggle="modal"
                                        data-bs-target="#update{{ $order->order_reference }}"
                                        class="btn btn-warning btn-sm"
                                        href="{{ route('admin.orders.show', $order->order_reference) }}"
                                        role="button">Update</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="update{{ $order->order_reference }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Order{{ $order->order_number }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body pb-0">
                                                    <form action="{{ route('admin.orders.update', $order->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Order Status</label>
                                                            <select class="form-control" name="status" id="">

                                                                @if ($order->status == 1)
                                                                @foreach(["2" => "Awaiting Pickup",
                                                                "3" => "Shipping In Progress", "4" => "Shipped", "5" =>
                                                                "Delivered","6" => "Cancelled"] AS $status =>
                                                                $statusLabel)
                                                                <option value="{{ $status }}">{{ $statusLabel }}
                                                                </option>
                                                                @endforeach
                                                                @elseif ($order->status == 2)
                                                                @foreach([ "3" => "Shipping In Progress", "4" =>
                                                                "Shipped", "5" =>
                                                                "Delivered","6" => "Cancelled"] AS $status =>
                                                                $statusLabel)
                                                                <option value="{{ $status }}">{{ $statusLabel }}
                                                                </option>
                                                                @endforeach
                                                                @elseif ( $order->status == 3)
                                                                @foreach([ "4" => "Shipped", "5" =>
                                                                "Delivered","6" => "Cancelled"] AS $status =>
                                                                $statusLabel)
                                                                <option value="{{ $status }}">{{ $statusLabel }}
                                                                </option>
                                                                @endforeach
                                                                @elseif ( $order->status == 4)
                                                                @foreach(["5" => "Delivered","6" => "Cancelled"] AS
                                                                $status => $statusLabel)
                                                                <option value="{{ $status }}">{{ $statusLabel }}
                                                                </option>
                                                                @endforeach
                                                                @elseif ( $order->status == 5)
                                                                @foreach(["6" => "Cancelled"] AS
                                                                $status => $statusLabel)
                                                                <option value="{{ $status }}">{{ $statusLabel }}
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @elseif ($order->status == 5)
                                    <a name="" id="" class="btn btn-primary btn-sm"
                                        href="{{ route('admin.orders.show', $order->order_reference) }}"
                                        role="button">View</a>
                                    @endif

                                </td>
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
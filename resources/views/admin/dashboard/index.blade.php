@extends('admin.layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    {{-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul> --}}
                </div>

                <div class="card-body">
                    <h5 class="card-title">Sales <span>| This Month</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $orders }}</h6>
                            {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span
                                class="text-muted small pt-2 ps-1">increase</span> --}}

                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Sales Card -->

        <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    {{-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul> --}}
                </div>

                <div class="card-body">
                    <h5 class="card-title">Revenue <span>| This Month</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>${{ number_format($sales, 2) }}</h6>
                            {{-- <span class="text-success small pt-1 fw-bold">8%</span> <span
                                class="text-muted small pt-2 ps-1">increase</span> --}}

                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Revenue Card -->

        <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Customers <span>| This Month</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $monthly_users_count->count() }}</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div><!-- End Customers Card -->

        <div class="col-lg-12">
            <div class="row">

                <!-- Reports -->
                <div class="col-12">
                    <div class="card">

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
                            <h5 class="card-title">Reports <span>/This Month</span></h5>

                            <!-- Line Chart -->
                            <div id="reportsChart"></div>

                            <script>
                                const salesJson = JSON.parse(@json($chartSales));
                                const customerJson = JSON.parse(@json($chartCustomers));
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#reportsChart"), {
                                        series: [{
                                            name: 'Sales',
                                            data: salesJson.y,
                                        }, {
                                            name: 'Customers',
                                            data: customerJson.y
                                        }],
                                        chart: {
                                            height: 350,
                                            type: 'area',
                                            toolbar: {
                                                show: false
                                            },
                                        },
                                        markers: {
                                            size: 4
                                        },
                                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                        fill: {
                                            type: "gradient",
                                            gradient: {
                                                shadeIntensity: 1,
                                                opacityFrom: 0.3,
                                                opacityTo: 0.4,
                                                stops: [0, 90, 100]
                                            }
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        stroke: {
                                            curve: 'smooth',
                                            width: 2
                                        },
                                        xaxis: {
                                            type: 'datetime',
                                            categories: customerJson.x
                                        },
                                        tooltip: {
                                            x: {
                                                format: 'Y-m-d'
                                            },
                                        }
                                    }).render();
                                });
                            </script>
                            <!-- End Line Chart -->

                        </div>

                    </div>
                </div><!-- End Reports -->

                <!-- Recent Sales -->

                <!-- Top Selling -->

            </div>
        </div>

        <div class="col-12">
            <div class="card recent-sales">
                <div class="card-body">
                    <h5 class="card-title">Recent Sales</h5>
                    <table class="table table-borderless" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($recent_orders as $order)
                            <tr>
                                <td>{{ $order->shipping_fname }} {{ $order->shipping_lname }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->item_count }}</td>
                                <td>{{ number_format($order->grand_total) }}</td>
                                <td> <a name="" id="" class="btn btn-primary btn-sm" href="#" role="button">View</a> </td>
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
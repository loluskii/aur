@extends('admin.layouts.app')


@section('page-title')
<div class="pagetitle d-flex justify-content-between align-items-center">
    <div>
        <h1>Products</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item ">Products</li>
            </ol>
        </nav>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createProduct">
        Create Product
    </button>
    @include('admin.products.create-product')
</div>
@endsection

@section('content')
<div class="">
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->

        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $products->count() }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Sales Card -->





    </div>
    <div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">
                <h5 class="card-title">All Products <span> </span></h5>
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 20%">Name</th>
                            <th style="width: 25%">Description</th>
                            <th style="width:5%">Units</th>
                            <th style="width: 15%">Unit Price</th>
                            <th>Quantity left</th>
                            <th>Category</th>
                            <th style="width: 13%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                        @php
                        $table_color = '';
                        if(($product->quantity < $product->alert_quantity) && ($product->quantity > 1)){
                            $table_color = 'table-warning';
                            }elseif ($product->quantity <= 1) { $table_color='table-danger' ; } @endphp <tr class{{
                                $table_color }}>
                                <td>{{ ++$key }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->units }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->quantity_left }}</td>
                                <td>{{ $product->category->name ?? 'No Category' }}</td>
                                <td>
                                    @include('admin.products.product-action')
                                </td>
                                </tr>
                                @endforeach
                    </tbody>
                </table>

            </div>
        </div><!-- End Recent Sales -->


    </div>

</div>
@endsection
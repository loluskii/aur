@extends('admin.layouts.app')

@push('page_css')
<style>
    .table>tbody>tr>.thick-line {
        border-top: 2px solid;
    }

    .table>tbody>tr>.thick-line2 {
        border-top: 2px solid;
        border-bottom: 2px solid;
    }
</style>
@endpush

@section('page-title')
<div class="pagetitle d-flex justify-content-between align-items-center">
    <div>
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item ">Users</li>
                <li class="breadcrumb-item active">Show User</li>
            </ol>
        </nav>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modelId">
      Deactivate User
    </button>
</div><!-- End Page Title -->
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-5 col-md-6">
            <div class="card info-card sales-card">
    
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>
    
                <div class="card-body">
                    <h5 class="card-title">Details</h5>
    
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <div class="ps-2">
                            <h6>{{ $user->fname }} {{ $user->lname }}</h6>
                            <p class="mb-0">{{ $user->email }} | {{ $user->phone_no ?? 'NaN' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
    
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>
    
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>
    
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <div class="ps-2">
                            <h6>{{ $user->orders->count() }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    @if (count($user_orders) > 0)
        @foreach ($user_orders as $order)
        <div class="col-12">
            <div class="card recent-sales">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Order {{ $order->order_number }}</h5>
                        <h6>Date: {{ $order->created_at->diffForHumans() ?? '-' }}</h6>
                    </div>
                    <table class="table table-hover table-bordered datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Totals</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                            @php
                            $total = $item->pivot->quantity * $item->pivot->price;
                            @endphp
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->pivot->quantity }}</td>
                                <td>{{ $item->pivot->price }}</td>
                                <td> {{ $total }}</td>
                            </tr>
                            @endforeach

                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Subtotal</strong>
                                </td>
                                <td class="thick-line text-right">£{{ number_format($order->subtotal,2) }}</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Shipping</strong>
                                </td>
                                <td class="no-line text-right">£{{ number_format($order->delivery_total,2) }}</td>
                            </tr>
                            <tr>
                                <td class="thick-line2"></td>
                                <td class="thick-line2"></td>
                                <td class="thick-line2 text-center"><strong>Total</strong></td>
                                <td class="thick-line2 text-right">£{{ number_format($order->grand_total,2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="card recent-sales">
                <div class="card-body">
                    <h5 class="card-title">No Orders<span> </span></h5>
                    <table class="table table-hover table-bordered datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Totals</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div><!-- End Recent Sales -->
        </div>
    @endif



@endsection

@section('third_party_scripts')
<script>
    $('#usersTabl').DataTable({
    "paging": true,

    // "responsive": true,
});
</script>

@endsection


@extends('admin.layouts.app')

@section('page-title')
<div class="pagetitle d-flex justify-content-between align-items-center">
    <div>
        <h1>Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item ">Category</li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </nav>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modelId">
      Delete
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create a new category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.category.add') }}" method="POST" class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                          <label for="recipient-name" class="form-label">Name:</label>
                          <input type="text" name="name" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group mb-3">
                          <label for="message-text" class="form-label">Description:</label>
                          <textarea class="form-control" name="desc" id="message-text"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
    
</div><!-- End Page Title -->

@endsection


@section('content')
<div class="">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 clas s="h3 mb-0 text-gray-800">Product Name</h1> --}}
        {{-- <a href="{{ route('admin.category.delete', $category->id) }}" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-sm btn-danger">Delete</a> --}}

    </div>

    <!-- Content Row -->
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
                            <h6>{{ 0 }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Sales Card -->

    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5>Products</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="products">
                            <thead>
                                <tr>
                                    <th> Image</th>
                                    <th>Product ID</th>
                                    <th>Name</th>
                                    {{-- <th>Category</th> --}}
                                    <th>Price</th>
                                    <th>Store Owner</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td><img src="{{ $product->cover_img }}" alt="" srcset="" style="height: 50px; width: 50px"></td>
                                    <td>{{ $product->product_ref }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>£{{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->store->name ?? 'Admin' }}</td>
                                    <td>
                                        @include('admin.products.product-action')
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- Button trigger modal -->


@endsection

@section('third_party_scripts')
<script>
$('#products').DataTable({
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



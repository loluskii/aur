

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
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modelId">
      Create Product
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create a new product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.product.store') }}" method="POST" class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                          <label for="" class="form-label">Product Image</label>
                          <input type="file" class="form-control" name="" id="" placeholder="" aria-describedby="fileHelpId">
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" placeholder="" required
                                aria-describedby="helpId">
                        </div>
                        <div class="row g-1 ">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Price</label>
                                    <input type="text" name="price" class="form-control" placeholder="" required
                                        aria-describedby="helpId">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Units Available</label>
                                    <input type="text" name="price" class="form-control" placeholder="" required
                                        aria-describedby="helpId">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Select Category</label>
                            <select class="form-control" name="category">
                                <option value="">Select one</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea class="form-control" name="desc" required id="exampleFormControlTextarea1"
                                rows="2"></textarea>
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


@section('third_party_stylesheets')
<style>
    #preview {
        height: 250px;
        width: 250px;
        object-fit: cover;
    }

    /* #imgInp {
        display: none;
    } */

    .upload {
        display: flex;
        border: 2px solid #ECEEEE;
        background-color: transparent;
        height: 150px;
        width: 174px;
        border-radius: 8px;
        align-items: center;
        font-size: 13px;
        cursor: pointer;
    }
</style>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable" id="products">
                            <thead>
                                <tr>
                                    {{-- <th>Image</th> --}}
                                    <th>ProductID</th>
                                    <th>Name</th>
                                    <th style="width: 30%">Description</th>
                                    <th>Units</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    {{-- <td><img src="{{ $product->cover_img }}" alt="" srcset=""
                                            style="height: 30px; width: 30px"></td> --}}
                                    <td>{{ $product->tag_number }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->units }}</td>
                                    
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->category->name ?? 'No Category' }}</td>
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


<div class="modal fade" id="newProduct" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.product.store') }}" method="POST" class="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Product Image</label>
                        <input type="file" class="form-control-file" name="featured_image" id="" placeholder=""
                            aria-describedby="fileHelpId">
                    </div>
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="product_name" class="form-control" placeholder="" required
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" name="price" class="form-control" placeholder="" required
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="">Select Category</label>
                        <select class="form-control" name="category">
                            <option value="">Select one</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" name="desc" required id="exampleFormControlTextarea1"
                            rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

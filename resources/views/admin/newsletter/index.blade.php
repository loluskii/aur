@extends('admin.layouts.app')

@section('page-title')
<div class="pagetitle d-flex justify-content-between align-items-center">
    <div>
        <h1>Newsletter</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item ">Newsletter</li>
            </ol>
        </nav>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modelId">
        Send Bulk Mail
    </button>

    <!-- Modal -->
    {{-- <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create a new category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.category.add') }}" method="POST" class="form"
                    enctype="multipart/form-data">
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
    </div> --}}

</div><!-- End Page Title -->

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
                    <h5 class="card-title">Subscribers</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $subscribers->count() }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Sales Card -->

    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">
                <h5 class="card-title">All Subscribers <span> </span></h5>
                <table class="table table-hover table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscribers as $key => $subscriber)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $newsletter->user->fname ?? '-' }} {{ $newsletter->user->lname ?? '-' }}</td>
                            <td>{{ $subscriber->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- End Recent Sales -->
    </div>
</div>
@endsection

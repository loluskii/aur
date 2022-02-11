@extends('admin.layouts.app')
{{-- @section('title')
{{ isset($post) ? 'Edit Post' : 'Create Post'}} List
@endsection --}}
@section('page-title')
<div class="pagetitle">
    <h1>Newsletter</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Newsletter</li>
            <li class="breadcrumb-item active">New Mail</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

@endsection


@section('content')

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

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="">
                </div>
                <div class="form-group">
                    <label for="image">Header Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="summernote"></textarea>
                    {{--@trix(\App\Post::class, 'content')--}}
                    {{-- <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : ''}}">
                    <trix-editor input="content"></trix-editor> --}}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        'Add Post'
                    </button>
                </div>
            </form>
    

        </div>

    </div>
</div><!-- End Recent Sales -->

<div class="card card-default">
    <div class="card-header">
        <h1>
            {{'Create Post' }}
        </h1>
    </div>
    <div class="card-body  mb-5">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="">
            </div>
            <div class="form-group">
                <label for="image">Header Image</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="summernote"></textarea>
                {{--@trix(\App\Post::class, 'content')--}}
                {{-- <label for="content">Content</label>
                <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : ''}}">
                <trix-editor input="content"></trix-editor> --}}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    'Add Post'
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<!-- include summernote /js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
                height: 400
            });
</script>

@endpush
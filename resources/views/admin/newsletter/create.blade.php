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
            <h5 class="card-title">New Newsletter</h5>

            <form action="{{ route('admin.newsletter.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="form-label">Email Subsject</label>
                    <input type="text" class="form-control" name="subject" id="title" value="">
                </div>
                <div class="mb-3">
                    <label for="form-label">Header Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="mb-3">
                    <label for="form-label">Content</label>
                    <textarea class="form-control description" name="content" id="editor"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">
                        Send Newsletter
                    </button>
                </div>
            </form>


        </div>

    </div>
</div><!-- End Recent Sales -->
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/blwq635krztu781bb8voax86zskzqaobxzyu07vktqui08mg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script><script>
    tinymce.init({
        selector:'textarea.description',
        // width: 900,
        height: 400,
        
        plugins: [
            'advlist autolink lists link charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste pagebreak wordcount'
          ],
          toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          content_style: 'body { font-family:inherit; font-size:14px }'
    });
</script>
@endpush
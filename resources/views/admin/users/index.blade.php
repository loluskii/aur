@extends('admin.layouts.app')
@section('page-title')
    
@endsection
@section('content')
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    
    <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card">

            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            </div>

            <div class="card-body">
                <h5 class="card-title">Users (Total)</h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $users->count() }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Sales Card -->

</div>


<div class="row">
    <div class="col-12">
        <div class="card recent-sales">
            <div class="card-body">
                <h5 class="card-title">All Users <span> </span></h5>
                <table class="table table-hover table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->fname }} {{ $user->lname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number ?? "Not Availble"}}</td>
                                <td>{{ $user->is_admin == 0 ? 'Normal User' : 'Admin' }}</td>
                                <td><a href="{{ route('admin.users.show', $user->id) }}"
                                        class="btn btn-primary btn-sm">View</a></td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div><!-- End Recent Sales -->


    </div>
</div>

@endsection


@extends('layouts.master-2')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Users</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">users</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User</h4>
                </div>
                <div class="card-body">

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Role</th>
                                <th>Language</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><img src="{{ asset('profile/'. $user->image) }}" width="50" height="50" alt=""></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td><span class="badge bg-primary">{{ $user->role }}</span></td>
                                    <td>{{ $user->language }}</td>
                                    <td>{{ $user->country }}</td>
                                    <td>{{ $user->city }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">Delete</button>

                                        <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" id="delete-form-{{ $user->id }}">
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div> <!-- container-fluid -->
@endsection
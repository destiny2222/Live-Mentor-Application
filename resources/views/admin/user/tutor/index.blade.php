@extends('layouts.master-2')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tutor</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tutor</a></li>
                        <li class="breadcrumb-item active">Tutor</li>
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
                                <th>User name</th>
                                <th>Ttile</th>
                                <th>Experience</th>
                                <th>Price</th>
                                <th>Language</th>
                                <th>Skills</th>
                                <th>Category</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        {{-- 'image_public_id',--}}

                        <tbody>
                            @foreach ($tutors as $tutor)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><img src="{{ asset('profile/'. $tutor->user->image) }}" width="50" height="50" alt=""></td>
                                    <td>{{ $tutor->user->name }}</td>
                                    <td>{{ $tutor->title }}</td>
                                    <td>{{ $tutor->experience }}</td>
                                    <td>&#8358;{{ number_format($tutor->price, 2) }}</td>
                                    <td>{{ $tutor->language }}</td>
                                    <td>
                                        @foreach ($tutor->skill as $skills)
                                            <span class="badge bg-primary">{{ $skills }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($tutor->categories as $category)
                                            <span class="btn btn-primary waves-effect waves-light mb-3" style="font-size: 10px;">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ \Str::limit($tutor->description, 100) }}</td>
                                    <td>
                                        @switch($tutor->is_approved)
                                            @case(1)
                                                <span class="badge bg-success">Active</span>
                                                @break
                                            @case(0)
                                                <span class="badge bg-danger">Inactive</span>
                                                @break
                                            @default
                                                
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.tutor.edit', $tutor->id) }}" class="btn btn-primary btn-sm mb-3">Edit</a>
                                        <a href="{{ route('admin.tutor.delete', $tutor->id) }}" class="btn btn-danger btn-sm mb-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $tutor->id }}').submit();">Delete</a>

                                        <form action="{{ route('admin.tutor.delete', $tutor->id) }}" method="POST" id="delete-form-{{ $tutor->id }}">
                                            @csrf
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
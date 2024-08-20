@extends('layouts.master-2')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Category</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category as $key => $categories)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                {{-- <td><img src="{{ asset('uploads/category/'.$category->image) }}" alt="" style="width: 100px; height: 100px;"></td> --}}
                                <td>{{ $categories->image }}</td>
                                <td>{{ $categories->name }}</td>
                                <td>
                                    <a href="{{ route('admin.category.edit', $categories->id) }}" class="btn btn-primary btn-sm">Edit</a> &nbsp;
                                    <a href="{{ route('admin.category.delete', $categories->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end cardaa -->
        </div> <!-- end col -->
    </div> <!-- end row -->



</div> <!-- container-fluid -->
@endsection    
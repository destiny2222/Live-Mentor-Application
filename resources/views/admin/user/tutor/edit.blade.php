@extends('layouts.master-2')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Edit Tutor</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tutors</a></li>
                        <li class="breadcrumb-item active">Edit Tutor</li>
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
                    <h4 class="card-title">Tutor Details</h4>
                </div>
                <div class="card-body">
                    <!-- Display details as plain text -->
                    <div class="mb-3">
                        <label class="form-label"><strong>Title:</strong></label>
                        <p>{{ $tutor->title }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Experience:</strong></label>
                        <p>{{ $tutor->experience }} years</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Price:</strong></label>
                        <p>&#8358;{{ number_format($tutor->price, 2) }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Language:</strong></label>
                        <p>{{ $tutor->language }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Skills:</strong></label>
                        @foreach ($tutor->skill as $skills)
                         <span class="badge bg-primary">{{ $skills }}</span>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Categories:</strong></label>
                        @foreach ($tutor->categories as $category)
                            <span class="badge bg-primary">{{ $category->name }}</span>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Description:</strong></label>
                        <p>{{ $tutor->description }}</p>
                    </div>

                    <!-- Only status in input field -->
                    <form action="{{ route('admin.tutor.update', $tutor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" id="status">Select</label>
                            <select name="status" class="form-control" id="status" class="form-select">
                                <option value="1" {{ $tutor->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $tutor->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div> <!-- container-fluid -->
@endsection

@extends('layouts.master-2')
@section('content')
<div class="container-fluid">
    @php
    use Carbon\Carbon;
@endphp

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Edit Mentor</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Mentors</a></li>
                        <li class="breadcrumb-item active">Edit Mentor</li>
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
                    <h4 class="card-title">Mentor Details</h4>
                </div>
                <div class="card-body">
                    <!-- Display details as plain text -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"><strong>Title:</strong></label>
                                <p>{{ $mentor->title }}</p>
                            </div>
        
                            <div class="mb-3">
                                <label class="form-label"><strong>Experience:</strong></label>
                                <p>{{ $mentor->experience }} years</p>
                            </div>
        
                            <div class="mb-3">
                                <label class="form-label"><strong>Price:</strong></label>
                                <p>&#8358;{{ number_format($mentor->price, 2) }}</p>
                            </div>
        
                            <div class="mb-3">
                                <label class="form-label"><strong>Language:</strong></label>
                                <p>{{ $mentor->language }}</p>
                            </div>
        
                            <div class="mb-3">
                                <label class="form-label"><strong>Skills:</strong></label>
                                @if($mentor->Skills)
                                    @foreach ($mentor->Skills as $skill)
                                        <span class="badge bg-primary">{{ $skill }}</span>
                                    @endforeach
                                @else
                                    <span>No skills listed</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><strong>Categories:</strong></label>
                                @foreach ($tutor->categories as $category)
                                    <span class="badge bg-primary">{{ $category->name }}</span>
                                @endforeach
                            </div>
        
                            <div class="mb-3">
                                <label class="form-label"><strong>Description:</strong></label>
                                <p>{{ $mentor->about }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h3 class="text-info">Experience</h3>
                            <div class="mb-3">
                                @foreach($mentor->user->experiences as $experience)
                                    <div>
                                        <h4>{{ $experience->title }}</h4>
                                        <p><strong>Company:</strong> {{ $experience->company }}</p>
                                        <p><strong>Start Date:</strong> {{ Carbon::parse($experience->start_date)->format('F j, Y') }}</p>
                                        <p><strong>End Date:</strong> {{ Carbon::parse($experience->end_date)->format('F j, Y') }}</p>
                                        <p><strong>Description:</strong> {{ $experience->description }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>                        
                    </div>
                    
                    <!-- Only status in input field -->
                    <form action="{{ route('admin.mentor.update', $mentor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" id="status">Select</label>
                            <select name="is_approved" class="form-control" id="status" class="form-select">
                                <option value="1" {{ $mentor->is_approved == 1 ? 'selected' : '' }}>Approve</option>
                                <option value="0" {{ $mentor->is_approved == 0 ? 'selected' : '' }}>Decline</option>
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

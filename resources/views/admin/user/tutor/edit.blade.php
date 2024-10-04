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
        <div class="col-12 col-xl-6">
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
                        <label for="form-label"><strong>Availability</strong></label>
                        @if ($tutor->availability)
                            @foreach ($tutor->availability as $day => $times)
                                <div>
                                    <strong>{{ ucfirst($day) }}:</strong>
                                    @if (is_array($times) && count($times) > 0)
                                        @foreach ($times as $time)
                                            @php
                                                // Check if the time is in "HH:MM-HH:MM" format
                                                if (strpos($time, '-') !== false) {
                                                    list($start, $end) = explode('-', $time);
                                                    if (isset($start) && isset($end)) {
                                                        $startFormatted = date('g:i A', strtotime($start));
                                                        $endFormatted = date('g:i A', strtotime($end));
                                                        echo '<span class="badge bg-primary">' . htmlspecialchars("$startFormatted - $endFormatted", ENT_QUOTES, 'UTF-8') . '</span>';
                                                    }
                                                } elseif (preg_match('/^\d{1,2}:\d{2}$/', $time)) {
                                                    // Check if the time is in "HH:MM" format
                                                    $timeFormatted = date('g:i A', strtotime($time));
                                                    echo '<span class="badge bg-primary">' . htmlspecialchars($timeFormatted, ENT_QUOTES, 'UTF-8') . '</span>';
                                                }
                                            @endphp
                                        @endforeach
                                    @else
                                        <span>No availability</span>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <span>No availability</span>
                        @endif
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
                            <select name="is_approved" class="form-control" id="status" class="form-select">
                                <option value="1" {{ $tutor->is_approved == 1 ? 'selected' : '' }}>Approved</option>
                                <option value="0" {{ $tutor->is_approved == 0 ? 'selected' : '' }}>Decline</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Experience</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        @foreach($tutor->user->experiences as $experience)
                            <div>
                                <h4>{{ $experience->title }}</h4>
                                <p><strong>Company:</strong> {{ $experience->company }}</p>
                                <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($experience->start_date)->format('F j, Y') }}</p>
                                <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($experience->end_date)->format('F j, Y') }}</p>
                                <p><strong>Description:</strong> {{ $experience->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->
</div> <!-- container-fluid -->
@endsection

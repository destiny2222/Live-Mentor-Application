@extends('layouts.master-2')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Group Session</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Group Session</a></li>
                        <li class="breadcrumb-item active">Group Session</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <h4>Group Title: {{ $group->title }}</h4>
                        <p>Description: {{ $group->description }}</p>
                        <p>Start Time: {{ $group->start_time }}</p>
                        <p>End Time: {{ $group->end_time }}</p>
                        <h4>Additional Details</h4>
                        <p>Status: {{ $group->status }}</p>
                        <p>Topic Expertise: {{ $group->topic_expertise }}</p>
                        <p>Interest Areas:</p> 
                        @php
                            $interest_areas = is_array($group->interest_areas) ? $group->interest_areas : json_decode($group->interest_areas, true);
                        @endphp

                        @foreach($interest_areas as $interest_area)
                            <span class="badge bg-primary">{{ $interest_area }}</span>
                        @endforeach

                        <h5>Session Type</h5>
                        @if ($group->is_paid == '1')
                            <p class="badge bg-success">Paid</p>
                        @else
                            <p class="badge bg-info">Free</p>
                        @endif

                        <h5>Price</h5>
                        @if ($group->is_paid == '1')
                        <p>&#8358;{{ number_format($group->price, 2) }}</p>
                        @else
                        <p>Free</p>
                        @endif

                        <div class="mt-4 mb-4">
                            <form action="{{ route('admin.group.session.update', $group->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="is_approved" class="form-control mb-4">
                                    <option value="0" {{ $group->is_approved == 0 ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ $group->is_approved == 1 ? 'selected' : '' }}>Approved</option>
                                    <option value="2" {{ $group->is_approved == 2 ? 'selected' : '' }}>Rejected</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                
                    <div class="col-12 col-xl-6">
                    
                        @if($group->image)
                            <img src="{{ $group->image }}" alt="Group Image" class="img-fluid" style="max-width: 100%;">
                        @else
                            <p>No image available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>    


</div>

@endsection
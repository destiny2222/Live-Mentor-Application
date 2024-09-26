@extends('layouts.master')
@section('content')


<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Proposal Details</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Proposal Details</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->
<!-- ROW-1 OPEN -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row row-sm">
                    <div class="details col-xl-12 col-lg-12 col-md-12 mt-4 mt-xl-0">
                        <div class="mt-2 mb-4">
                            <h3 class="mb-3 fw-semibold">{{ $proposal->course->title }}</h3>
                            
                            <p>
                                {{ $proposal->course->description }}
                            </p>
                            <div class=" mt-4 mb-5"><span class="fw-bold me-2">Start Time :</span><span class="fw-bold text-primary">{{ \Carbon\Carbon::parse($proposal->time)->format('H:i A') }} </span><div>
                            <div class=" mt-4 mb-5"><span class="fw-bold me-2">End Time:</span><span class="fw-bold text-primary">{{ \Carbon\Carbon::parse($proposal->end_time)->format('H:i A') }} </span><div>
                            <div class=" mt-4 mb-5"><span class="fw-bold me-2">Published :</span><span class="fw-bold text-primary"> {{ $proposal->created_at->format('d M, Y') }} </span><div>
                            <div class=" mt-4 mb-5"><span class="fw-bold me-2">User :</span class="me-2 fw-bold fs-25 d-inline-flex"> {{ $proposal->user->name }} </div>
                            <div class="colors d-flex me-3 mt-4 mb-5">
                                <span class="mt-2 fw-bold">Days:</span>
                                <div class="row gutters-xs ms-4">
                                    @foreach($proposal->day as $day)
                                    <div class="col-3">
                                        <span class="badge bg-primary-gradient badge-sm">{{ $day }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="btn-list mt-4">
                                <!-- Respond Button -->
                                @if ($proposal->status == 0)   
                                <button class="btn ripple btn-primary me-2" onclick="event.preventDefault(); document.getElementById('accept-{{ $proposal->id }}').submit();">Respond</button>
                                <button id="reject-button-{{ $proposal->id }}" onclick="showRejectForm({{ $proposal->id }})" class="btn ripple btn-danger me-2">Reject</button>
                               @else
                              @if ($proposal->status == '2')
                                  <button href="javascript:void(0)" class="btn ripple btn-primary me-2">This session was canceled by you</button>
                                  <button id="delete-{{ $proposal->id }}" onclick="event.preventDefault() document.getElementById('delete-{{ $proposal->id }}').submit();" class="btn ripple btn-dnager me-2">Delete</button>
                                  @endif
                              @endif
                              <!-- delete -->
                              <form class="d-none" action="{{ route('tutor.request.delete', $proposal->id) }}" id="delete-{{ $proposal->id }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                              </form>
                              <!-- Accept Form -->
                              <form class="d-none" action="{{ route('tutor.request.accept', $proposal->id) }}" id="accept-{{ $proposal->id }}" method="POST">
                                  @csrf
                                  <input type="hidden" name="id" value="{{ $proposal->id }}">
                              </form>

                              <!-- Reject Form -->
                              <form class="d-none" action="{{ route('tutor.request.cancel', $proposal->id) }}" id="reject-{{ $proposal->id }}" method="POST">
                                  @csrf
                                  <input type="hidden" name="id" value="{{ $proposal->id }}">
                                  <h6 for="message" style="padding-top: 20px">Reason for decline</h6>
                                  <textarea name="message" id="message" cols="5" rows="5"></textarea>
                                  <button type="submit" class="btn ripple btn-primary me-2">Decline</button>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-md-12">
        <div class="card productdesc">
            <div class="card-body">
                <div class="panel panel-primary">
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab5">
                                <h4 class="mb-5 mt-3 fw-bold">Description</h4>
                                <p class="mb-3 fs-15">
                                    {{ $proposal->additional_information }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


       
@endsection
@push('scripts')
<script>
function showRejectForm(bookingId) {
    document.getElementById('reject-button-' + bookingId).style.display = 'none';
    document.getElementById('reject-' + bookingId).classList.remove('d-none');
    }
</script>
@endpush
    
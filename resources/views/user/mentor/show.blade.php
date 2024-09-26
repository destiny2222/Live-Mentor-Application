@extends('layouts.master')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Book Sessions</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Book Sessions</li>
        </ol>
    </div>

</div>
<!-- PAGE-HEADER END -->

<div class="row">
    <div class="row">
        @foreach($bookings as $booking)
        <div class="col-md-12  col-xl-6">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('profile/'.$booking->user->image) }}" class="card-img-left h-100" alt="img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $booking->user->name }}</h5>
                            <p class="card-text">{{ $booking->book_session }}</p>
                            <div class="d-flex  gap-3">
                                <p class="card-text"><span class=""><i class="fa fa-clock-o"></i> {{
                                        \Carbon\Carbon::parse($booking->book_session_time)->format('H:i A') }}</span>
                                </p>
                                <p class="card-text"><span class=""><i class="fa fa-calendar"></i> {{
                                        \Carbon\Carbon::parse($booking->book_session_date)->format('d M, Y') }}</span>
                                </p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Minutes</th>
                                        <th>Time/Zone</th>
                                        <th>Price</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $booking->minutes }}</td>
                                        <td>{{ $booking->book_session_time_zone }}</td>
                                        <td>{{ $booking->book_session_price }}</td>
                                    </tr>
                                </table>
                            </div>
                            @if($booking->book_session_payment_status == 0)
                            @if ($booking->status != 2)
                            @if ($booking->status == 0)
                            <a href="{{ route('accept.booking') }}"
                                onclick="event.preventDefault(); document.getElementById('accept-{{ $booking->id }}').submit();"
                                class="btn btn-primary">Accept</a>
                            @endif
                            <a href="javascript:void(0)" id="reject-button-{{ $booking->id }}"
                                onclick="showRejectForm({{ $booking->id }})" class="btn btn-primary">Reject</a>
                            @else
                            <a href="javascript:void(0)" class="text-danger">This session was canceled by
                                you</a>
                            <a href="{{ route('delete.booking', $booking->id ) }}"
                                onclick="event.preventDefault(); document.getElementById('delete-{{ $booking->id }}').submit();"
                                class="btn btn-danger">Delete</a>
                            @endif
                            @endif

                            <form class="d-none" action="{{ route('accept.booking', $booking->id) }}"
                                id="accept-{{ $booking->id }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $booking->id }}">
                            </form>
                            <form class="d-none" action="{{ route('delete.booking', $booking->id) }}"
                                id="delete-{{ $booking->id }}" method="POST">
                                @csrf
                                @method('delete')
                            </form>

                            <form id="reject-{{ $booking->id }}" class="d-none"
                                action="{{ route('reject.booking', $booking->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $booking->id }}">
                                <h6 for="message">Reason for decline</h6>
                                <textarea name="message"  id="message" cols="5" rows="5"></textarea>
                                <button type="submit" class="btn btn-danger text-thm">Decline</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
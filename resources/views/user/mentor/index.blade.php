@extends('layouts.master')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Sessions</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sessions</li>
        </ol>
    </div>

</div>
<!-- PAGE-HEADER END -->

<div class="row mb-4">
    <div class="col-lg-12">
        <div class="text-lg-start">
            <a href="{{ route('mentor.session') }}" class="btn btn-primary">Add Session<i class="fal fa-arrow-right-long"></i></a>
        </div>
    </div>
</div>

<div class="row">
    @foreach ($Applications as $Application)
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $Application->session_title }}</h5>
                    <h6 class="card-text mb-2"><strong>Time</strong>: <span>{{ $Application->session_time }}</span></h6>
                    <p class="card-text"><strong>Price</strong>: <span>&#x20A6;{{ $Application->session_price }}</span></p>
                    <a class="modal-effect btn btn-secondary-light card-link" data-bs-effect="effect-slide-in-right" data-bs-toggle="modal" href="#modaldemo8-{{ $Application->id }}">Edit</a>
                    <a href="{{ route('delete.session', $Application->id ) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $Application->id }}').submit();" class="modal-effect btn btn-danger-light card-link">Delete</a>
                    <form action="{{ route('delete.session', $Application->id ) }}" id="delete-form-{{ $Application->id }}" class="d-none" method="post">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </div>
        </div>
        @include('user.mentor.session_edit')
    @endforeach
</div>


    
@endsection

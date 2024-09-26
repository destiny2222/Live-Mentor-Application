@extends('layouts.master')
@section('content')

<div class="page-header">
    <h1 class="page-title">Courses</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Courses</li>
        </ol>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-12">
        <div class="text-lg-start">
            <a href="{{ route('course.index') }}" class="btn btn-primary wave-effect waves-light">Enroll Courses <i class="fal fa-arrow-right-long"></i></a>
        </div>
    </div>
</div>

@if ($user->role == 'user')
<div class="row">
    @forelse ($enrolledCourses as $course)
    <div class="col-xl-4 col-md-6 col-sm-12">
        <div class="card overflow-hidden">
            <img src="{{ asset('upload/courses/'.$course->image) }}" class="card-img-top" alt="img">
            <div class="card-body">
                <a class="" href="{{ route('course.details', $course->slug) }}">
                    <h5 class="card-title mb-4"> {{ $course->title }} </h5>
                </a>
                <p class="card-text mb-4">{{ $course->description }}</p>
            </div>
            <div class="card-footer">
                @if ($course->status == '1')
                <a class="d-flex " href="{{ route('pay') }}" onclick="event.preventDefault(); document.getElementById('pay-form-{{ $course->id }}').submit();">
                    <span class="badge bg-primary-gradient badge-sm  ">Make Payment</span>
                </a>
                <form action="{{ route('pay') }}" method="POST" id="pay-form-{{ $course->id }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <input type="hidden" name="name" value="{{ $user->name }}">
                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" name="price" value="{{ $course->price }}">
                </form>
                @elseif ($course->status == '2')
                 <span class="badge bg-danger-gradient badge-sm  ">Reject</span>
                @else
                 <span class="badge text-warning-gradient badge-sm">Pending</span>
                @endif
            </div> 
        </div>
    </div>
    @empty
    <div class="col-12 col-sm-12 col-xl-12">
        <div class="card overflow-hidden">
            <div class="card-body">
                <h5 class="card-title">Empty Course</h5>
            </div>
        </div>
    </div>
    @endforelse
</div>
<div class="row justify-content-center align-items-center pt-3 pb-3">
    <div class="col-12">
        {{ $proposals->links() }}
    </div>
</div>
@else
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-primary">No courses found</div>
    </div>
</div>
@endif

@endsection

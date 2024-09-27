@extends('layouts.master-2')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Course</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Course</a></li>
                        <li class="breadcrumb-item active">Course</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        @foreach ($groups as $group)
        <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="card overflow-hidden">
                <img src="{{ $group->image  }}" class="card-img-top" alt="img">
                <div class="card-body">
                    <h5 class="card-title">{{ $group->title }}</h5>
                    <p class="card-text">
                        {!! \Str::limit($group->description, 100) !!}
                    </p>
                    <div class="card-text text-muted">
                        <p>Created By: </p>
                        <div class="d-flex mb-4 align-items-center">
                            <img src="{{ asset('profile/'.$group->user->image) }}" width="100" height="100" class="avatar-sm rounded-circle me-2" alt="img">
                            <p class="mb-0">{{ $group->user->name }}</p>
                            @if ($group->user->role == 'tutor') 
                              <small>{{ $group->user->tutor->title ?? '' }}</small>
                            @elseif($group->user->role == 'mentor') 
                              <small>{{ $group->user->mentor->title ?? ''}}</small>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('admin.group.session.edit', $group->id) }}" class="btn btn-primary ">View</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>


@endsection
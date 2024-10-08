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
        @foreach ($course as $courses)
            <div class="col-12 col-lg-4">
                <div class="card">
                    <img src="{{ $courses->image }}" alt="{{ $courses->title }}" class="img-fluid" />
                    <div class="card-body">
                        <h4 class="card-title">{{ $courses->title }}</h4>
                        <p class="card-text">
                            {{ $courses->description }}
                        </p>
                        <p class="card-text">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </p>
                        <a href="{{ route('admin.course.edit', $courses->id ) }}" class="btn btn-primary waves-effect waves-light">Edit</a>
                        <a href="{{ route('admin.course.delete', $courses->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $courses->id }}').submit();" class="btn btn-primary waves-effect waves-light">Delete</a>
                        <form action="{{ route('admin.course.delete', $courses->id) }}" id="delete-form-{{ $courses->id }}" style="display: none;" method="post">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                </div>
            </div><!-- end col -->
        @endforeach
    </div>        
    <!-- end row -->

    
    
</div> <!-- container-fluid -->
@endsection
@extends('layouts.master')
<style>
    .pagination{
        justify-content: center;
    }
</style>
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Group Session</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Group Session</li>
        </ol>
    </div>

</div>
<!-- PAGE-HEADER END -->

<div class="row mb-4">
    <div class="col-lg-12">
        <a href="{{ route('cohort.create') }}" class="btn btn-primary">Create</a>
    </div>
</div>

<!-- ROW-5 OPEN -->
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
                    @if ($group->is_approved === 1)
                        <span class="badge bg-success">Approved</span>
                    @elseif($group->is_approved === 2)
                        <p class="badge bg-danger">Rejected</p>
                       
                    @else
                       <span class="badge bg-info">Not Approved</span>
                   @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row mb-4">
    <div class="col-12 text-center">
        @if ($groups->hasPages())
            {{ $groups->links() }}
        @endif
    </div>
</div>



@endsection
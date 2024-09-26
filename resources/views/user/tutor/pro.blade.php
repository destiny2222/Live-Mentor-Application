@extends('layouts.master')
@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Proposal</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Proposal</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->
    <div class="row">
        @foreach ($proposal as $proposals)
        <div class="col-md-12  col-xl-6">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('profile/'.$proposals->user->image) }}" class="card-img-left h-100" alt="img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $proposals->user->name }}</h5>
                            <p class="card-text">{{ $proposals->additional_information }}</p>
                            <p class="card-text"><small class="text-muted">{{ $proposals->created_at->format('d M, Y')}}</small></p>
                            <div class="pt-4">
                                <a href="{{ route('proposal.details',$proposals->id) }}" class="btn btn-primary">View Proposal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

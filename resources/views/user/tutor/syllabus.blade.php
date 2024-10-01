@extends('layouts.master')
@section('content')
<style>
    .description-container {
        position: relative;
    }
    .show-more-link {
        color: #007bff;
        cursor: pointer;
        display: inline-block;
        margin-top: 5px;
    }
</style>
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Syllabus</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Syllabus</li>
        </ol>
    </div>

</div>
<!-- PAGE-HEADER END -->

<div class="row mb-4">
    <div class="col-xl-12">
        <a href="#modaldemo8" class="modal-effect btn btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal">Add Syllabus</a>
    </div>
</div>

<div class="row">
    @foreach ($syllabus as $syllabu)
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">{{ $syllabu->course->title }}</div>
            </div>
            <div class="card-body">
                <a href="javascript:void(0)" class="card-link"><strong class="text-black">Duration</strong> {{ $syllabu->duration }}</a>
                <a href="javascript:void(0)" class="card-link"><strong class="text-black">Price</strong> &#8358;{{ $syllabu->price }}</a>
                
                <div class="description-container">
                    <p class="description-text" data-full-text="{!! $syllabu->description !!}">
                        {!! \Illuminate\Support\Str::limit($syllabu->description, 100, '...') !!}
                    </p>
                    <a href="javascript:void(0)" class="show-more-link mb-3">Show More</a>
                </div>

                <a href="#modaldemo9-{{ $syllabu->id }}" class="modal-effect btn btn-primary-light" data-bs-effect="effect-scale" data-bs-toggle="modal">Edit</a>
                <a href="{{ route('syllabus.delete', $syllabu->id) }}" class="modal-effect btn btn-primary-light" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $syllabu->id }}').submit();" data-bs-effect="effect-scale" data-bs-toggle="modal">Delete</a>
                <form action="{{ route('syllabus.delete', $syllabu->id) }}" id="delete-form-{{ $syllabu->id }}" style="display: none;" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const containers = document.querySelectorAll('.description-container');
        
        containers.forEach(container => {
            const textElement = container.querySelector('.description-text');
            const link = container.querySelector('.show-more-link');
            const fullText = textElement.getAttribute('data-full-text');
            const shortText = textElement.innerHTML;
    
            link.addEventListener('click', function() {
                if (link.textContent === 'Show More') {
                    textElement.innerHTML = fullText;
                    link.textContent = 'Show Less';
                } else {
                    textElement.innerHTML = shortText;
                    link.textContent = 'Show More';
                }
            });
        });
    });
    </script>
@endpush

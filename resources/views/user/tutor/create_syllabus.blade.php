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

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Upload Syllabus</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('syllabus.store') }}" id="syllabusForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-form">Course</label>
                                <select name="course_id" class="form-control select2">
                                    <option value="">Select</option>
                                    @foreach ($tutorCourses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                @error('course_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-form">Price</label>
                                <input type="text" class="form-control" name="price" value="{{ old('price') }}" placeholder="Enter Price">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-form">Duration</label>
                                <input type="text" class="form-control" name="duration" value="{{ old('duration') }}" placeholder="Enter duration">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label-form">Syllabus Details</label>
                                <div id="syllabus-items">
                                    <div class="syllabus-item mb-3">
                                        <input type="text" class="form-control mb-2" name="syllabus[]" placeholder="Enter syllabus item">
                                        <button type="button" class="btn btn-danger btn-sm remove-syllabus">Remove</button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm mt-2" id="add-syllabus">Add Syllabus Item</button>
                                @error('syllabus') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-center">
                                <button class="btn btn-primary w-100" type="submit">Save<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const syllabusItems = document.getElementById('syllabus-items');
        const addSyllabusButton = document.getElementById('add-syllabus');
    
        addSyllabusButton.addEventListener('click', function() {
            const newItem = document.createElement('div');
            newItem.className = 'syllabus-item mb-3';
            newItem.innerHTML = `
                <input type="text" class="form-control mb-2" name="syllabus[]" placeholder="Enter syllabus item">
                <button type="button" class="btn btn-danger btn-sm remove-syllabus">Remove</button>
            `;
            syllabusItems.appendChild(newItem);
        });
    
        syllabusItems.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-syllabus')) {
                e.target.closest('.syllabus-item').remove();
            }
        });
    });
</script>
@endpush
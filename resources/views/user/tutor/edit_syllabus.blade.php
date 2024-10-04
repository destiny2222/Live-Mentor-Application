@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Edit </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('syllabus.edit', $syllabus->id) }}" id="syllabusEditForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-form">Course</label>
                                <select name="course_id" class="form-control select2">
                                    <option value="">Select</option>
                                    @foreach ($tutorCourses as $course)
                                    <option value="{{ $course->id }}" {{ $syllabus->course_id == $course->id ? 'selected' : '' }}>
                                        {{ $course->title }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('course_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-form">Price</label>
                                <input type="text" class="form-control" name="price" value="{{ old('price', $syllabus->price) }}" placeholder="Enter Price">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-form">Duration</label>
                                <input type="text" class="form-control" name="duration" value="{{ old('duration', $syllabus->duration) }}" placeholder="Enter duration">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label-form">Syllabus Details</label>
                                <div id="syllabus-items">
                                    @foreach(explode("\n", $syllabus->description) as $item)
                                    <div class="syllabus-item mb-3">
                                        <input type="text" class="form-control mb-2" name="syllabus[]" value="{{ $item }}" placeholder="Enter syllabus item">
                                        <button type="button" class="btn btn-danger btn-sm remove-syllabus">Remove</button>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-success btn-sm mt-2" id="add-syllabus">Add Syllabus Item</button>
                                @error('syllabus') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-center">
                                <button class="btn btn-primary w-100" type="submit">Update<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                
               
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
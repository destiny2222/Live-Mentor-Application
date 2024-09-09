@extends('layouts.master')
@section('content')
<div class="dashboard__main pl0-md">
    <div class="dashboard__content hover-bgc-color">
        <div class="row">
            <div class="col-xl-12">
                <!-- resources/views/livewire/syllabus.blade.php -->
                <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                    <div class="bdrb1 pb15 mb25">
                        <h5 class="list-title">Upload Syllabus</h5>
                    </div>
                    <div class="col-xl-12">
                        <form class="form-style1" action="{{ route('syllabus.store') }}" id="syllabusForm" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-style1">
                                        <label class="heading-color ff-heading fw500 mb10">Category</label>
                                        <div class="bootselect-multiselect">
                                            <select name="category_id" class="selectpicker">
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category_id') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="tutor_id">
                                <div class="col-md-12">
                                    <div class="mb10">
                                        <label class="heading-color ff-heading fw500 mb10">Syllabus Detail</label>
                                        <textarea cols="30" rows="6" name="description" id="content" placeholder="Description"></textarea>
                                        @error('description') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button class="ud-btn btn-thm w-100" type="submit">Save<i class="fal fa-arrow-right-long"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

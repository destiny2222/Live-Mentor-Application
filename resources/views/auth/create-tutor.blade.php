@extends('layouts.master')
@section('content')
<div class="dashboard__main pl0-md">
    <div class="dashboard__content hover-bgc-color">
        <div class="row">
            <div class="col-xl-12">
                {{-- --}}
                <div id="psWidget" class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                    <div class="bdrb1 pb15 mb25">
                        <h5 class="list-title">Basic Information</h5>
                    </div>
                    <div class="col-xl-12">
                        <form class="form-style1" method="POST" action="{{ route('tutor.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb20">
                                    <label class="heading-color ff-heading fw500 mb10">Service Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="i will">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb20">
                                        <div class="form-style1">
                                            <label class="heading-color ff-heading fw500 mb10">Service Category</label>
                                            <div class="bootselect-multiselect">
                                                <select name="category_id[]" class="selectpicker" multiple>
                                                    {{-- <option >Select</option> --}}
                                                    @foreach ($category as $categories)
                                                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Price</label>
                                        <input type="text" class="form-control" name="price" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb20">
                                        <div class="form-style1">
                                            <label class="heading-color ff-heading fw500 mb10">English Level</label>
                                            <div class="bootselect-multiselect">
                                                <select class="selectpicker" name="language">
                                                    <option>Select</option>
                                                    <option>Fluent</option>
                                                    <option>Mid Level</option>
                                                    <option>Conversational</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb20">
                                        <div class="form-style1">
                                            <label class="heading-color ff-heading fw500 mb10">Skills</label>
                                            <div class="bootselect-multiselect">
                                                <select class="selectpicker" name="skill[]" multiple>
                                                    <option>Figma</option>
                                                    <option>Adobe XD</option>
                                                    <option>CSS</option>
                                                    <option>HTML</option>
                                                    <option>Bootstrap</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-xl-3">
                                    <label for="">Upload resume/cv</label>
                                    {{-- <img src="{{ asset('images/gallery/g-1.png') }}" alt="" id="resume"> --}}
                                    <input  type="file"  name="resume" id="resume" >
                                </div>
                                <div class="col-md-12">
                                    <div class="mb10">
                                        <label class="heading-color ff-heading fw500 mb10">Services Detail</label>
                                        <textarea cols="30" rows="6" name="description" placeholder="Description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button class="ud-btn btn-thm w-100" type="submit">Save<i
                                                class="fal fa-arrow-right-long"></i></button>
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
<!-- /. hide ps-widget when form is submitted -->
<script>
    $(document).ready(function () {
        $('form').submit(function () {
            $('#psWidget').hide();
        });
    });
</script>
@endsection
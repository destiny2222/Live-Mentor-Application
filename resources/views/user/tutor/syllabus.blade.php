@extends('layouts.master')
@section('content')
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
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Upload Syllabus</h3>
            </div>
            <div class="card-body">
                <form  action="{{ route('syllabus.store') }}" id="syllabusForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-form">Category</label>
                                <select name="category_id" class="form-control select2">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <input type="hidden" name="tutor_id">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label-form">Syllabus Detail</label>
                                <textarea cols="50" rows="50" name="description" class="form-control" id="content" placeholder="Description"></textarea>
                                @error('description') <span class="error">{{ $message }}</span> @enderror
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

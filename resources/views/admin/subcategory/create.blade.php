@extends('layouts.master-2')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Create SubCategory</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">SubCategory</a></li>
                        <li class="breadcrumb-item active">Create SubCategory</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 ">
                            <form action="{{ route('admin.subcategory.store') }}" method="POST">
                                @csrf
                                <div>
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Name</label>
                                        <input class="form-control" name="name" type="text" id="example-text-input">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Parent Category</label>
                                        <select class="form-control" name="category_id" id="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($category as $categories)
                                                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-search-input" class="form-label">Image (Icon)</label>
                                        <input class="form-control" name='image' type="text" id="example-search-input">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-color-input" class="form-label">Color picker</label>
                                        <input type="color" class="form-control form-control-color mw-100" id="example-color-input" name="color" value="#5156be" title="Choose your color">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" value="Create SubCategory" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

</div> <!-- container-fluid -->
@endsection

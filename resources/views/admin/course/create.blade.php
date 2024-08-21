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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Course</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.course.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Title</label>
                                        <input class="form-control" name="title" type="text"  id="example-text-input">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-search-input" class="form-label">Author</label>
                                        <input class="form-control" type="search"  id="example-search-input">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-email-input" class="form-label">Price</label>
                                        <input class="form-control" type="text" name="price"  id="example-email-input">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" cols="30" class="form-control" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-lg-6">
                                <div class="mt-3 mb-3 mt-lg-0">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1" >Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" id="image" name="image">
                                    @if($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

</div> 
@endsection
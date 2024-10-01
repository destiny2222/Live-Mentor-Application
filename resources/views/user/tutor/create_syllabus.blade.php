    <!-- MODAL EFFECTS -->
    <div class="modal fade" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Upload Syllabus</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form  action="{{ route('syllabus.store') }}" id="syllabusForm" method="POST">
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
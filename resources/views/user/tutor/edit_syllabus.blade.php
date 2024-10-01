<div class="modal fade" id="modaldemo9-{{ $syllabu->id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Upload Syllabus</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('syllabus.edit', $syllabu->id) }}" id="syllabusForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-form">Course</label>
                                <select name="course_id" class="form-control select2">
                                    <option value="">Select</option>
                                    @foreach ($tutorCourses as $course)
                                        <option value="{{ $course->id }}" {{ $course->course_id == $course->id ? 'selected' : ''}}>{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                @error('course_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-form">Price</label>
                                <input type="text" class="form-control" name="price" value="{{ $syllabu->price ?? old('price') }}" placeholder="Enter Price">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="label-form">Duration</label>
                                <input type="text" class="form-control" name="duration" value="{{ $syllabu->duration ?? old('duration') }}" placeholder="Enter duration">
                                @error('duration') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="label-form">Syllabus Detail</label>
                                <textarea cols="50" rows="50" name="description" class="form-control" id="body" placeholder="Description">{{ $syllabu->description ?? old('description') }}</textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
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
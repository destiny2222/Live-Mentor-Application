@extends('layouts.master')
@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Sessions</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sessions</li>
        </ol>
    </div>

</div>
<!-- PAGE-HEADER END -->


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">More Information</h2>
            </div>
            <div class="card-body">
                <form  action="{{ route('mentor.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label class="form-label">Service Title</label>
                            <input type="text" class="form-control" name="title" required placeholder="i will">
                        </div>
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label class="form-label">Categories</label>
                                <select name="categories[]" multiple class="form-control select2" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12 mb-4">
                            <div class="form-group">
                                <label for="">Years of experience</label>
                                <input type="text" class="form-control" placeholder="" name="experience">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-4">
                            <div class="form-group">
                                <label class="form-label">Skills</label>
                                <input type="text" class="form-control" multiple name="skills[]" placeholder="Enter a skill" required />
                                <!-- Add a button to dynamically add more skills -->
                                <button type="button" class="btn btn-primary mt-2 mb-2" id="add-skill">Add More Skill</button>
                            </div>
                        </div>
                        
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label class="form-label">About </label>
                                <textarea cols="30" rows="6" name="about" class="form-control" required placeholder="Description"></textarea>
                            </div>
                        </div>
                        <h4 class="mb10 mt20">Experiences</h4>
                        <div class="col-sm-12 mb-4">
                            <div id="experience-fields">
                                <div class="experience-group">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control mb-4" name="experiences[0][title]" placeholder="Title" required />
                                    <label class="form-label">Company</label>
                                    <input type="text" class="form-control mb-4" name="experiences[0][company]" placeholder="Company" required />
                                    <label class="form-label">Start Date</label>
                                    <input type="date" class="form-control mb-4" name="experiences[0][start_date]" placeholder="Start Date" required />
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control mb-4" name="experiences[0][end_date]" placeholder="End Date" required />
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control mb-4" rows="10" cols="10" name="experiences[0][description]" placeholder="Description" required></textarea>
                                </div>
                                <!-- Add a button to dynamically add more experiences -->
                                <button type="button" class="btn btn-primary mt-4 mb-4 btn-sm" id="add-experience">Add More Experience</button>
                            </div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <h4 class="">Education</h4>
                            <div id="education-fields">
                                <div class="education-group">
                                    <label class="form-label">School</label>
                                    <input type="text" class="form-control mb-4" name="education[0][school]" placeholder="School" required />
                                    <label class="form-label">Degree</label>
                                    <input type="text" class="form-control mb-4" name="education[0][degree]" placeholder="Degree" required />
                                    <label class="form-label">Field of Study</label>
                                    <input type="text" class="form-control mb-4" name="education[0][field_of_study]" placeholder="Field of Study" required />
                                    <label class="form-label">Start Date</label>
                                    <input type="date" class="form-control mb-4" name="education[0][start_date]" placeholder="Start Date" required />
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control mb-4" name="education[0][end_date]" placeholder="End Date" required />
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control mb-4 " rows="10" cols="10" name="education[0][description]" placeholder="Description" required></textarea>
                                </div>
                                <!-- Add a button to dynamically add more education entries -->
                                <button type="button" class="btn btn-primary mt-4 mb-4   btn-sm" id="add-education">Add More Education</button>
                            </div>
                        </div>
                        

                        <div class="col-md-12">
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary w-100">Save<i class="fal fa-arrow-right-long"></i></button>
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
    let experienceCount = 1;
    document.getElementById('add-experience').addEventListener('click', function() {
        const experienceFields = `
            <div class="experience-group">
                <input type="text" class="form-control mb-4 mt-4" name="experiences[${experienceCount}][title]" placeholder="Title" required />
                <input type="text" class="form-control mb-4 mt-4" name="experiences[${experienceCount}][company]" placeholder="Company" required />
                <input type="date" class="form-control mb-4 mt-4" name="experiences[${experienceCount}][start_date]" placeholder="Start Date" required />
                <input type="date" class="form-control mb-4 mt-4" name="experiences[${experienceCount}][end_date]" placeholder="End Date" required />
                <textarea class="form-control mb-4" rows="10" cols="10" name="experiences[${experienceCount}][description]" placeholder="Description" required></textarea>
            </div>
        `;
        // Insert the new experience fields before the button
        document.getElementById('add-experience').insertAdjacentHTML('beforebegin', experienceFields);
        experienceCount++;
    });
</script>
<script>
    let educationCount = 1;
    document.getElementById('add-education').addEventListener('click', function() {
        const educationFields = `
            <div class="education-group">
                <input type="text" class="form-control mb-4 mt-4" name="education[${educationCount}][school]" placeholder="School" required />
                <input type="text" class="form-control mb-4 mt-4" name="education[${educationCount}][degree]" placeholder="Degree" required />
                <input type="text" class="form-control mb-4 mt-4" name="education[${educationCount}][field_of_study]" placeholder="Field of Study" required />
                <input type="date" class="form-control mb-4 mt-4" name="education[${educationCount}][start_date]" placeholder="Start Date" required />
                <input type="date" class="form-control mb-4 mt-4" name="education[${educationCount}][end_date]" placeholder="End Date" required />
                <textarea class="form-control mb-4" rows="10" cols="10" name="education[${educationCount}][description]" placeholder="Description" required></textarea>
            </div>
        `;
        document.getElementById('add-education').insertAdjacentHTML('beforebegin', educationFields);
        educationCount++;
    });
</script>
<script>
    document.getElementById('add-skill').addEventListener('click', function() {
    const skillFields = `
        <div class="skill-group">
            <input type="text" class="form-control mb-4 mt-4" name="skills[]" placeholder="Enter a skill" required />
        </div>
    `;
    document.getElementById('add-skill').insertAdjacentHTML('beforebegin', skillFields);
});

</script>
@endpush

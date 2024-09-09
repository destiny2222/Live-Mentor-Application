@extends('layouts.master')

@section('content')
<div class="dashboard__main pl0-md">
    <div class="dashboard__content hover-bgc-color">
        <!-- Your existing content here -->

        <div class="row pb40">
            <div class="col-lg-12">
                <div class="dashboard_navigationbar d-block d-lg-none">
                    <div class="dropdown">
                        @include('layouts.navbar')
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb20">
                <div class="dashboard_title_area">
                  <h2>More Information</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                    <div class="col-xl-12">
                        <form class="form-style1" action="{{ route('mentor.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Service Title</label>
                                        <input type="text" class="form-control" name="title" required placeholder="i will">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <div class="form-style1">
                                            <label class="heading-color ff-heading fw500 mb10">Category</label>
                                            <div class="bootselect-multiselect">
                                                <div class="dropdown bootstrap-select">
                                                    <select name="category_id" class="selectpicker" required >
                                                        <option>Select</option>
                                                        @foreach ($category as $categories)
                                                            <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                                        @endforeach
                                                    </select>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Skills</label>
                                        <div id="skills-fields">
                                            <div class="skill-group">
                                                <input type="text" class="form-control mb10" name="skills[]" placeholder="Enter a skill" required />
                                            </div>
                                        </div>
                                        <!-- Add a button to dynamically add more skills -->
                                        <button type="button" class="mb20 mt20 ud-btn btn-dark" id="add-skill">Add More Skill</button>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-12">
                                    <div class="mb10">
                                        <label class="heading-color ff-heading fw500 mb10">About </label>
                                        <textarea cols="30" rows="6" name="about" required placeholder="Description"></textarea>
                                    </div>
                                </div>
                                <h4 class="mb10 mt20">Experiences</h4>
                                <div class="col-sm-12">
                                    <div id="experience-fields">
                                        <div class="experience-group">
                                            <label class="heading-color ff-heading fw500 mb10">Title</label>
                                            <input type="text" class="form-control mb50" name="experiences[0][title]" placeholder="Title" required />
                                            <label class="heading-color ff-heading fw500 mb10">Company</label>
                                            <input type="text" class="form-control mb50" name="experiences[0][company]" placeholder="Company" required />
                                            <label class="heading-color ff-heading fw500 mb10">Start Date</label>
                                            <input type="date" class="form-control mb50" name="experiences[0][start_date]" placeholder="Start Date" required />
                                            <label class="heading-color ff-heading fw500 mb10">End Date</label>
                                            <input type="date" class="form-control mb50" name="experiences[0][end_date]" placeholder="End Date" required />
                                            <label class="heading-color ff-heading fw500 mb10">Description</label>
                                            <textarea name="experiences[0][description]" placeholder="Description" required></textarea>
                                        </div>
                                        <!-- Add a button to dynamically add more experiences -->
                                        <button type="button" class="mb20 mt20 ud-btn btn-dark btn-sm" id="add-experience">Add More Experience</button>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <h4 class="mb10 mt20">Education</h4>
                                    <div id="education-fields">
                                        <div class="education-group">
                                            <label class="heading-color ff-heading fw500 mb10">School</label>
                                            <input type="text" class="form-control mb50" name="education[0][school]" placeholder="School" required />
                                            <label class="heading-color ff-heading fw500 mb10">Degree</label>
                                            <input type="text" class="form-control mb50" name="education[0][degree]" placeholder="Degree" required />
                                            <label class="heading-color ff-heading fw500 mb10">Field of Study</label>
                                            <input type="text" class="form-control mb50" name="education[0][field_of_study]" placeholder="Field of Study" required />
                                            <label class="heading-color ff-heading fw500 mb10">Start Date</label>
                                            <input type="date" class="form-control mb50" name="education[0][start_date]" placeholder="Start Date" required />
                                            <label class="heading-color ff-heading fw500 mb10">End Date</label>
                                            <input type="date" class="form-control mb50" name="education[0][end_date]" placeholder="End Date" required />
                                            <label class="heading-color ff-heading fw500 mb10">Description</label>
                                            <textarea class="form-control mb50" name="education[0][description]" placeholder="Description" required></textarea>
                                        </div>
                                        <!-- Add a button to dynamically add more education entries -->
                                        <button type="button" class="mb20 mt20 ud-btn btn-dark btn-sm" id="add-education">Add More Education</button>
                                    </div>
                                </div>
                                

                                <div class="col-md-12">
                                    <div class="text-start">
                                        <button type="submit" class="ud-btn btn-thm w-100">Save<i class="fal fa-arrow-right-long"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Your footer here -->
</div>
@endsection

@push('scripts')
<script>
    let experienceCount = 1;
    document.getElementById('add-experience').addEventListener('click', function() {
        const experienceFields = `
            <div class="experience-group">
                <input type="text" class="form-control mb50" name="experiences[${experienceCount}][title]" placeholder="Title" required />
                <input type="text" class="form-control mb50" name="experiences[${experienceCount}][company]" placeholder="Company" required />
                <input type="date" class="form-control mb50" name="experiences[${experienceCount}][start_date]" placeholder="Start Date" required />
                <input type="date" class="form-control mb50" name="experiences[${experienceCount}][end_date]" placeholder="End Date" required />
                <textarea class="form-control mb50" name="experiences[${experienceCount}][description]" placeholder="Description" required></textarea>
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
                <input type="text" class="form-control mb50" name="education[${educationCount}][school]" placeholder="School" required />
                <input type="text" class="form-control mb50" name="education[${educationCount}][degree]" placeholder="Degree" required />
                <input type="text" class="form-control mb50" name="education[${educationCount}][field_of_study]" placeholder="Field of Study" required />
                <input type="date" class="form-control mb50" name="education[${educationCount}][start_date]" placeholder="Start Date" required />
                <input type="date" class="form-control mb50" name="education[${educationCount}][end_date]" placeholder="End Date" required />
                <textarea class="form-control mb50" name="education[${educationCount}][description]" placeholder="Description" required></textarea>
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
            <input type="text" class="form-control mb10" name="skills[]" placeholder="Enter a skill" required />
        </div>
    `;
    document.getElementById('add-skill').insertAdjacentHTML('beforebegin', skillFields);
});

</script>
@endpush

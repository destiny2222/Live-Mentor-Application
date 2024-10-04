@extends('layouts.master')
@section('content')
<style>
    .step {
    display: none;
}
.step.active {
    display: block;
}

    .w25{
        width: 25% !important;
    } 

    .w40{
        width: 40% !important;
    }

    .custom-file-upload {
    border: 2px dashed #ccc;
    display: inline-block;
    padding: 20px;
    cursor: pointer;
    box-shadow: 0px 2px 5px rgba(0,0,0,.1);
    text-align: center;
    font-family: Arial, sans-serif;
    color: #333;
}
.custom-file-upload i {
    margin-right: 10px;
    font-size: 24px;
    color: #007bff;
}

</style>
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Tutor Registration Form</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Complete your profile</li>
        </ol>
    </div>

</div>
<!-- PAGE-HEADER END -->

<div class="row">
    <div class="col-xl-12">
        <form class="form-style1" method="POST" action="{{ route('tutor.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <!-- Step 1: Basic Information -->
                    <div class="step step-1 active">
                        <h5 class="card-title">Basic Information</h5>
                        <div class="row">
                            <div class="col-sm-12 py-4">
                                <label for="resume">Resume</label>
                                <input type="file" class="dropify" name="resume" data-bs-height="180">
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Service Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="I will" >
                                </div>
                            </div>
                            <div class="col-12 col-lg-12 mb-4">
                                <div class="form-group">
                                    <label for="">Years of experience</label>
                                    <input type="text" class="form-control" placeholder="" name="experience">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Service Category</label>
                                    <select name="category_id[]" class="form-control form-select select2" multiple >
                                        @foreach ($category as $categories)
                                            <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label for="skills" class="form-label">Skill</label>
                                    <input type="text" class="form-control" id="skills" name="skills[]" multiple size="50" placeholder="enter your skills">
                                </div>
                                <button type="button" class="btn btn-primary btn-sm mt-2 mb-2" id="add-skill">Add More Skill</button>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <label for="" class="form-label">Availability</label>
                                @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                    <div>
                                        <label class="form-label" for="{{ $day }}">{{ ucfirst($day) }}</label>
                                        <input type="checkbox" class="form-control mb-4" name="days[{{ $day }}][available]" id="{{ $day }}">
                                        <input type="time" class="form-control mb-4" name="days[{{ $day }}][start_time]">
                                        <input type="time" class="form-control mb-4" name="days[{{ $day }}][end_time]">
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-sm-12 text-center">
                                <button type="button" class="btn btn-primary w25 w40 next-step">Next</button>
                            </div>
                        </div>
                    </div>
                    <!-- Step 2: Service Details -->
                    <div class="step step-2">
                        <h5 class="step-title">Service Details</h5>
                        <div class="row">
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">English Level</label>
                                    <select class="form-control" name="language">
                                        <option>Select</option>
                                        <option>Fluent</option>
                                        <option>Mid Level</option>
                                        <option>Conversational</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Service Detail</label>
                                    <textarea class="form-control" name="description" rows="6" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button type="button" class="btn btn-primary w25 w40 prev-step">Previous</button>
                                <button type="button" class="btn btn-primary w25 w40 next-step">Next</button>
                            </div>
                        </div>
                    </div>
                    <!-- Step 3: Education Details -->
                    <div class="step step-3">
                        <h5 class="step-title">Education Details</h5>
                        <div class="row">
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">School</label>
                                    <input type="text" class="form-control" name="school" placeholder="School Name">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Degree</label>
                                    <input type="text" class="form-control" name="degree" placeholder="Degree">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Field of Study</label>
                                    <input type="text" class="form-control" name="field_of_study" placeholder="Field of Study">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" class="form-control" name="start_date">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="end_date">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="4" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button type="button" class="btn btn-primary w25 w40 prev-step">Previous</button>
                                <button type="button" class="btn btn-primary w25 w40 next-step">Next</button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Award Details -->
                    <div class="step step-4">
                        <h5 class="step-title">Certification Details</h5>
                        <div class="row">
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Award Title</label>
                                    <input type="text" class="form-control" name="award_title" placeholder="Award Title">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Company/Organization</label>
                                    <input type="text" class="form-control" name="company" placeholder="Company/Organization">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" name="date">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="date_end">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="4" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button type="button" class="btn btn-primary w25 w40 prev-step">Previous</button>
                                <button type="button" class="btn btn-primary w25 w40 next-step">Next</button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5: Experience Details -->
                    <div class="step step-5">
                        <h5 class="step-title">Experience Details</h5>
                        <div class="row">
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="experience_title" placeholder="Job Title">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Company</label>
                                    <input type="text" class="form-control" name="company" placeholder="Company Name">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" class="form-control" name="start_date">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="end_date">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="mb20">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="4" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button type="button" class="btn btn-primary w25 w40 prev-step">Previous</button>
                                <button type="submit" class="btn btn-primary w25 w40">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.step');
    const nextButtons = document.querySelectorAll('.next-step');
    const prevButtons = document.querySelectorAll('.prev-step');
    const form = document.querySelector('form');
    let currentStep = 0;

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            if (index === stepIndex) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });
    }

    nextButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });

    form.addEventListener('submit', function () {
        // Ensure hidden fields in other steps are enabled before submission
        steps.forEach(step => {
            step.querySelectorAll('input, select, textarea').forEach(field => {
                if (field.style.display === 'none') {
                    field.disabled = false;
                }
            });
        });
    });

    showStep(currentStep);
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
@extends('layouts.master')
@section('content')
<div class="dashboard__main pl0-md">
    <div class="dashboard__content hover-bgc-color">
        <div class="row">
            <div class="col-xl-12">
                <div id="psWidget" class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                    <div class="bdrb1 pb15 mb25">
                        <h5 class="list-title">Tutor Registration Form</h5>
                    </div>
                    <div class="col-xl-12">
                        <form class="form-style1" method="POST" action="{{ route('tutor.store') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Step 1: Basic Information -->
                            <div class="step step-1 active">
                                <h5 class="step-title">Basic Information</h5>
                                <div class="row">
                                    <div class="col-sm-12 py-4">
                                        <label for="resume">Resume</label>
                                        <input type="file" name="resume" class="" required id="resume">
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Service Title</label>
                                            <input type="text" class="form-control" name="title" placeholder="I will" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Service Category</label>
                                            <select name="category_id[]" class="selectpicker" multiple required>
                                                @foreach ($category as $categories)
                                                    <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label for="skills" class="heading-color ff-heading fw500 mb10">Skill</label>
                                            <input type="text" class="form-control" id="skills" name="skills[]" multiple size="50" placeholder="enter your skills" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Price</label>
                                            <input type="text" class="form-control" name="price" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-center">
                                        <button type="button" class="ud-btn btn-thm w-25 next-step">Next</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Service Details -->
                            <div class="step step-2">
                                <h5 class="step-title">Service Details</h5>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">English Level</label>
                                            <select class="selectpicker" name="language" required>
                                                <option>Select</option>
                                                <option>Fluent</option>
                                                <option>Mid Level</option>
                                                <option>Conversational</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Service Detail</label>
                                            <textarea class="form-control" name="description" rows="6" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-center">
                                        <button type="button" class="ud-btn btn-thm w-25 prev-step">Previous</button>
                                        <button type="button" class="ud-btn btn-thm w-25 next-step">Next</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Education Details -->
                            <div class="step step-3">
                                <h5 class="step-title">Education Details</h5>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">School</label>
                                            <input type="text" class="form-control" name="school" placeholder="School Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Degree</label>
                                            <input type="text" class="form-control" name="degree" placeholder="Degree">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Field of Study</label>
                                            <input type="text" class="form-control" name="field_of_study" placeholder="Field of Study">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Start Date</label>
                                            <input type="date" class="form-control" name="start_date">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">End Date</label>
                                            <input type="date" class="form-control" name="end_date">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Description</label>
                                            <textarea class="form-control" name="description" rows="4" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-center">
                                        <button type="button" class="ud-btn btn-thm w-25 prev-step">Previous</button>
                                        <button type="button" class="ud-btn btn-thm w-25 next-step">Next</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4: Award Details -->
                            <div class="step step-4">
                                <h5 class="step-title">Certification Details</h5>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Award Title</label>
                                            <input type="text" class="form-control" name="title" placeholder="Award Title">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Company/Organization</label>
                                            <input type="text" class="form-control" name="company" placeholder="Company/Organization">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Date</label>
                                            <input type="date" class="form-control" name="date">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">End Date</label>
                                            <input type="date" class="form-control" name="date_end">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Description</label>
                                            <textarea class="form-control" name="description" rows="4" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-center">
                                        <button type="button" class="ud-btn btn-thm w-25 prev-step">Previous</button>
                                        <button type="button" class="ud-btn btn-thm w-25 next-step">Next</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 5: Experience Details -->
                            <div class="step step-5">
                                <h5 class="step-title">Experience Details</h5>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Title</label>
                                            <input type="text" class="form-control" name="title" placeholder="Job Title">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Company</label>
                                            <input type="text" class="form-control" name="company" placeholder="Company Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Start Date</label>
                                            <input type="date" class="form-control" name="start_date">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">End Date</label>
                                            <input type="date" class="form-control" name="end_date">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw500 mb10">Description</label>
                                            <textarea class="form-control" name="description" rows="4" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-center">
                                        <button type="button" class="ud-btn btn-thm w-25 prev-step">Previous</button>
                                        <button type="submit" class="ud-btn btn-thm w-25">Submit</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const steps = document.querySelectorAll('.step');
        const nextButtons = document.querySelectorAll('.next-step');
        const prevButtons = document.querySelectorAll('.prev-step');
        let currentStep = 0;

        function showStep(stepIndex) {
            steps.forEach((step, index) => {
                step.style.display = index === stepIndex ? 'block' : 'none';
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

        showStep(currentStep);
    });
</script>
@endsection

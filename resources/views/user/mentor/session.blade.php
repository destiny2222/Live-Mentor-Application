@extends('layouts.master')
@section('content')
<div class="dashboard__main pl0-md">
    <div class="dashboard__content hover-bgc-color">
        <div class="row pb40">
            <div class="col-lg-12">
                <div class="dashboard_navigationbar d-block d-lg-none">
                    <div class="dropdown">
                        @include('layouts.navbar')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <!-- resources/views/livewire/syllabus.blade.php -->
                <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                    <div class="bdrb1 pb15 mb25">
                        <h5 class="list-title">Upload Session</h5>
                    </div>
                    <div class="col-xl-12">
                        <form class="form-style1" action="{{ route('mentor.session.store') }}" id="syllabusForm" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-style1">
                                        <label class="heading-color ff-heading fw500 mb10">Sessions Title</label>
                                        <input type="text" name="session_title" pleaceholder="" class="form-control @error('session_title') in-valid @enderror">
                                        @error('session_title') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-style1">
                                        <label class="heading-color ff-heading fw500 mb10">Sessions Mintue</label>
                                        <input type="text" name="session_time" pleaceholder="" class="form-control @error('session_time') in-valid @enderror">
                                        @error('session_time') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="heading-color ff-heading fw500 mb10">Sessions Price</label>
                                        <input type="text" name="session_price" pleaceholder="" class="form-control @error('session_time') in-valid @enderror">
                                        @error('description') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <a href="javascript:void(0);" class="mt10 mb10 text-success" id="add-session">Add More</a>
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button class="ud-btn btn-thm w-100" type="submit">Save<i class="fal fa-arrow-right-long"></i></button>
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

@endsection
@push('scripts')
<script>
    let sessionCount = 1;
    document.getElementById('add-session').addEventListener('click', function() {
        const sessionFields = `
            <div class="row">
                <div class="col-sm-12 mt10">
                    <div class="form-style1">
                        <label class="heading-color ff-heading fw500 mb10">Sessions Title</label>
                        <input type="text" name="session[${sessionCount}][session_title]" pleaceholder="" class="form-control @error('session_title') in-valid @enderror">
                        @error('session_title') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-sm-12 mt10">
                    <div class="form-style1">
                        <label class="heading-color ff-heading fw500 mb10">Sessions Mintue</label>
                        <input type="text" name="session[${sessionCount}][session_time]" pleaceholder="" class="form-control @error('session_time') in-valid @enderror">
                        @error('session_time') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-12 mt10">
                    <label class="heading-color ff-heading fw500 mb10">Sessions Price</label>
                        <input type="text" name="session[${sessionCount}][session_price]" pleaceholder="" class="form-control @error('session_time') in-valid @enderror">
                        @error('description') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
        `;
        // Insert the new experience fields before the button
        document.getElementById('add-session').insertAdjacentHTML('beforebegin', sessionFields);
        sessionCount++;
    });
</script>
@endpush

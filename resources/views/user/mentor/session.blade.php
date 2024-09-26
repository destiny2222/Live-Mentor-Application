@extends('layouts.master')
@section('content')


<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Session</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Session</li>
        </ol>
    </div>

</div>
<!-- PAGE-HEADER END -->


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Upload Session</h5>
                </div>
                <div class="card-body">
                    <form  action="{{ route('mentor.session.store') }}" id="syllabusForm" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12  mb-4 mt-3">
                                <div class="form-group">
                                    <label class="form-label">Sessions Title</label>
                                    <input type="text" name="session_title" pleaceholder="" class="form-control @error('session_title') in-valid @enderror">
                                    @error('session_title') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 ">
                                <div class="form-group">
                                    <label class="form-label">Sessions Mintue</label>
                                    <input type="text" name="session_time" pleaceholder="" class="form-control @error('session_time') in-valid @enderror">
                                    @error('session_time') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-12  mb-4 mt-3">
                                <label class="form-label">Sessions Price</label>
                                    <input type="text" name="session_price" pleaceholder="" class="form-control @error('session_time') in-valid @enderror">
                                    @error('description') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <a href="javascript:void(0);" class="mb-4 mt-3 mb10 text-success" id="add-session">Add More</a>
                            <div class="col-md-12 mb-4 mt-3">
                                <div class="text-center">
                                    <button class="btn btn-primary w-100" type="submit">Save</button>
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
    let sessionCount = 1;
    document.getElementById('add-session').addEventListener('click', function() {
        const sessionFields = `
            <div class="row">
                <div class="col-sm-12 mb-4 mt-3">
                    <div class="form-group">
                        <label class="form-label">Sessions Title</label>
                        <input type="text" name="session[${sessionCount}][session_title]" pleaceholder="" class="form-control @error('session_title') in-valid @enderror">
                        @error('session_title') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-sm-12 mb-4 mt-3">
                    <div class="form-group">
                        <label class="form-label">Sessions Mintue</label>
                        <input type="text" name="session[${sessionCount}][session_time]" pleaceholder="" class="form-control @error('session_time') in-valid @enderror">
                        @error('session_time') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-12 mb-4 mt-3">
                    <label class="form-label">Sessions Price</label>
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

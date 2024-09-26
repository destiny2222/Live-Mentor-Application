@extends('layouts.master-2')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Plugins</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Plugins</a></li>
                        <li class="breadcrumb-item active">Plugins</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    @if($plugins->isNotEmpty())
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Firebase Credentials</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.plugin.firebase.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Product Id</label>
                            <input class="form-control" type="text" name="project_id" value="{{ $plugins->first()->project_id ?? '' }}" id="example-text-input">
                        </div>
                        <div class="mb-3">
                            <label for="example-search-input" class="form-label">Private Key Id</label>
                            <input class="form-control" type="text" name="private_key_id" value="{{ $plugins->first()->private_key_id ?? ''}}" id="example-search-input">
                        </div>
                        <div class="mb-3">
                            <label for="example-email-input" class="form-label">Private Key</label>
                            <input class="form-control" type="text" value="{{ $plugins->first()->private_key ?? ''}}" name="private_key"  id="example-email-input">
                        </div>
                        <div class="mb-3">
                            <label for="example-url-input" class="form-label">Client Email</label>
                            <input class="form-control" type="text" value="{{ $plugins->first()->client_email ?? ''}}" name="client_email" id="example-url-input">
                        </div>
                        <div class="mb-3">
                            <label for="example-tel-input" class="form-label">Client Id</label>
                            <input class="form-control" type="text" name="client_id" value="{{ $plugins->first()->client_id ?? ''}}" id="example-tel-input">
                        </div>
                        <div class="mb-3">
                            <label for="example-tel-input" class="form-label">Client cert url</label>
                            <input class="form-control" type="text" name="client_x509_cert_url" value="{{ $plugins->first()->client_x509_cert_url ?? ''}}" id="example-tel-input">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-lg">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    @endif
</div> <!-- container-fluid -->
@endsection
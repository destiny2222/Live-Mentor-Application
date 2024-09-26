@extends('layouts.master')
@section('content')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">My Class</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Class</li>
        </ol>
    </div>

</div>
<!-- PAGE-HEADER END -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                        <thead>
                        <tr>
                            <th class="wd-15p border-bottom-0">S/N</th>
                            <th class="wd-15p border-bottom-0">Topic</th>
                            <th class="wd-15p border-bottom-0">Meeting Password</th>
                            <th class="wd-15p border-bottom-0">Meeting Date</th>
                            <th class="wd-15p border-bottom-0">Meeting Url</th>
                            {{-- <th scope="col">Meeting Status</th> --}}
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $session)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td >{{ $session->book_session }}</td>
                                    <td >{{ $session->zoom_meeting_password }}</td>
                                    <td >{{ $session->zoom_meeting_start_time }}</td>
                                    <td ><a href="{{ $session->zoom_meeting_url }}"  class="pending-style style2">Join url</a></td>
                                    {{-- <td >{{ $session->zoom_meeting_status }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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

  <!-- Row -->
  <div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">My Class</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0" scope="col">S/N</th>
                                <th class="wd-15p border-bottom-0">Topic</th>
                                <th class="wd-15p border-bottom-0">Type</th>
                                <th class="wd-15p border-bottom-0">Meeting Password</th>
                                <th class="wd-15p border-bottom-0">Meeting Date</th>
                                <th class="wd-15p border-bottom-0">Meeting Url</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td >{{ $transaction['title'] }}</td>
                                <td >{{ $transaction['type']   }}</td>
                                <td >{{ $transaction['meeting_password'] ?? 'N/A'   }}</td>
                                <td >{{ $transaction['meeting_date']  ?? 'N/A' }}</td>
                                <td >
                                    @if ($transaction['status'] == '4')
                                    <a class="btn btn-primary-gradient" href="{{ $transaction['meeting_url']   }}">Join Link</a>
                                    @elseif ($transaction['status'] == '2')
                                    <a class="btn btn-danger-gradient" href="javascript:void(0)">Rejected</a>
                                    @else
                                    <a class="btn btn-info-gradient" href="javascript:void(0)">Pending</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->


@endsection

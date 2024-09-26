@extends('layouts.master')
@section('content')

  <!-- PAGE-HEADER -->
  <div class="page-header">
    <h1 class="page-title">History</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">History</li>
        </ol>
    </div>

</div>
<!-- PAGE-HEADER END -->

  <!-- Row -->
  <div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">History</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">S/N</th>
                                <th class="wd-15p border-bottom-0">Title</th>
                                <th class="wd-15p border-bottom-0">Amount</th>
                                <th class="wd-15p border-bottom-0">Type</th>
                                <th class="wd-15p border-bottom-0">Payment Status</th>
                                <th class="wd-15p border-bottom-0">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                @if ($transaction['type'] === 'proposal')
                                    <td >{{ $transaction['course_title'] ?? 'N/A' }}</td>
                                    <td >{{ number_format($transaction['amount'], 2) }}</td>
                                @elseif ($transaction['type'] === 'session')
                                    <td >{{ $transaction['session_title'] ?? 'N/A' }}</td>
                                    <td >{{ number_format($transaction['amount'], 2) }}</td>
                                @endif
                                    
                                <td >{{ $transaction['type'] }}</td>
                                <td >
                                    @if ($transaction['status'] == '1')
                                        <a href="{{ route('pay') }}" onclick="event.preventDefault(); document.getElementById('payemnt-form-{{ $loop->index }}').submit();" class="btn btn-primary">
                                            Make Payment
                                        </a>
                                        <form class="d-none" action="{{ route('pay') }}" method="POST" id="payemnt-form-{{ $loop->index }}">
                                            @csrf
                                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                                            <input type="hidden" name="id" value="{{ $transaction['id'] }}">
                                            <input type="hidden" name="type" value="{{ $transaction['type'] }}">
                                            <input type="hidden" name="price" value="{{ $transaction['amount'] }}">
                                        </form>
                                    @elseif ($transaction['status'] == '2')
                                        <span class="btn btn-danger-gradient style3">Cancel</span>
                                    @elseif ($transaction['status'] == '4')
                                        <span class="btn btn-primary-gradient style2">Completed</span>
                                    @else
                                        <span class="btn btn-info-gradient style1">Pending</span>
                                    @endif
                                </td>
                                <td >
                                    {{ \Carbon\Carbon::parse($transaction['date'])->format('m:d:y') }}
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

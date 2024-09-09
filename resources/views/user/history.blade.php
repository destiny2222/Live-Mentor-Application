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
        <div class="row align-items-center justify-content-between pb40">
            <div class="col-lg-12">
              <div class="dashboard_title_area">
                <h2>History</h2>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
              <div class="ps-widget bgc-white bdrs4 p30 mb60 overflow-hidden position-relative">
                <div class="packages_table table-responsive">
                  <table class="table-style3 table at-savesearch">
                    <thead class="t-head">
                      <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Title</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Type</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody class="t-body">
                      @foreach ($transactions as $transaction)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>

                            @if ($transaction['type'] === 'proposal')
                                <td class="vam">{{ $transaction['course_title'] ?? 'N/A' }}</td>
                                <td class="vam">{{ number_format($transaction['amount'], 2) }}</td>
                            @elseif ($transaction['type'] === 'session')
                                <td class="vam">{{ $transaction['session_title'] ?? 'N/A' }}</td>
                                <td class="vam">{{ number_format($transaction['amount'], 2) }}</td>
                            @endif
                                
                            <td class="vam">{{ $transaction['type'] }}</td>
                            <td class="vam">
                                @if ($transaction['status'] == '1')
                                    <a href="{{ route('pay') }}" onclick="event.preventDefault(); document.getElementById('payemnt-form-{{ $loop->index }}').submit();" class="pending-style style2">
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
                                    <span class="pending-style style3">Cancel</span>
                                @elseif ($transaction['status'] == '4')
                                    <span class="pending-style style2">Completed</span>
                                @else
                                    <span class="pending-style style1">Pending</span>
                                @endif
                            </td>
                            <td class="vam">
                                {{ \Carbon\Carbon::parse($transaction['date'])->format('m:d:y') }}
                            </td>
                        </tr>
                    @endforeach                  
                      
                    </tbody>
                  </table>
                  <div class="mbp_pagination text-center mt30">
                    <ul class="page_navigation">
                        
                    </ul>
                  </div>
                </div>
              </div>
              
            </div>
        </div>
    </div>
    <footer class="dashboard_footer pt30 pb30">
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-md-between">
                <div class="col-auto">
                    <div class="copyright-widget">
                        <p class="mb-md-0">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection

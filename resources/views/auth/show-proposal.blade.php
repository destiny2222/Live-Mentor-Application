@extends('layouts.master')
<style>
 @media (max-width: 767px) {
  .pending-style {
    font-size: 9px;
  }
}
</style>
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
                <h2>Proposal</h2>
                <!-- <p class="text">Lorem ipsum dolor sit amet, consectetur.</p> -->
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
                        <th>Topic</th>
                        <th>Type</th>
                        <th>Meeting Password</th>
                        <th>Meeting Date</th>
                        <th>Meeting Url</th>
                      </tr>
                    </thead>
                    <tbody class="t-body">
                      @foreach ($transactions as $transaction)
                        <tr>
                          <th scope="row">{{ $loop->index + 1 }}</th>
                          <td class="vam">{{ $transaction['title'] }}</td>
                          <td class="vam">{{ $transaction['type']   }}</td>
                          <td class="vam">{{ $transaction['meeting_password'] ?? 'N/A'   }}</td>
                          <td class="vam">{{ $transaction['meeting_date']  ?? 'N/A' }}</td>
                          <td class="vam">
                            @if ($transaction['status'] == '4')
                             <a class="pending-style style2" href="{{ $transaction['meeting_url']   }}">Join Link</a>   
                            @elseif ($transaction['status'] == '2')
                              <a class="pending-style style2" href="javascript:void(0)">Rejected</a>   
                            @else
                              <a class="pending-style style2" href="javascript:void(0)">Pending</a>
                            @endif
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

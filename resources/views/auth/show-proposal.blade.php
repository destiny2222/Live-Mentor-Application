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
            <div class="col-lg-6">
              <div class="dashboard_title_area">
                <h2>Payouts</h2>
                <p class="text">Lorem ipsum dolor sit amet, consectetur.</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="text-lg-end">
                <a href="page-freelancer-v1.html" class="ud-btn btn-dark default-box-shadow2">Create Payout<i class="fal fa-arrow-right-long"></i></a>
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
                        <th scope="col">Course Title</th>
                        <th scope="col"></th>
                        <th scope="col">Payment Status</th>
                      </tr>
                    </thead>
                    <tbody class="t-body">
                      {{-- @foreach ($proposalDetails as $item) --}}
                        <tr>
                          <th scope="row">$1.800</th>
                          <td class="vam">April 9, 2023</td>
                          <td class="vam">Paypal</td>
                          <td class="vam"><span class="pending-style style1">Pending</span></td>
                        </tr>
                      {{-- @endforeach --}}
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

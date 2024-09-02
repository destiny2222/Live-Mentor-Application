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
                <h2>My Class</h2>
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
                            <th scope="col">Topic</th>
                            <th scope="col">Meeting Password</th>
                            <th scope="col">Meeting Date</th>
                            <th scope="col">Meeting Url</th>
                            {{-- <th scope="col">Meeting Status</th> --}}
                          </tr>
                        </thead>
                        <tbody class="t-body">
                            @foreach($sessions as $session)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td class="vam">{{ $session->book_session }}</td>
                                    <td class="vam">{{ $session->zoom_meeting_password }}</td>
                                    <td class="vam">{{ $session->zoom_meeting_start_time }}</td>
                                    <td class="vam"><a href="{{ $session->zoom_meeting_url }}"  class="pending-style style2">Join url</a></td>
                                    {{-- <td class="vam">{{ $session->zoom_meeting_status }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
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

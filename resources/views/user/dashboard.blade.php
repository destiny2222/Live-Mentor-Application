@extends('layouts.master')
@section('content')
<style>
    @media (max-width: 768px) {
  .chartjs-wrapper-demo {
    width: 100% !important; /* Make the container full width */
    padding: 0;             /* Remove any padding */
  }

  canvas {
    width: 100% !important; /* Ensure the chart itself takes full width */
  }
}

</style>
<div class="page-header">
    <h1 class="page-title">Welcome Back {{ $user->name }}</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>
</div>

<div class="row mb-4">
    @if ($user->checkTutorStatus())
        <div class="col-lg-12 ">
            <div class="" role="alert">
                Complete your profile
                <a href="{{ route('tutor.create') }}" class="btn btn-primary text-white btn-sm text-lg-end ms-2">Click Here</a>
            </div>
        </div>
    @elseif ($user->checkTutorActiveStatus())
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                <i class="fa fa-check-circle-o me-2" aria-hidden="true"></i>
                Your account is not active yet. Undergoing verification as a tutor.
            </div>
        </div>
    @endif
</div>
@if ($user->checkMentorStatus())
    <div class="row mb-4">
        <div class="col-12">
            <div class="" role="alert">
                Complete your registration  <a href="{{ route('mentor.create') }}" class="btn btn-primary text-white btn-sm" target="_blank">Click Here</a>
            </div>
        </div>
    </div>
@elseif ($user->checkMentorActiveStatus())
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                <i class="fa fa-check-circle-o me-2" aria-hidden="true"></i> Your account is not active yet. Undergoing verification as a mentor
            </div>
        </div>
    </div>
{{-- @elseif ($user->isMentorApproved())
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-success" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                <i class="fa fa-check-circle-o me-2" aria-hidden="true"></i> Your account is approved and active
            </div>
        </div>
    </div> --}}
@endif



<!-- ROW-1 -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
        <div class="row">
            @if ($user->role == 'mentor')
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Completed Sessions</h6>
                                <h2 class="mb-0 number-font">{{ $countEnroll }}</h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="saleschart"
                                        class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Pending Session</h6>
                                <h2 class="mb-0 number-font">{{ $SessionPendingCount }}</h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="leadschart"
                                        class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Total Review</h6>
                                <h2 class="mb-0 number-font">{{ $TotalReview }}</h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="profitchart"
                                        class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif ($user->role == 'tutor')
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class=""> Completed Classes</h6>
                                <h2 class="mb-0 number-font">{{ $countEnroll }}</h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="costchart"
                                        class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Total Review</h6>
                                <h2 class="mb-0 number-font">0</h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="costchart"
                                        class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Enroll Course</h6>
                                <h2 class="mb-0 number-font">{{ $countEnroll }}</h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="costchart"
                                        class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Pending Course</h6>
                                <h2 class="mb-0 number-font">{{ $PendingCountEnroll }}</h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="costchart"
                                        class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- ROW-1 END -->

<!-- ROW-2 -->
<div class="row">
    @if ($user->role == 'mentor')
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-body">
                    
                    <div class="chartjs-wrapper-demo">
                        <canvas id="enrollmentChar" class="chart-dropshadow"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
    @elseif (Auth::user()->role == 'tutor')
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Enrollment Analytics</h3>
            </div>
            <div class="card-body">
                <div class="chartjs-wrapper-demo">
                    <canvas id="enrollmentChart" class="chart-dropshadow"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- COL END -->
    @else
    {{-- <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">Product Sales</h3>
            </div>
            <div class="card-body pt-4">
                <div class="table-responsive">
                    <table id="data-table"
                        class="table table-bordered text-nowrap mb-0">
                        <thead class="border-top">
                            <tr>
                                <th class="bg-transparent border-bottom-0"
                                    style="width: 5%;">Tracking Id</th>
                                <th
                                    class="bg-transparent border-bottom-0">
                                    Product</th>
                                <th
                                    class="bg-transparent border-bottom-0">
                                    Customer</th>
                                <th
                                    class="bg-transparent border-bottom-0">
                                    Date</th>
                                <th
                                    class="bg-transparent border-bottom-0">
                                    Amount</th>
                                <th
                                    class="bg-transparent border-bottom-0">
                                    Payment Mode</th>
                                <th class="bg-transparent border-bottom-0"
                                    style="width: 10%;">Status</th>
                                <th class="bg-transparent border-bottom-0"
                                    style="width: 5%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr class="border-bottom">
                                <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                        <h6
                                            class="mb-0 fs-14 fw-semibold">
                                            #98765490</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <span class="avatar bradius"
                                            style="background-image: url(../assets/images/orders/10.jpg)"></span>
                                        <div
                                            class="ms-3 mt-0 mt-sm-2 d-block">
                                            <h6
                                                class="mb-0 fs-14 fw-semibold">
                                                Headsets</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div
                                            class="mt-0 mt-sm-3 d-block">
                                            <h6
                                                class="mb-0 fs-14 fw-semibold">
                                                Cherry Blossom</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="mt-sm-2 d-block">30 Aug
                                        2021</span></td>
                                <td><span
                                        class="fw-semibold mt-sm-2 d-block">$6.721.5</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div
                                            class="mt-0 mt-sm-3 d-block">
                                            <h6
                                                class="mb-0 fs-14 fw-semibold">
                                                Online Payment</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-sm-1 d-block">
                                        <span
                                            class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="g-2">
                                        <a class="btn text-primary btn-sm"
                                            data-bs-toggle="tooltip"
                                            data-bs-original-title="Edit"><span
                                                class="fe fe-edit fs-14"></span></a>
                                        <a class="btn text-danger btn-sm"
                                            data-bs-toggle="tooltip"
                                            data-bs-original-title="Delete"><span
                                                class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    @endif
</div>
<!-- ROW-2 END -->


<!-- ROW-4 -->
<div class="row">
    
</div>
<!-- ROW-4 END -->






@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0/dist/chartjs-adapter-moment.min.js"></script>
<script>
function renderEnrollmentChart() {
    fetch('/enrollment-data')
        .then(response => response.json())
        .then(data => {
            console.log('Fetched data:', data);
            const ctx = document.getElementById('enrollmentChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    datasets: [
                        {
                            label: 'Daily Enrollments',
                            data: Object.entries(data.daily).map(([date, count]) => ({ x: date, y: count })),
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        },
                        {
                            label: 'Weekly Enrollments',
                            data: Object.entries(data.weekly).map(([date, count]) => ({ x: date, y: count })),
                            borderColor: 'rgb(255, 99, 132)',
                            tension: 0.1
                        },
                        {
                            label: 'Monthly Enrollments',
                            data: Object.entries(data.monthly).map(([date, count]) => ({ x: date, y: count })),
                            borderColor: 'rgb(54, 162, 235)',
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day'
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching enrollment data:', error));
}
document.addEventListener('DOMContentLoaded', renderEnrollmentChart);
</script>

<script>


function renderSessionChart(data) {
    const ctx = document.getElementById('sessionChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [
                {
                    label: 'Pending Sessions',
                    data: Object.entries(data.daily).map(([date, values]) => ({ x: date, y: values.pending })),
                    borderColor: 'rgb(255, 206, 86)',
                    tension: 0.1
                },
                {
                    label: 'Reviewing Sessions',
                    data: Object.entries(data.daily).map(([date, values]) => ({ x: date, y: values.reviewing })),
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                },
                {
                    label: 'Accepted Sessions',
                    data: Object.entries(data.daily).map(([date, values]) => ({ x: date, y: values.accepted })),
                    borderColor: 'rgb(153, 102, 255)',
                    tension: 0.1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'day'
                    }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', renderAnalyticsCharts);
</>
@endpush

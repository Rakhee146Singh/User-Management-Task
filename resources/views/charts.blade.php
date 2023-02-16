@extends('dashboard')
@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item" style="color:blue;"><u>{{ Auth::user()->name }}</u></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    @if (Auth::user()->roles == 'admin')
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Employee</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="/employee" class="small text-white stretched-link">View Details</a>
                        <div class="small text-white">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Country</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="/country" class="small text-white stretched-link">View Details</a>
                        <div class="small text-white">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">State</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="/state" class="small text-white stretched-link">View Details</a>
                        <div class="small text-white">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">City</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="/city" class="small text-white stretched-link">View Details</a>
                        <div class="small text-white">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa fa-area-chart"></i>
                            Area Chart Of Employee
                        </div>
                        <div class="card-body">
                            <canvas id="myAreaChart" width="100%" height="50"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa fa-bar-chart"></i>
                            Bar Chart Of Employee
                        </div>
                        <div class="card-body">
                            <canvas id="myBarChart" width="100%" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif (Auth::user()->roles == 'employee')
        <h3> Welcome to User Management Site.</h3>
    @endif
    <script type="text/javascript">
        var _xdata = JSON.parse('{!! json_encode($months) !!}');
        var _ydata = JSON.parse('{!! json_encode($monthCount) !!}');
        var barColors = ["brown", "purple", "grey", "orange", "red"];
        new Chart("myBarChart", {
            type: "bar",
            data: {
                labels: _xdata,
                datasets: [{
                    backgroundColor: barColors,
                    data: _ydata
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Total Employee"
                }
            }
        });
    </script>
    <script type="text/javascript">
        var labels = {{ Js::from($months) }};
        var users = {{ Js::from($monthCount) }};

        const data = {
            labels: labels,
            datasets: [{
                label: 'Employee Details',
                backgroundColor: 'rgb(237, 157, 203 )',
                borderColor: 'rgb(243, 28, 152 )',
                data: users,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('myAreaChart'),
            config
        );
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection

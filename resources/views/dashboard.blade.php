<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Management System</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="overflow-y:hidden;">
    @guest
        <div class="col-9">
            @yield('content')
        </div>
    @else
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><img src="logo.png" alt="logo"
                    height="50px" width="50px" style="border-radius:30px">
                User Management System</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <a class="nav-link px-3" href="#">Welcome,{{ Auth::user()->name }}
                        <img src="{{ asset('storage/profiles/' . Auth::user()->profile_image) }}" height="50px"
                            width="50px" alt="no image" style="border-radius:20px;"></a>
                </div>
            </div>
        </header>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-3 ps-0">
                    <nav id="sidebarMenu" class=" d-md-block bg-dark sidebar collapse" style="height:93vh;">
                        <div class="position-sticky pt-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}"
                                        aria-current="page" style="color:white;" href="/dashboard"><i
                                            class='fas fa-tachometer-alt'
                                            style='font-size:20px;text-shadow:2px 2px 4px #848282;"'></i><span>
                                            Dashboard</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" style="color:white;" href="/profile">
                                        <i class="fas fa-portrait"
                                            style='font-size:20px;text-shadow:2px 2px 4px #848282;'></i> Profile</a>
                                </li>
                                @if (Auth::user()->roles == 'admin')
                                    <li class="nav-item">
                                        <a class="nav-link" style="color:white;" href="/country"><i
                                                class='fas fa-university'
                                                style='font-size:20px;text-shadow:2px 2px 4px #848282;'></i> Country</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" style="color:white;" href="/state">
                                            <i class='far fa-building'
                                                style='font-size:20px;text-shadow:2px 2px 4px #848282;'></i> State</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" style="color:white;" href="/city"><i class='fas fa-building'
                                                style='font-size:20px;text-shadow:2px 2px 4px #848282;'></i> City</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" style="color:white;" href="/employee">
                                            <i class="fa fa-users"
                                                style='font-size:20px;text-shadow:2px 2px 4px #848282;'></i> Employee</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" style="color:white;" href="{{ route('logout') }}"><i
                                            class='	fas fa-key'
                                            style='font-size:20px;text-shadow:2px 2px 4px #848282;'></i>
                                        Logout</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-12 col-md-9" style="overflow-y:auto;height:100vh;">
                    @yield('content')
                </div>
            </div>
        </div>
    @endguest

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>

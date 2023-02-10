<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Management System</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" /> --}}
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    {{-- <h1 class="mt-4 mb-5 text-center">User Management System</h1> --}}
    @guest
        <div class="col-9">
            @yield('content')
        </div>
    @else
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"> User Management</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <a class="nav-link px-3" href="#">Welcome,{{ Auth::user()->name }} </a>

                </div>
            </div>
        </header>

        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <nav id="sidebarMenu" class=" d-md-block bg-light sidebar collapse" style="height:100vh;">
                        <div class="position-sticky pt-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}"
                                        aria-current="page" href="/dashboard">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/profile">Profile</a>
                                </li>
                                @if (Auth::user()->roles == 'admin')
                                    <li class="nav-item">
                                        <a class="nav-link" href="/country">Country</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/state">State</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/city">City</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/employee">Employee</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-9">
                    @yield('content')
                </div>
            </div>
        </div>

    @endguest
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script> --}}
</body>

</html>

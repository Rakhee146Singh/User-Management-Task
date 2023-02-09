@extends('dashboard')
@section('content')
    <h2 class="mt-3">Employee Management</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/employee">Employee Management</a></li>
            <li class="breadcrumb-item active">Add New Employee</li>
        </ol>
    </nav>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add New Employee</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('employee.add_validation') }}">
                        <div class="form-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" />
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" name="email" class="form-control" placeholder="Enter Email" />
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" />
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>

                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-dark btn-block"> Submit </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

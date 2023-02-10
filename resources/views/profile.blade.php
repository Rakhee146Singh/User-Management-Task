@extends('dashboard')
@section('content')
    <h2 class="mt-3">Profile</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
    <div class="row mt-4">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Edit Employee</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.edit_validation') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">User Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                value="{{ $data->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">User Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                                value="{{ $data->email }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password" value="{{ $data->password }}">
                        </div>

                        <div class="form-group mb-3 d-flex">
                            <input type="submit" class="btn btn-primary" value="Edit">
                            <a class="nav-link px-9" href="{{ route('changePassword') }}">Change Password </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

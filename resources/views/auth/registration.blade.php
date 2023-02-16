@extends('dashboard')
@section('content')
    <main class="signup-form">
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="mt-4 mb-5 text-center">User Management System</h1>
                <div class="col-md-4">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3> Registration </h3>
                            You Can register here.
                        </div>
                        <div class="card-body">
                            <form action="{{ route('sample.validate_register') }}" method="POST" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name" />
                                    <label for="email">Name</label>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" name="email" class="form-control" placeholder="Enter Email" />
                                    <label for="email">Email</label>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-floating mb-3 mt-3">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Enter Password" />
                                    <label for="email">Password</label>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group mb-4 mt-3">
                                    <input type="file" name="profile_image" class="form-control"
                                        placeholder="Upload Profile Image" />
                                    @if ($errors->has('profile_image'))
                                        <span class="text-danger">{{ $errors->first('profile_image') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block"> Register </button>
                                </div>
                            </form>
                            <br>
                            <div class="text-center">
                                <a href="{{ route('login') }}">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@extends('dashboard')
@section('content')
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="mt-4 mb-5 text-center">User Management System</h1>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3> Login </h3>
                            You Can login here.
                        </div>
                        <div class="card-body">
                            <form action="{{ route('sample.validate_login') }}" method="POST">
                                @csrf
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" name="email" class="form-control" placeholder="Enter Email" />
                                    <label for="email">Email</label>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-floating mb-4 mt-3">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Enter Password" />
                                    <label for="password">Password</label>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block"><i class='fas fa-unlock'
                                            style='font-size:18px'></i> Login </button>
                                </div>
                            </form>
                            <a href="/forget-password" style="text-align:center;"><i class='fas fa-unlock-alt'
                                    style='font-size:16px'></i> Forget Password</a> /
                            <a href="/register">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

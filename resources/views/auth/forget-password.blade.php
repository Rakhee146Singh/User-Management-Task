@extends('dashboard')
@section('content')
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="mt-4 mb-5 text-center">User Management System</h1>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3> Forget Password </h3>
                            Please insert your email in the input below and we will send an email with the link to reset
                            your password.
                        </div>
                        <div class="card-body">
                            <form action="{{ route('forgetPassword') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" name="email" class="form-control" placeholder="Enter Email" />
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block"><i class='fas fa-unlock-alt'
                                            style='font-size:16px'></i> Forget Password </button>
                                </div>
                            </form>
                            <a href="login"><i class='fas fa-unlock' style='font-size:18px'></i> Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

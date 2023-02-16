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
                            <h3> Reset Password </h3>
                            You Can Reset your password here.
                        </div>
                        <div class="card-body">
                            <form action="{{ route('resetPassword') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="hidden" name="id" value="{{ $data }}" />
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Enter Password" />
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Enter Confirm Password" />
                                    {{-- @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}
                                        </span>
                                    @endif --}}
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block"><i class='fas fa-user-lock'
                                            style='font-size:20px'></i> Reset Password </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

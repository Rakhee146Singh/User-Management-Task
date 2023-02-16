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
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header"> {{ Auth::user()->roles }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.edit_validation') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="text-center">
                                    <img src="{{ asset('storage/profiles/' . $data->profile_image) }}" height="90px"
                                        width="100px" alt="no image" style="border-radius:120px">
                                    <br>
                                    {{ Auth::user()->name }}
                                </div>

                                <div class="form-group mb-3">
                                    <label for="profile_image">{{ __('Change Image') }}</label>
                                    <input id="profile_image" type="file"
                                        class="form-control @error('profile_image') is-invalid @enderror"
                                        name="profile_image" value="{{ $data->profile_image }}"required
                                        autocomplete="profile_image">
                                    @error('profile_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="name">User Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name" value="{{ $data->name }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email">User Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="Email" value="{{ $data->email }}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="d-grid mx-auto">
                                    <input type="submit" class="btn btn-primary" value="Edit">
                                    <a class="nav-link px-4" href="{{ route('changePassword') }}"><i
                                            class='fas fa-user-shield' style='font-size:20px'></i>Change Password </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('dashboard')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-between">
            <div class="col-sm-5 align-item-center">
                <form method="POST" action="{{ url('state/save') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="state" class="form-label">State Name</label>
                        <input type="text" class="form-control" id="state" name="state">
                        <span class="text-danger">
                            @error('state')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="country" class="form-label">Country Name</label>
                        <select class="form-control" name="country" id="country">
                            <option hidden>Choose Country Name</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('country')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="button" style="text-align:center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                @if (session()->has('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@endsection

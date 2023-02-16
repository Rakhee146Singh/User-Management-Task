@extends('dashboard')
@section('content')
    <h2 class="mt-3">List Of City</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">City Management</li>
        </ol>
    </nav>
    <div class="mt-4 mb-4">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-md-6">City Management </div>
                    <div class="col col-md-6">
                        <a href="javascript:void(0)" class="btn btn-success btn-sm float-end" id="createNewCity">Add
                            City</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" border="1" id="city_table">
                        <thead>
                            <th> Id </th>
                            <th> State Id </th>
                            <th> City Name </th>
                            <th> Actions </th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="cityForm" name="cityForm" class="form-horizontal">
                        <input type="hidden" name="city_id" id="city_id">
                        <div class="form-group">
                            <label for="country_id" class="col-sm control-label"> State Name </label>
                            <br>
                            <div class="col-sm-12">
                                <select class="form-control" name="state_id" id="state_id">
                                    <option hidden>Choose State Name</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->state }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="city" class="col-sm control-label"> City Name</label>
                            <br>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="city" name="city"
                                    placeholder="Enter State Name" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#city_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('city') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'state_id',
                        name: 'state_id'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }
                ]
            });

            $('#createNewCity').click(function() {
                $('#city_id').val('');
                $('#cityForm').trigger("reset");
                $('#modelHeading').html("Create New City");
                $('#ajaxModel').modal('show');
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#cityForm').serialize(),
                    url: "{{ route('city.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#cityForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save');
                    }
                });
            });

            $('body').on('click', '.deleteCity', function() {
                var city_id = $(this).data("id");
                if (confirm("Are You sure want to delete !")) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('city.store') }}" + '/' + city_id,
                        success: function(data) {
                            table.draw();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });

            $('body').on('click', '.editCity', function() {
                var city_id = $(this).data('id');
                $.get("{{ route('city.index') }}" + '/' + city_id + '/edit', function(
                    data) {
                    $('#modelHeading').html("Edit City");
                    $('#ajaxModel').modal('show');
                    $('#city_id').val(data.id);
                    $('#state_id').val(data.state_id);
                    $('#city').val(data.city);
                })
            });

        });
    </script>
@endsection

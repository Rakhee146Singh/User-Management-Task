@extends('dashboard')
@section('content')
    <h2 class="mt-3">List Of State</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">State Management</li>
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
                    <div class="col col-md-6">State Management </div>
                    <div class="col col-md-6">
                        <a href="javascript:void(0)" class="btn btn-success btn-sm float-end" id="createNewState">Add
                            State</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" border="1" id="state_table">
                        <thead>
                            <th> Id </th>
                            <th> Country Id </th>
                            <th> State Name </th>
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
                    <form id="stateForm" name="stateForm" class="form-horizontal">
                        <input type="hidden" name="state_id" id="state_id">
                        <div class="form-group">
                            <label for="country_id" class="col-sm control-label"> Country Name </label>
                            <br>
                            <div class="col-sm-12">
                                <select class="form-control" name="country_id" id="country_id">
                                    <option hidden>Choose Country Name</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->country }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="state" class="col-sm control-label"> State Name</label>
                            <br>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="state" name="state"
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
            var table = $('#state_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('state') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'country_id',
                        name: 'country'
                    },
                    {
                        data: 'state',
                        name: 'state'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }
                ]
            });

            $('#createNewState').click(function() {
                $('#state_id').val('');
                $('#stateForm').trigger("reset");
                $('#modelHeading').html("Create New State");
                $('#ajaxModel').modal('show');
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#stateForm').serialize(),
                    url: "{{ route('state.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#stateForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save');
                    }
                });
            });

            $('body').on('click', '.deleteState', function() {
                var state_id = $(this).data("id");
                if (confirm("Are You sure want to delete !")) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('state.store') }}" + '/' + state_id,
                        success: function(data) {
                            table.draw();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });

            $('body').on('click', '.editState', function() {
                var state_id = $(this).data('id');
                $.get("{{ route('state.index') }}" + '/' + state_id + '/edit', function(
                    data) {
                    $('#modelHeading').html("Edit State");
                    $('#ajaxModel').modal('show');
                    $('#state_id').val(data.id);
                    $('#country_id').val(data.country_id);
                    $('#state').val(data.state);
                })
            });

        });
    </script>
@endsection

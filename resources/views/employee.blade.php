@extends('dashboard')
@section('content')
    <h2 class="mt-3">List Of Employee</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Employee Management</li>
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
                    <div class="col col-md-6">Employee Management </div>
                    <div class="col col-md-6">
                        {{-- <a href="{{ route('employee.add') }}" class="btn btn-success btn-sm float-end">Add</a> --}}
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                                class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="start_date" placeholder="Start Date"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                                class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="end_date" placeholder="End Date"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button id="filter" class="btn btn-primary">Filter</button>
                            <button id="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" border="1" id="employee_table">
                            <thead>
                                {{-- <tr> --}}
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                                {{-- </tr> --}}
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
            // $(document).ready(function() {
            //     var table = $('#employee_table').DataTable({
            //         processing: true,
            //         serverSide: true,
            //         ajax: "{{ route('employee.fetchall') }}",
            //         columns: [{
            //                 data: 'name',
            //                 name: 'name'
            //             }, {
            //                 data: 'email',
            //                 name: 'email'
            //             },
            //             {
            //                 data: 'created_at',
            //                 name: 'created_at'
            //             },
            //             {
            //                 data: 'updated_at',
            //                 name: 'updated_at'
            //             },
            //             {
            //                 data: 'action',
            //                 name: 'action',
            //                 orderable: true,
            //                 searchable: true
            //             }
            //         ]
            //     });
            //     $(document).on('click', '.delete', function() {
            //         var id = $(this).data('id');
            //         if (confirm("Are you sure you want to delete it?")) {
            //             window.location.href = "/employee/delete/" + id;
            //         }
            //     });

            // });
            // $(function() {
            //     $("#start_date").datepicker({
            //         "dateFormat": "yy-mm-dd"
            //     });
            //     $("#end_date").datepicker({
            //         "dateFormat": "yy-mm-dd"
            //     });
            // });

            function fetch(start_date, end_date) {
                $.ajax({
                    url: "{{ route('employee.records') }}",
                    type: "GET",
                    data: {
                        start_date: start_date,
                        end_date: end_date
                    },
                    dataType: "json",
                    success: function(data) {
                        var i = 1;
                        $('#employee_table').DataTable({
                            "data": data.users,
                            "responsive": true,
                            "columns": [{
                                    "data": "id",
                                    "render": function(data, type, row, meta) {
                                        return i++;
                                    }
                                },
                                {
                                    "data": "name"
                                },
                                {
                                    "data": "email",
                                    "render": function(data, type, row, meta) {
                                        return `${row.email}`;
                                    }
                                },
                                {
                                    "data": "roles"
                                },
                                {
                                    "data": "created_at",
                                    "render": function(data, type, row, meta) {
                                        return `${row.created_at}.format('DD-MM-YYYY')`;
                                    }
                                }
                            ]
                        });
                    }
                });
            }
            fetch();
            // Filter
            $(document).on("click", "#filter", function(e) {
                e.preventDefault();
                var start_date = $("#start_date").val();
                var end_date = $("#end_date").val();
                if (start_date == "" || end_date == "") {
                    alert("Both date required");
                } else {
                    $('#employee_table').DataTable().destroy();
                    fetch(start_date, end_date);
                }
            });
            // Reset
            $(document).on("click", "#reset", function(e) {
                e.preventDefault();
                $("#start_date").val(''); // empty value
                $("#end_date").val('');
                $('#employee_table').DataTable().destroy();
                fetch();
            });
        </script>
    @endsection

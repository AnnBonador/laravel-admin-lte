@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payment Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payment Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection
@section('body')
    <!-- Main row -->
    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Paypal List</h3>
                            @role('Super-Admin')
                                <a href="{{ route('paypal.create') }}" class="btn btn-sm btn-primary float-right"><i
                                        class="fa fa-plus"></i>
                                    &nbsp;&nbsp;Add
                                    Paypal</a>
                            @endrole
                        </div>
                        <div class="card-body">
                            <table id="table1" class="table table-borderless table-hover" style="width:100%;">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Clinic ID</th>
                                        <th>Username</th>
                                        <th>Currency</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paypal as $data)
                                        <tr>
                                            <td>{{ $data->clinic->name }}</td>
                                            <td>{{ $data->username }}</td>
                                            <td>{{ $data->currency }}</td>
                                            <td>
                                                <a href="{{ route('paypal.edit', $data->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                                @role('Super-Admin')
                                                    <button type="button" class="btn btn-sm btn-danger deleteRecordbtn"
                                                        value="{{ $data->id }}"><i class="fa fa-trash"></i></button>
                                                @endrole
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Record</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('paypal.delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the record?</p>
                        <input type="hidden" name="delete_id" id="delete_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row (main row) -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#table1').on('click', '.deleteRecordbtn', function(e) {
                e.preventDefault();

                var delete_id = $(this).val();
                $('#delete_id').val(delete_id)
                $('#deleteModal').modal('show');

            });
        });
    </script>
@endsection

@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Doctors</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Doctors</li>
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
                            <h3 class="card-title">Doctors List</h3>
                            <a href="{{ route('doctors.create') }}" class="btn btn-sm btn-primary float-right"><i
                                    class="fa fa-plus"></i>
                                &nbsp;&nbsp;Add
                                Doctor</a>
                        </div>
                        <div class="card-body">
                            <table id="table1" class="table table-borderless table-hover" style="width:100%;">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Clinic Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Specialization</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctor as $data)
                                        <tr>
                                            <td>
                                                @if (!empty($data->image))
                                                    <img alt="Avatar" class="user-image img-circle"
                                                        width="50"src="{{ asset('uploads/doctor/' . $data->image) }}">
                                                @else
                                                    <img alt="Avatar" class="user-image img-circle"
                                                        width="50"src="{{ asset('admin-assets/dist/img/default.png') }}">
                                                @endif
                                                {{ $data->full_name }}
                                            </td>
                                            <td>
                                                @if ($data->clinic()->exists())
                                                    {{ $data->clinic->name }}
                                                @endif
                                            </td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->contact }}</td>
                                            <td>
                                                @if ($data->specialty()->exists())
                                                    {{ $data->specialty->name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->status == '1')
                                                    <small class="badge badge-primary">Active</small>
                                                @else
                                                    <small class="badge badge-warning">Inactive</small>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('doctors.edit', $data->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"
                                                        data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                                <a href="{{ route('doctorCredentials', $data->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-paper-plane"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Resend credentials"></i></a>
                                                <a href="{{ route('ratings.index', $data->id) }}"
                                                    class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                    data-placement="top" title="Patient Ratings"><i
                                                        class="fas fa-star"></i></a>

                                                <button type="button" class="btn btn-sm btn-danger deleteRecordbtn"
                                                    value="{{ $data->id }}"><i class="fa fa-trash"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Delete"></i></button>
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
                <form action="{{ route('doctors.delete') }}" method="POST">
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
            $('.deleteRecordbtn').click(function(e) {
                e.preventDefault();

                var delete_id = $(this).val();
                $('#delete_id').val(delete_id)
                $('#deleteModal').modal('show');

            });
        });
    </script>
@endsection

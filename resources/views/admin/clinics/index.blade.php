@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Clinics</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Clinics</li>
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
                            <h3 class="card-title">Clinics List</h3>
                            <a href="{{ route('clinics.create') }}" class="btn btn-sm btn-primary float-right"><i
                                    class="fa fa-plus"></i>
                                &nbsp;&nbsp;Add
                                clinic</a>
                        </div>
                        <div class="card-body">
                            <table id="table1" class="table table-borderless table-hover" style="width:100%;">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Clinic Admin Email</th>
                                        <th width="10%">Specialization</th>
                                        <th>Clinic Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clinic as $data)
                                        <tr>
                                            <td>
                                                @if (!empty($data->image))
                                                    <img alt="Avatar" class="user-image img-square"
                                                        width="50"src="{{ asset('uploads/clinic/' . $data->image) }}">
                                                @else
                                                    <img alt="Avatar" class="user-image img-square"
                                                        width="50"src="{{ asset('admin-assets/dist/img/default.png') }}">
                                                @endif
                                                {{ $data->name }}
                                            </td>
                                            <td>{{ $data->email }}</td>
                                            <td>
                                                @if ($data->users()->exists())
                                                    {{ $data->users->email }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ implode(', ', $data->specialization_id) }}
                                            </td>
                                            <td>{{ $data->address }}</td>
                                            <td class="text-center">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input switch-status"
                                                        data-id="{{ $data->id }}" name="status" type="checkbox"
                                                        {{ $data->status == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexSwitch">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('clinics.edit', $data->id) }}"
                                                    class="btn btn-sm btn-success" data-toggle="tooltip"
                                                    data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                @if ($data->users()->exists())
                                                    <a href="{{ route('clinicCredentials', $data->users->id) }}"
                                                        class="btn btn-sm btn-primary"><i class="fas fa-paper-plane"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Resend credentials"></i></a>
                                                @endif

                                                <button type="button" class="btn btn-sm btn-danger deleteRecordbtn"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"
                                                    value="{{ $data->id }}"><i class="fa fa-trash"></i></button>

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
    <!-- /.row (main row) -->
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Record</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('clinics.delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the clinic and clinic admin?</p>
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
            $('.switch-status').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let clinicId = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('clinics.status.update') }}',
                    data: {
                        'status': status,
                        'clinic_id': clinicId
                    },
                    success: function(data) {
                        toastr.success(data.success);
                    }
                });
            });
        });
    </script>
@endsection

@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Appointment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Appointment</li>
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
                    <div class="form-group mb-2">
                        <a href="{{ route('appointments.all') }}" class="btn btn-info active">All</a>
                        <a href="{{ route('appointments.index') }}" class="btn btn-info">Upcoming</a>
                        <a href="{{ route('appointments.past') }}" class="btn btn-info">Past</a>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">All Appointments</h3>
                            <a href="{{ route('appointments.create') }}" class="btn btn-sm btn-primary float-right"><i
                                    class="fa fa-plus"></i>
                                &nbsp;&nbsp;Add
                                Appointment</a>
                        </div>
                        <div class="card-body">
                            <table id="table1" class="table table-borderless table-hover" style="width:100%;">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Time</th>
                                        <th>Services</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $data)
                                        <tr>
                                            <td>
                                                @if ($data->patients()->exists())
                                                    <b>{{ $data->patients->full_name }}
                                                        ({{ $data->patients->email }})
                                                    </b><br>
                                                @endif
                                                @if ($data->doctors()->exists())
                                                    Doctor: {{ $data->doctors->full_name }}<br>
                                                @endif
                                                @if ($data->clinic()->exists())
                                                    Clinic: <span class="text-primary">{{ $data->clinic->name }}</span><br>
                                                @endif
                                                <small>Payment: {{ $data->payment_option }}</small>
                                            </td>
                                            <td>{{ $data->start_time . ' - ' . $data->end_time }}</td>
                                            <td>
                                                {{ implode(', ', $data->service) }}
                                            </td>
                                            <td>
                                                @if ($data->schedule()->exists())
                                                    {{ $data->schedule->day }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->status == 'Booked')
                                                    <span class="badge badge-light">{{ $data->status }}</span>
                                                @elseif($data->status == 'Check in')
                                                    <span class="badge badge-success">{{ $data->status }}</span>
                                                @elseif($data->status == 'Check out')
                                                    <span class="badge badge-info">{{ $data->status }}</span>
                                                @elseif($data->status == 'Cancelled')
                                                    <span class="badge badge-danger">{{ $data->status }}</span>
                                                @elseif($data->status == 'Completed')
                                                    <span class="badge badge-primary">{{ $data->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->status != 'Completed')
                                                    <a href="{{ route('appointments.edit', $data->id) }}"
                                                        class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                                @endif

                                                <button type="button" class="btn btn-sm btn-danger deleteRecordbtn"
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

    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Record</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('appointments.delete') }}" method="POST">
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
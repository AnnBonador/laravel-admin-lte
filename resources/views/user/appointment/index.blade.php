@extends('layouts.user')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Appointment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Appointment List</h3>
                            <a href="{{ route('user.appointments.create') }}" class="btn btn-sm btn-primary float-right"><i
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
                                                    <b>{{ $data->patients->full_name }}</b><br>
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
                                            <td>{{ $data->schedule->day }}</td>
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
                                                <button type="button" class='btn btn-sm btn-secondary viewdetails'
                                                    data-id='{{ $data->id }}'><i class="fa fa-eye"></i></button>
                                                @if ($data->status == 'Booked')
                                                    <a href="{{ route('user.appointments.edit', $data->id) }}"
                                                        class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>

                                                    <button type="button" class="btn btn-sm btn-danger deleteRecordbtn"
                                                        value="{{ $data->id }}"><i class="fa fa-trash"></i></button>
                                                @elseif($data->status == 'Completed')
                                                    <a href="{{ route('user.ratings', $data->id) }}"
                                                        class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title="Rate Doctor"><i
                                                            class="fas fa-star"></i></a>
                                                @endif
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

    @include('user.appointment.modal')
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

            $('.viewdetails').click(function() {
                var app_id = $(this).attr('data-id');

                if (app_id > 0) {

                    var url = "{{ route('usergetAppointmentDetails', [':app_id']) }}";
                    url = url.replace(':app_id', app_id);

                    $('#tblappinfo tbody').empty();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function(response) {

                            $('#tblappinfo tbody').html(response.html);
                            $('#appModal').modal('show');
                        }
                    });
                }
            });
        });
    </script>
@endsection

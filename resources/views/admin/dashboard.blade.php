@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection
@section('body')
    <!-- Main row -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-gradient-info">
                        <span class="info-box-icon"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase">total patients</span>
                            <span class="info-box-number">{{ $total_patients }}</span>
                            <span class="progress-description">
                                Total visited patients
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-gradient-warning">
                        <span class="info-box-icon"><i class="fas fa-user-friends"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase">total doctors</span>
                            <span class="info-box-number">{{ $total_doctors }}</span>
                            <span class="progress-description">
                                Total clinic doctors
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-gradient-teal">
                        <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase">total appointments</span>
                            <span class="info-box-number">{{ $total_appointments }}</span>
                            <span class="progress-description">
                                Total clinic appointments
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-gradient-secondary">
                        <span class="info-box-icon"><i class="fas fa-money-bill"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase">total revenue</span>
                            <span class="info-box-number">{{ $total_earnings }}</span>
                            <span class="progress-description">
                                Total clinic earnings
                            </span>

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Today's Appointment List</h3>
                        </div>
                        <div class="card-body">
                            @foreach ($appointment as $data)
                                @if ($data->schedule()->exists())
                                    @if ($data->schedule->day == Carbon\Carbon::now()->format('m/d/Y'))
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="d-flex flex-column">
                                                <span class="font-weight-bold">

                                                    {{ $data->schedule->day }}

                                                    {{ $data->patients->full_name }} <span class="fw-light">
                                                        ({{ $data->start_time . ' -  ' . $data->end_time }})
                                                    </span>
                                                </span>
                                                <span class="text-primary text-uppercase">{{ $data->clinic->name }}</span>
                                                <span class="fw-lighter">{{ $data->doctors->full_name }}</span>
                                            </p>
                                            <p class="text-success text-right">
                                                <span class="right badge badge-light">{{ $data->status }}</span>
                                            </p>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Upcoming Appointments</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <tbody>
                                    @foreach ($appointment->take(5) as $data)
                                        @if ($data->schedule()->exists())
                                            @if ($data->schedule->day > Carbon\Carbon::now()->format('m/d/Y'))
                                                <tr>
                                                    <td>
                                                        @if (!empty($data->patients->image))
                                                            <img src="{{ asset('uploads/patient/' . $data->patients->image) }}"
                                                                alt="img" class="img-circle img-size-32 mr-2">
                                                        @else
                                                            <img alt="Avatar" class="img-circle img-size-32 mr-2"
                                                                alt="img"
                                                                src="{{ asset('admin-assets/dist/img/default.png') }}">
                                                        @endif
                                                        <b>{{ $data->patients->full_name }}</b>
                                                    </td>
                                                    <td>{{ $data->start_time }}</td>
                                                    <td>{{ $data->schedule->day }}</td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- /.row -->
    </div>

    </div>
    <!-- /.row (main row) -->
@endsection

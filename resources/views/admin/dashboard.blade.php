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

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Today's Appointment List</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> &nbsp;All upcoming appointments
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($appt_today as $data)
                                @if ($data->schedule->day == Carbon\Carbon::now()->format('m/d/Y'))
                                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                        <p class="d-flex flex-column">
                                            <span class="font-weight-bold">
                                                {{ $data->schedule->day }}
                                                {{ $data->patient->full_name }} <span class="fw-light">
                                                    ({{ $data->start_time . ' -  ' . $data->end_time }})
                                                </span>
                                            </span>
                                            <span class="text-primary text-uppercase">{{ $data->clinic->name }}</span>
                                            <span class="fw-lighter">{{ $data->doctor->full_name }}</span>
                                        </p>
                                        <p class="text-success text-right">
                                            <span class="right badge badge-light">{{ $data->status }}</span>
                                        </p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div>

    </div>
    <!-- /.row (main row) -->
@endsection

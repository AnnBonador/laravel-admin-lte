@extends('layouts.user')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Appointment Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Appointment Details</li>
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

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header"> Details
                            <a href="{{ route('user.dashboard') }}" class="btn btn-danger btn-sm float-right">Back</a>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Date:
                                            <span class="fw-normal">
                                                {{ \Carbon\Carbon::parse($events->schedule->day)->toFormattedDateString() }}
                                            </span>
                                        </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Time:
                                            <span class="fw-normal">
                                                {{ $events->start_time }}
                                            </span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Doctor:
                                            <span class="fw-normal">
                                                {{ $events->doctors->full_name }}
                                            </span>
                                        </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Patient:
                                            <span class="fw-normal">
                                                {{ $events->patients->full_name }}
                                            </span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Clinic:
                                            <span class="fw-normal">
                                                {{ $events->clinic->name }}
                                            </span>
                                        </strong>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Status:
                                            <span class="fw-normal">
                                                @if ($events->status == 'Booked')
                                                    <span class="text-success">{{ $events->status }}</span>
                                                @elseif ($events->status == 'Check in')
                                                    <span class="text-danger">{{ $events->status }}</span>
                                                @elseif ($events->status == 'Check out')
                                                    <span class="text-info">{{ $events->status }}</span>
                                                @elseif ($events->status == 'Completed')
                                                    <span class="text-primary">{{ $events->status }}</span>
                                                @endif
                                            </span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <strong>Service:
                                            <span class="fw-normal">
                                                @foreach ($events->services as $service)
                                                    {{ $service->name }}
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </span>
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row (main row) -->
@endsection

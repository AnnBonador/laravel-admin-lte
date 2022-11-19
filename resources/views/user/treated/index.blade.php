@extends('layouts.user')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Treated</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Treated</li>
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
                            <h3 class="card-title">Treated</h3>
                        </div>
                        <div class="card-body">
                            <table id="table1" class="table table-borderless table-hover" style="width:100%;">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Appointment</th>
                                        <th>Appointment Fee</th>
                                        <th>Teeth</th>
                                        <th>Problem</th>
                                        <th>Fee</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($treated as $data)
                                        <tr>
                                            <td>
                                                <b>{{ $data->appointment->patients->full_name }}</b><br>
                                                Doctor: {{ $data->appointment->doctors->full_name }}<br>
                                                Clinic: {{ $data->appointment->clinic->name }}<br>
                                                Service: {{ implode(', ', $data->appointment->service) }}
                                            </td>
                                            <td>
                                                @if ($data->appointment->payment_option == 'Paypal')
                                                    <span class="badge badge-success">Paid by Paypal</span>
                                                @else
                                                    <span class="badge badge-warning">Paid by Cash</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $data->teeth }}
                                            </td>
                                            <td>
                                                {{ $data->problem }}
                                            </td>
                                            <td>
                                                {{ $data->fee }}
                                            </td>
                                            <td>
                                                {{ $data->remarks }}
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
@endsection

@extends('layouts.user')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payments</li>
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
                            <h3 class="card-title">Payment History</h3>
                        </div>
                        <div class="card-body">
                            <table id="table1" class="table table-borderless table-hover" style="width:100%;">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Paid On</th>
                                        <th>Clinic</th>
                                        <th>Doctor</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment as $data)
                                        <tr>
                                            <td>{{ Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</td>
                                            <td>{{ $data->appointment->clinic->name }}</td>
                                            <td>{{ $data->appointment->doctors->full_name }}</td>
                                            <td>₱{{ number_format($data->amount, 2, '.', ',') }}</td>
                                            <td>
                                                <a href="{{ route('payments.show', $data->id) }}"
                                                    class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('payments.print', $data->id) }}"
                                                    class="btn btn-sm btn-default"><i class="fas fa-print"></i></a>
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

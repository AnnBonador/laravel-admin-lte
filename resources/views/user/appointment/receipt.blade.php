@extends('layouts.user')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Invoice View</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Invoice View</li>
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
                <div class="col-lg-8 offset-lg-2">
                    <div class="card">
                        {{-- @foreach ($invoice as $data)
                            <div class="card-body">
                                <div class="invoice-content">
                                    <div class="invoice-item">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="invoice-logo">
                                                    <h3>{{ $data->appointment->clinic->name }}</h3>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-right">
                                                    <strong>Order :</strong> #{{ $data->invoice }}<br>
                                                    <strong>Issued:</strong>
                                                    {{ \carbon\Carbon::parse($data->created_at)->format('m/d/Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Invoice Item -->
                                    <div class="invoice-item">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="invoice-info">
                                                    <strong class="customer-text">Invoice From</strong>
                                                    <p class="invoice-details invoice-details-two">
                                                        {{ $data->appointment->doctors->full_name }} <br>
                                                        {{ $data->appointment->doctors->address }}<br>
                                                        {{ $data->appointment->doctors->city . ', ' . $data->appointment->doctors->country }}
                                                        <br>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-right">
                                                    <strong class="customer-text">Invoice To</strong>
                                                    <p class="invoice-details">
                                                        {{ $data->appointment->patients->full_name }} <br>
                                                        {{ $data->appointment->patients->adress }} <br>
                                                        {{ $data->appointment->patients->city . ', ' . $data->appointment->patients->country }}
                                                        <br>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Invoice Item -->

                                    <!-- Invoice Item -->
                                    <div class="invoice-item">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="invoice-info">
                                                    <strong class="customer-text">Payment Method</strong>
                                                    <p class="invoice-details invoice-details-two">
                                                        {{ $data->appointment->payment_option }} <br>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Invoice Item -->

                                    <!-- Invoice Item -->
                                    <div class="invoice-item invoice-table-wrap">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="invoice-table table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Description</th>
                                                                <th class="text-right">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data->appointment->services as $service)
                                                                <tr>
                                                                    <td>{{ $service->name }}</td>
                                                                    <td class="text-right">
                                                                        ₱
                                                                        {{ number_format($service->charges, 2, '.', ',') }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4 ml-auto">
                                                <div class="table-responsive">
                                                    <table class="invoice-table-two table">
                                                        <tbody>
                                                            <tr>
                                                                <th>Total Amount:</th>
                                                                <td><span>{{ number_format($data->appointment->services()->sum('charges'), 2, '.', ',') }}</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Invoice Item -->

                                </div>
                            </div>
                        @endforeach --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row (main row) -->
@endsection

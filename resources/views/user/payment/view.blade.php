@extends('layouts.user')

@section('body')
    <!-- Main row -->
    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 mt-2 mb-2">
                    <a href="{{ route('payments') }}" class="btn btn-sm btn-danger float-right">
                        Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card">
                        @foreach ($payment as $data)
                            <div class="card-body">
                                <div class="invoice-content">
                                    <div class="invoice-item">
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <div class="invoice-logo text-center">
                                                    <h3>{{ $data->appointment->clinic->name }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Invoice Item -->
                                    <div class="invoice-item">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="invoice-info">
                                                    <p class="invoice-details invoice-details-two">
                                                        <b>Name</b>: {{ $data->appointment->patients->full_name }} <br>
                                                        <b>Email</b>: {{ $data->appointment->patients->email }}<br>
                                                        <b>Doctor</b>: {{ $data->appointment->doctors->full_name }}
                                                        <br>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-right">
                                                    <p class="invoice-details">
                                                        <strong>Reference:</strong> #{{ $data->reference_no }}<br>
                                                        <strong>Date:</strong>
                                                        {{ \carbon\Carbon::parse($data->created_at)->format('m/d/Y') }}<br>
                                                        <strong>Time:</strong>
                                                        {{ \carbon\Carbon::parse($data->created_at)->format('g:i A') }}
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
                                                                <th class="text-right">Amount</th>
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
                                                            <tr>
                                                                <th>Amount Paid:</th>
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row (main row) -->
@endsection

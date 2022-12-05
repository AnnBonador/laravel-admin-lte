<!DOCTYPE html>
<html lang="en">

<!-- doccure/invoice-view.html  30 Nov 2019 04:12:19 GMT -->

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/adminlte.min.css') }}">
</head>

<body>

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-l2 p-4">
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
    <!-- /Page Content -->

    <script>
        window.addEventListener("load", window.print());
    </script>
</body>
<!-- Bootstrap 5 -->

</html>

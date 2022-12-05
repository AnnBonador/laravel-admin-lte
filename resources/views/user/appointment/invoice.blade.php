<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Payment Receipt</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 20px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table>
            @foreach ($invoice_no as $data)
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <h3>{{ $data->appointment->clinic->name }}</h3>
                                </td>

                                <td>
                                    <b>Reference</b>: #{{ $data->reference_no }}<br />
                                    <b>Date</b>:{{ \carbon\Carbon::parse($data->created_at)->format('m/d/Y') }}<br />
                                    <b>Time</b>:{{ \carbon\Carbon::parse($data->created_at)->format('g:i A') }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    {{ $data->appointment->patients->full_name }} <br>
                                    {{ $data->appointment->patients->email }}<br>
                                </td>

                                <td>
                                    {{ $data->appointment->doctors->full_name }}
                                    {{ $data->appointment->doctors->address }} <br>
                                    {{ $data->appointment->doctors->city . ', ' . $data->appointment->doctors->country }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">
                    <td>Payment Method</td>
                    <td></td>
                </tr>

                <tr class="item">
                    <td>{{ $data->appointment->payment_option }}</td>
                    <td></td>
                </tr>

                <tr class="heading">
                    <td>Description</td>

                    <td>Price</td>
                </tr>
                @foreach ($data->appointment->services as $service)
                    <tr class="item">
                        <td>{{ $service->name }}</td>
                        <td class="text-right">
                            ₱
                            {{ number_format($service->charges, 2, '.', ',') }}
                        </td>
                    </tr>
                @endforeach


                <tr class="total">
                    <td></td>

                    <td>Total: ₱
                        {{ number_format($data->appointment->services()->sum('charges'), 2, '.', ',') }}</td>
                </tr>
                <tr class="total">
                    <td></td>

                    <td>Amount Paid: ₱
                        {{ number_format($data->appointment->services()->sum('charges'), 2, '.', ',') }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prescription-{{ $prescription->patients->lname }}</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/adminlte.min.css?v=3.2.0') }}">

    <style>
        .devicer {
            width: 95%;
            display: block;
            height: 5px;
            background-color: #80BDFF;
            margin: 15px auto 0;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <section class="">

            <div class="row py-2">
                <div class="col-12">
                    <h2 class="page-header text-center text-primary">
                        {{ $prescription->clinic->name }}
                    </h2>
                </div>

            </div>

            <div class="row px-5">
                <div class="col-8">
                    {{ $prescription->doctors->full_name }}
                    <address>
                        <strong> {{ $prescription->clinic->address }}</strong><br>
                        {{ $prescription->clinic->city . ', ' . $prescription->clinic->country }}<br>
                        {{ $prescription->clinic->contact }}<br>
                    </address>
                </div>
            </div>

            <hr class="devicer">
            <div class="row px-5 mt-4">
                <div class="col-8">
                    Name: {{ $prescription->patients->full_name }} <br>
                    Address: {{ $prescription->patients->address }}
                </div>
                <div class="col-4">
                    Gender: {{ $prescription->patients->gender }} <br>
                    Date: {{ \Carbon\Carbon::parse($prescription->created_at)->toDateString() }}
                </div>
            </div>
            <div class="row m-5 mt-4">
                <div class="col-2">
                    <img src="{{ asset('admin-assets/dist/img/prescriptionLogo.png') }}" width="100$" alt="">
                </div>
                <div class="col-10">
                    {{ $prescription->medicine_name }}<br>
                    <strong>{{ $prescription->frequency . ' ' . $prescription->duration }}</strong><br>
                    <div class="mt-4">

                        {{ $prescription->instruction }}
                    </div>
                </div>
            </div>
            <div class="row" style="margin:50px;">
                Doctor Signature:
            </div>

        </section>

    </div>

    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>

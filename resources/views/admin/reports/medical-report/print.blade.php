<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medical Report</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin-assets/dist/css/adminlte.min.css?v=3.2.0') }}">
</head>

<body>
    <div class="wrapper">

        <div class="row justify-content-center mt-4">

            <div class="col-6">
                <p class="lead">
                    Medical Report - @foreach ($date_sub as $data)
                        {{ $data }}
                    @endforeach
                </p>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Patient Registration</th>
                            <td>{{ $results_patients }}</td>
                        </tr>
                        <tr>
                            <th>Number Of Appointment Treated</th>
                            <td>{{ $results_treated }}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>


    </div>


    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>

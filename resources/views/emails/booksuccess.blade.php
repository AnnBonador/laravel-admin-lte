<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Email</title>
</head>

<body>
    <p>Appointment booked Successfully!</p>
    @if ($mailData['status'] == 'Cancelled')
        Your appointment booking of {{ $mailData['day'] . ' ' . $mailData['start_time'] }} has been cancelled.
    @else
        <p>Appointment booked with <b>{{ $mailData['name'] }}</b>
            on <b>{{ \Carbon\Carbon::parse($mailData['day'])->toFormattedDateString() . ' ' . $mailData['start_time'] . ' to ' . $mailData['end_time'] }}
            </b></p>
    @endif
    <p>Thank you.</p>
</body>

</html>

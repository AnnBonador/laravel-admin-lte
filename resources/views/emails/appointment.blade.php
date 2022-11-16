<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Email</title>
</head>

<body>
    <p>Greetings {{ $mailData['name'] }},</p>
    @if ($mailData['status'] == 'Cancelled')
        Your appointment booking of {{ $mailData['day'] . ' ' . $mailData['start_time'] }} has been cancelled.
    @else
        <p>Your appointment has been booked successfully on {{ $mailData['day'] . ' ' . $mailData['start_time'] }}.</p>
    @endif
    <p>Thank you.</p>
</body>

</html>

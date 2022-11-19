<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Email</title>
</head>

<body>
    <p>Welcome to Clinic,</p>
    <p>You are successfully registered as clinic admin</p>
    <p>Your email: {{ $mailData['email'] }}, and password: {{ $mailData['password'] }} </p>
    <p>Thank you.</p>
</body>

</html>

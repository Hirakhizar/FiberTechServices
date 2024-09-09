<!DOCTYPE html>
<html>
<head>
    <title>Service Inquiry</title>
</head>
<body>
    <h1>Thank You, {{ $data['first_name'] }} {{ $data['last_name'] }}!</h1>
    <p>We received your inquiry with the following details:</p>

    <ul>
        <li>Email: {{ $data['email'] }}</li>
        <li>Phone: {{ $data['phone'] }}</li>
        <li>Message: {{ $data['message'] }}</li>
    </ul>

    <p>We will get back to you soon!</p>
</body>
</html>

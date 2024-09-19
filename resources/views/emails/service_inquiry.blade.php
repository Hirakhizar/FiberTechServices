<!DOCTYPE html>
<html>
<head>
    <title>Service Inquiry</title>
</head>
<body>
    <h1>New Service Inquiry</h1>
    <p>You have received a new inquiry with the following details:</p>

    <ul>
        <li>Name: {{ $data['first_name'] }} {{ $data['last_name'] }}</li>
        <li>Email: {{ $data['email'] }}</li>
        <li>Phone: {{ $data['phone'] }}</li>
        <li>Message: {{ $data['message'] }}</li>
    </ul>

    <p>Please follow up with the customer as soon as possible.</p>
</body>
</html>

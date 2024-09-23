<!DOCTYPE html>
<html>
<head>
    <title>New Quote Request</title>
</head>
<body>
    <h1>New Quote Request</h1>
    <p>Dear Admin,</p>
    <p>You have received a new request for a quote. Here are the details:</p>
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">First Name:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['first_name'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Last Name:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['last_name'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Email:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['email'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Requested Service:</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['service_name'] }}</td>
        </tr>
    </table>
    <p>Thank you for your attention to this request.</p>
    <p>Best regards,</p>
    <p>Fiber Tech Services</p>
</body>
</html>


<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Future Taikun</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .email-header {
            background-color: #003366;
            color: #fff;
            padding: 20px 30px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }

        .email-body {
            padding: 30px;
        }

        .email-footer {
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }

        .login-details {
            background-color: #f1f5f9;
            padding: 15px 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .login-details li {
            margin-bottom: 10px;
        }

        strong {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h2>Welcome to Future Taikun</h2>
        </div>
        <div class="email-body">
            <p>Dear {{ $name }},</p>

            <p><strong>Thank you for registering with Future Taikun</strong>.</p>

            <p>Here are your login details:</p>

            <div class="login-details">
                <ul style="list-style: none; padding: 0;">
                    <li><strong>Email:</strong> {{ $email }}</li>
                    <li><strong>Password:</strong> {{ $password }}</li>
                </ul>
            </div>

            <p>Your registration approval is currently pending. If there are any queries, the Future Taikun team will inform you 
            otherwise, your registration will be approved.</p>

            <p><strong>Please keep this information secure. You can now log in and continue your journey with us.</strong></p>

            <p><strong>Warm regards,<br>Future Taikun Team</strong></p>
        </div>
        <div class="email-footer">
            © {{ date('Y') }} Future Taikun. All rights reserved.
        </div>
    </div>
</body>

</html>
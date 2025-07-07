<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Entrepreneur Profile Has Been Rejected</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #003087;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            margin: -20px -20px 20px -20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            color: #333333;
            line-height: 1.6;
        }

        .content p {
            margin: 10px 0;
        }

        .content strong {
            color: #003087;
        }

        .footer {
            text-align: center;
            color: #666666;
            margin-top: 20px;
            font-size: 12px;
        }

        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Your Entrepreneur Profile Has Been Rejected</h1>
        </div>
        <div class="content">
            <p>Dear {{ $entrepreneur->user->name }},</p>

            <p>We regret to inform you that your entrepreneur profile has been rejected by one of our investors.</p>

            <h2>Reason for Rejection:</h2>
            <p>{{ $reason }}</p>

            <p>Please review the feedback and make necessary improvements to your profile. If you have any questions,
                feel free to contact us at <a href="mailto:support@futuretaikun.com"
                    style="color: #00c4cc; text-decoration: none;">support@futuretaikun.com</a>.</p>

            <p>Best regards,<br>
                Future Taikun Team</p>
        </div>
        <div class="footer">
            <p>This email was sent on {{ now()->format('g:i A T, l, F d, Y') }}. Please do not reply to this email.</p>
        </div>
    </div>
</body>

</html>
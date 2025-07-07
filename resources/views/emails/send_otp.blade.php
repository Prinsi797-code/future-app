<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .email-header h2 {
            color: #333;
            margin: 0;
        }

        .email-body {
            font-size: 16px;
            color: #444;
            line-height: 1.6;
        }

        .otp-box {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            background-color: #f0f0f0;
            padding: 12px 20px;
            text-align: center;
            border-radius: 6px;
            margin: 20px 0;
            letter-spacing: 2px;
        }

        .email-footer {
            margin-top: 30px;
            font-size: 13px;
            color: #888;
            text-align: center;
        }

        @media (max-width: 640px) {
            .email-wrapper {
                padding: 20px;
            }

            .otp-box {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-header">
            <h2>Your OTP Verification Code</h2>
        </div>
        <div class="email-body">
            <p>Dear User,</p>
            <p>Your One-Time Password (OTP) for verification is:</p>
            <div class="otp-box">
                {{ $otp }}
            </div>
            <p>Please use this code within 10 minutes to complete your verification.</p>
            <p>If you did not request this, you can ignore this email.</p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} YourAppName. All rights reserved.
        </div>
    </div>
</body>

</html>
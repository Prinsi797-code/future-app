<!DOCTYPE html>
<html>

<head>
    <title>Remark on Your Idea</title>
    <style type="text/css">
        /* Inline CSS for better email client support */
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
        }

        .header {
            background-color: #003366;
            color: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 5px 5px 0 0;
        }

        .content {
            padding: 20px;
        }

        .details-box {
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            padding: 10px 0;
            border-top: 1px solid #eee;
        }
    </style>
</head>

<body>
    <table class="container" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td class="header">
                <h1>Remark on Your Idea</h1>
            </td>
        </tr>
        <tr>
            <td class="content">
                <p>Dear {{ $entrepreneur->name ?? 'Entrepreneur' }},</p>
                <p>An investor has reviewed your idea and provided the following remarks:</p>
                <p>While the investor is interested in your idea, they have concerns about the proposed equity. They
                    suggest the following:</p>
                <div class="details-box">
                    <ul>
                        <li><strong>Investment (Market Capital):</strong>
                            ${{ number_format($remarkData['remark_market_capital'], 2) }}</li>
                        <li><strong>Proposed Equity Stake:</strong> {{ $remarkData['remark_your_stake'] }}%</li>
                        <li><strong>Company Valuation:</strong>
                            ${{ number_format($remarkData['remark_company_value'], 2) }}</li>
                        <li><strong>Reason for Remark:</strong> {{ $remarkData['remark_reason'] }}</li>
                    </ul>
                </div>
                <p>Please review these remarks and consider adjusting your proposal accordingly.</p>
                <p>Best regards,<br>Your Investment Platform Team</p>
            </td>
        </tr>
        <tr>
            <td class="footer">
                <p>© 2025 Future Taikun. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>

</html>

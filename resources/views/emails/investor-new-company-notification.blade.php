<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Company Added - {{ $companyName }}</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #333;
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f8f9fa;
    }

    .email-container {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
        padding: 20px;
        background: #003366;
        color: white;
        border-radius: 8px;
    }

    .header h1 {
        color: white;
        margin: 0;
        font-size: 24px;
    }

    .header p {
        margin: 10px 0 0 0;
        color: rgba(255, 255, 255, 0.8);
    }

    .company-details {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
    }

    .company-details h2 {
        color: #333;
        margin-top: 0;
        margin-bottom: 15px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        margin: 10px 0;
        padding: 8px 0;
        border-bottom: 1px solid #dee2e6;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .label {
        font-weight: bold;
        color: #495057;
        flex: 1;
    }

    .value {
        flex: 2;
        text-align: right;
        color: #007bff;
        font-weight: 500;
    }

    .entrepreneur-info {
        background: #e7f3ff;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }

    .entrepreneur-info h3 {
        color: #333;
        margin-top: 0;
        margin-bottom: 15px;
    }

    .entrepreneur-info p {
        margin: 8px 0;
        color: #555;
    }

    .footer {
        text-align: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #dee2e6;
        color: #6c757d;
        font-size: 12px;
    }

    .alert {
        background: #d1ecf1;
        color: #0c5460;
        padding: 15px;
        border-radius: 5px;
        margin: 20px 0;
        border-left: 4px solid #bee5eb;
    }

    @media (max-width: 600px) {
        .detail-row {
            flex-direction: column;
        }

        .value {
            text-align: left;
            margin-top: 5px;
        }
    }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>🏢 New Company Added</h1>
            <p style="margin: 10px 0; color: #6c757d;">{{ $dateAdded }}</p>
        </div>

        <div class="alert">
            <strong>Alert:</strong> A new company has been registered on the platform by an Investor.
        </div>

        <div class="company-details">
            <h2>Company Information</h2>

            <div class="detail-row">
                <span class="label">Company Name:</span>
                <span class="value">{{ $companyName }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Fund:</span>
                <span class="value">₹{{ number_format($marketCapital, 2) }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Equity:</span>
                <span class="value">{{ $yourStake }}%</span>
            </div>

            <div class="detail-row">
                <span class="label">Valuation:</span>
                <span class="value">₹{{ number_format($stakeFunding, 2) }}</span>
            </div>
        </div>

        <div class="entrepreneur-info">
            <h3>Entrepreneur Details</h3>
            <p><strong>Name:</strong> {{ $investorName }}</p>
            <p><strong>Email:</strong> {{ $investorEmail }}</p>
        </div>

        <div class="footer">
            <p>This is an automated notification from Future Taikun Platform</p>
            <p>© {{ date('Y') }} Future Taikun. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Investor Interest Notification</title>
    <meta charset="UTF-8">
</head>

<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 30px 0;">
        <tr>
            <td>
                <table align="center" width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); overflow: hidden;">
                    <tr>
                        <td style="background-color: #003366; padding: 20px 30px;">
                            <h2 style="color: #ffffff; margin: 0;">Future Taikun</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px;">
                            <p style="font-size: 16px; color: #333;">Dear Entrepreneur,</p>
                            @if ($offer_type === 'same')
                                <p style="font-size: 16px; color: #333; line-height: 1.6;">
                                    We’re excited to inform you that an investor named
                                    <strong>{{ $investorName }}</strong> has shown interest in your startup idea with
                                    the following details:
                                </p>
                                <ul style="font-size: 16px; color: #333; line-height: 1.6;">
                                    <li><strong>Fund Offered:</strong> {{ $country === 'IN' ? '₹' : '$' }}
                                        {{ number_format($market_capital, 2) }}</li>
                                    <li><strong>Equity Asked:</strong> {{ $your_stake }}%</li>
                                    <li><strong>Valuation Considered:</strong>
                                        {{ $country === 'IN' ? '₹' : '$' }}{{ number_format($company_value, 2) }}
                                    </li>
                                    <li><strong>Reason:</strong> {{ $remark_reason }}</li>
                                </ul>
                            @else
                                <p style="font-size: 16px; color: #333; line-height: 1.6;">
                                    An investor named <strong>{{ $investorName }}</strong> is not interested in your
                                    current offer but has proposed a counter offer with the following details:
                                </p>
                                <ul style="font-size: 16px; color: #333; line-height: 1.6;">
                                    <li><strong>Counter Fund Offered:</strong>
                                        {{ $country === 'IN' ? '₹' : '$' }}{{ number_format($counter_market_capital, 2) }}
                                    </li>
                                    <li><strong>Counter Equity Asked:</strong> {{ $counter_your_stake }}%</li>
                                    <li><strong>Counter Valuation Considered:</strong>
                                        {{ $country === 'IN' ? '₹' : '$' }}
                                        {{ number_format($counter_company_value, 2) }}</li>
                                    <li><strong>Reason:</strong> {{ $counter_reason }}</li>
                                </ul>
                            @endif
                            <p style="font-size: 16px; color: #333; line-height: 1.6;">
                                Our team at <strong>Future Taikun</strong> will be connecting with you shortly to
                                discuss potential opportunities and next steps.
                            </p>
                            <p style="font-size: 16px; color: #333; line-height: 1.6;">Stay tuned!</p>
                            <p style="font-size: 16px; color: #333; margin-top: 40px;">
                                Best regards,<br>
                                <strong>Future Taikun Team</strong>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="background-color: #f1f1f1; padding: 15px 30px; text-align: center; font-size: 14px; color: #777;">
                            © {{ date('Y') }} Future Taikun. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>

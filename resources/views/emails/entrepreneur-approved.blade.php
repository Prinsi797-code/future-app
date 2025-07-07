<!DOCTYPE html>
<html>

<head>
    <title>Profile Verification Completed</title>
    <meta charset="UTF-8">
</head>

<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color: #f4f4f4;">

    <table align="center" width="100%" cellpadding="0" cellspacing="0"
        style="background-color: #f4f4f4; padding: 30px 0;">
        <tr>
            <td>
                <table align="center" width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden;">
                    <tr>
                        <td style="background-color: #003366; padding: 20px 30px;">
                            <h2 style="color: #ffffff; margin: 0;">Future Taikun</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px;">
                            <p style="font-size: 16px; color: #333;">Dear {{ $entrepreneur->full_name }},</p>

                            <p style="font-size: 16px; color: #333; line-height: 1.6;">I hope this message finds you
                                well.</p>

                            <p style="font-size: 16px; color: #333; line-height: 1.6;">
                                We are pleased to inform you that your profile verification has been successfully
                                completed.
                            </p>

                            <p style="font-size: 16px; color: #333; line-height: 1.6;">
                                Our team is currently in the process of matching you with a suitable investor. You can
                                expect to be contacted shortly for the next steps.
                            </p>

                            <p style="font-size: 16px; color: #333; line-height: 1.6;">
                                Thank you for your patience and trust in our platform. We are excited to support your
                                entrepreneurial journey.
                            </p>

                            <p style="font-size: 16px; color: #333; line-height: 1.6;">
                                If you have any questions or need further assistance, please feel free to reach out.
                            </p>

                            <p style="font-size: 16px; color: #333; margin-top: 40px;">
                                Warm regards,<br>
                                <strong>Future Taikun</strong>
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
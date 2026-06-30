<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>THK Email Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            display: block;
            margin: 0 auto;
            max-width: 200px;
        }

        .content {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }

        .content h1 {
            font-size: 20px;
            color: #222;
        }

        .content a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        .button-link {
            display: inline-block;
            background-color: #007BFF;
            color: #ffffff !important;
            padding: 12px 24px;
            margin-top: 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    @if ($isEmpty)
        {{-- Default view jika semua value kosong --}}
        <div class="email-container">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" style="padding:0;">
                        <img src="https://registration.uid.or.id/assets/img/registration/uid.png" alt="Logo"
                            width="250"
                            style="display:block;border:0;outline:none;text-decoration:none;
                                    max-width:400px;width:100%;height:auto;margin-right:10px;">
                    </td>
                </tr>
            </table>

            <div class="content">
                <p style="text-align: justify;"><strong>Thank you for your registration</strong></p>
                <p style="text-align: justify;">
                    We will be sending a confirmation of your registration with further details closer to date.
                    Meanwhile, should you have any questions, please do not hesitate to contact United In Diversity
                    at email: <a href="mailto:contact@uid.or.id">contact@uid.or.id</a>
                </p>
                <p>Yours sincerely, <br> United In Diversity</p>
                <div class="footer"><strong>United In Diversity</strong></div>
            </div>
        </div>
    @else
        <div class="email-container">
            {{-- <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" style="padding:0;">
                        <img src="https://registration.uid.or.id/assets/img/registration/thkgbfaundp.png" alt="Logo"
                            width="250"
                            style="display:block;border:0;outline:none;text-decoration:none;
                                    max-width:400px;width:100%;height:auto;">
                    </td>
                </tr>
            </table> --}}

            <div class="content">
                <p><strong>Dear {{ $namefull }},</strong></p>
                <p style="text-align: justify;"><strong>{{ $subject ?? 'No Subject Provided' }}</strong></p>
                <p>{!! $description ?? 'No description provided' !!}</p>
            </div>
        </div>

        @if (!empty($fileUrl))
            <p>Attachment: {{ basename($fileUrl) }}</p>
        @endif
    @endif
</body>

</html>

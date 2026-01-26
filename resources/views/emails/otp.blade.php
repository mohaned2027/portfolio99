<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="x-apple-disable-message-reformatting">
        <title>{{ $companyName ?? config('app.name') }} - OTP Code</title>

        <style>
            body, table, td, a { -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; }
            table { border-collapse:collapse !important; }
            img { border:0; outline:none; text-decoration:none; -ms-interpolation-mode:bicubic; display:block; }
            .wrapper { width:100%; background:#0b0f17; }
            .container { width:100%; max-width:600px; }
            .card { border-radius:18px; overflow:hidden; border:1px solid #232a36; background:#141923; }
            .header { background:#1b202b; border-bottom:1px solid #242b38; }
            .footer { background:#0f141f; border-top:1px solid #1e2431; }

            .p-outer { padding:28px 16px; }
            .p-head { padding:22px 26px; }
            .p-body { padding:26px; }
            .p-foot { padding:18px 26px; }

            .brand { font-size:18px; font-weight:700; color:#f3f5f8; letter-spacing:.2px; margin:0; }
            .badge { font-size:12px; color:#aeb6c5; letter-spacing:.6px; text-transform:uppercase; margin:2px 0 0 0; }
            .muted { font-size:12px; color:#7f8aa0; line-height:1.6; }

            .title { font-size:22px; font-weight:700; color:#f6c343; margin:0 0 8px 0; }
            .sub { font-size:14px; color:#c9d2e3; line-height:1.7; margin:0 0 18px 0; }

            .box { width:100%; background:#111722; border:1px solid #262d3b; border-radius:14px; overflow:hidden; }
            .boxcell { padding:16px 18px; }
            .divider { border-bottom:1px solid #1f2633; }

            .label { font-size:12px; color:#7f8aa0; text-transform:uppercase; letter-spacing:.6px; }
            .note { font-size:13px; color:#b6c0d2; line-height:1.7; margin-top:8px; }
            .warn { font-size:13px; color:#f0b4b4; line-height:1.7; margin-top:10px; }

            .otp-wrap { padding:18px; text-align:center; }
            .otp {
                display:inline-block;
                font-size:28px;
                font-weight:800;
                letter-spacing:8px;
                color:#0b0f17;
                background:#f6c343;
                padding:12px 16px;
                border-radius:14px;
                border:1px solid rgba(255,255,255,.08);
                font-family: Arial, Helvetica, sans-serif;
            }
            .otp-hint { font-size:12px; color:#7f8aa0; margin-top:10px; }

            .btn {
                display:inline-block;
                background:#f6c343;
                color:#0b0f17 !important;
                text-decoration:none;
                padding:12px 16px;
                border-radius:12px;
                font-weight:800;
                font-size:13px;
            }
            .btn-secondary {
                display:inline-block;
                background:#111722;
                color:#9cc6ff !important;
                text-decoration:none;
                padding:12px 16px;
                border-radius:12px;
                border:1px solid #262d3b;
                font-weight:700;
                font-size:13px;
            }

            @media screen and (max-width: 600px) {
                .p-outer { padding:18px 12px !important; }
                .p-head, .p-body, .p-foot { padding:18px 16px !important; }
                .title { font-size:20px !important; }
                .brand { font-size:17px !important; }
                .otp { font-size:26px !important; letter-spacing:6px !important; }
                .stack { display:block !important; width:100% !important; }
                .text-right { text-align:left !important; padding-top:10px !important; }
                .btn, .btn-secondary { display:block !important; text-align:center !important; width:100% !important; box-sizing:border-box !important; }
            }
        </style>
    </head>

    <body style="margin:0;padding:0;background:#0b0f17;color:#e9eef6;font-family:Arial, Helvetica, sans-serif;">
        <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">
            Your OTP code is {{ $otp }}. Expires in {{ $minutes ?? 10 }} minutes.
        </div>

        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" class="wrapper">
            <tr>
                <td align="center" class="p-outer">
                    <table role="presentation" cellpadding="0" cellspacing="0" width="600" class="container card">
                        <tr>
                            <td class="p-head header">
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="stack" style="vertical-align:middle;">
                                            <table role="presentation" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td style="padding-right:12px;vertical-align:middle;">
                                                        @php
                                                            $brandName = $companyName ?? config('app.name');
                                                            $logo = $faviconUrl ?? null;
                                                        @endphp

                                                        @if (!empty($logo))
                                                            <img src="{{ $logo }}" width="42" height="42" alt="{{ $brandName }} logo"
                                                                 style="border-radius:10px;border:1px solid #2b3341;background:#0f1420;">
                                                        @else
                                                            <div style="width:42px;height:42px;border-radius:10px;border:1px solid #2b3341;background:#0f1420;
                                                                color:#f3f5f8;line-height:42px;text-align:center;font-size:12px;font-weight:800;">
                                                                {{ strtoupper(substr($brandName, 0, 2)) }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        <p class="brand">{{ $brandName }}</p>
                                                        <p class="badge">OTP Verification</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td class="stack text-right" align="right" style="vertical-align:middle;">
                                            <div class="muted">{{ now()->format('M d, Y H:i') }}</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="p-body">
                                <p class="title">Your Verification Code</p>
                                <p class="sub">
                                    Use this OTP to complete your action. This code will expire in
                                    <strong style="color:#f3f5f8;">{{ $minutes ?? 10 }} minutes</strong>.
                                </p>

                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" class="box">
                                    <tr>
                                        <td class="otp-wrap divider">
                                            <div class="label">One-Time Password (OTP)</div>
                                            <div style="padding-top:12px;">
                                                <span class="otp">{{ $otp }}</span>
                                            </div>
                                            <div class="otp-hint">
                                                Do not share this code with anyone.
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="boxcell">
                                            <div class="label">Security Note</div>
                                            <div class="note">
                                                If you didn’t request this code, you can safely ignore this email.
                                                Someone may have entered your email by mistake.
                                            </div>

                                            <div class="warn">
                                                Never share your OTP or password with anyone (even support).
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                                @if (!empty($actionUrl))
                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:16px;">
                                        <tr>
                                            <td>
                                                <a class="btn" href="{{ $actionUrl }}">Continue</a>
                                            </td>
                                        </tr>
                                    </table>
                                @endif

                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:14px;">
                                    <tr>
                                        <td class="muted">
                                            This message was sent to: <span style="color:#c9d2e3;">{{ $email ?? 'your email' }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="p-foot footer">
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="muted">Sent from {{ $brandName }}</td>
                                        <td align="right" class="muted">{{ config('app.url') }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title>{{ $companyName }} - Contact Us</title>

    <style>
        /* Base resets for better email rendering */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table {
            border-collapse: collapse !important;
        }

        img {
            border: 0;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
            display: block;
        }

        .wrapper {
            width: 100%;
            background: #0b0f17;
        }

        .container {
            width: 100%;
            max-width: 600px;
        }

        .card {
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #232a36;
            background: #141923;
        }

        .header {
            background: #1b202b;
            border-bottom: 1px solid #242b38;
        }

        .footer {
            background: #0f141f;
            border-top: 1px solid #1e2431;
        }

        .p-outer {
            padding: 28px 16px;
        }

        .p-head {
            padding: 22px 26px;
        }

        .p-body {
            padding: 26px;
        }

        .p-foot {
            padding: 18px 26px;
        }

        .title {
            font-size: 22px;
            font-weight: 700;
            color: #f6c343;
            margin: 0 0 8px 0;
        }

        .sub {
            font-size: 14px;
            color: #c9d2e3;
            line-height: 1.7;
            margin: 0 0 18px 0;
        }

        .muted {
            font-size: 12px;
            color: #7f8aa0;
            line-height: 1.6;
        }

        .brand {
            font-size: 18px;
            font-weight: 700;
            color: #f3f5f8;
            letter-spacing: .2px;
            margin: 0;
        }

        .badge {
            font-size: 12px;
            color: #aeb6c5;
            letter-spacing: .6px;
            text-transform: uppercase;
            margin: 2px 0 0 0;
        }

        .box {
            width: 100%;
            background: #111722;
            border: 1px solid #262d3b;
            border-radius: 14px;
            overflow: hidden;
        }

        .boxcell {
            padding: 16px 18px;
        }

        .divider {
            border-bottom: 1px solid #1f2633;
        }

        .label {
            font-size: 12px;
            color: #7f8aa0;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .value-lg {
            font-size: 16px;
            color: #f3f5f8;
            font-weight: 600;
            margin-top: 4px;
        }

        .value {
            font-size: 15px;
            color: #f0f3f9;
            margin-top: 6px;
            line-height: 1.6;
            word-break: break-word;
        }

        .value-sm {
            font-size: 13px;
            color: #b6c0d2;
            margin-top: 4px;
            word-break: break-word;
        }

        .msg {
            font-size: 14px;
            color: #d7def0;
            margin-top: 8px;
            line-height: 1.7;
            word-break: break-word;
        }

        .link {
            color: #9cc6ff;
            text-decoration: none;
        }

        .btn {
            display: inline-block;
            background: #f6c343;
            color: #0b0f17;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 13px;
        }

        .btn-wrap {
            padding-top: 14px;
        }

        /* Mobile */
        @media screen and (max-width: 600px) {
            .p-outer {
                padding: 18px 12px !important;
            }

            .p-head,
            .p-body,
            .p-foot {
                padding: 18px 16px !important;
            }

            .title {
                font-size: 20px !important;
            }

            .brand {
                font-size: 17px !important;
            }

            .stack {
                display: block !important;
                width: 100% !important;
            }

            .text-right {
                text-align: left !important;
                padding-top: 10px !important;
            }

            .logo-cell {
                padding-right: 10px !important;
            }

            .btn {
                display: block !important;
                text-align: center !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }

            .boxcell {
                padding: 14px 14px !important;
            }
        }
    </style>
</head>

<body style="margin:0;padding:0;background:#0b0f17;color:#e9eef6;font-family:Arial, Helvetica, sans-serif;">
    {{-- Preheader --}}
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">
        New message from {{ $contactUs->name }} ({{ $contactUs->email }})
    </div>

    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" class="wrapper">
        <tr>
            <td align="center" class="p-outer">

                <table role="presentation" cellpadding="0" cellspacing="0" width="600" class="container card">

                    {{-- Header --}}
                    <tr>
                        <td class="p-head header">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <!-- Left -->
                                    <td class="stack" style="vertical-align:middle;">
                                        <table role="presentation" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td class="logo-cell" style="padding-right:12px;vertical-align:middle;">
                                                    @if (!empty($faviconUrl))
                                                        <img src="{{ $faviconUrl }}" width="42" height="42"
                                                            alt="{{ $companyName }} logo"
                                                            style="border-radius:10px;border:1px solid #2b3341;background:#0f1420;">
                                                    @else
                                                        <div
                                                            style="width:42px;height:42px;border-radius:10px;border:1px solid #2b3341;background:#0f1420;
                                        color:#f3f5f8;line-height:42px;text-align:center;font-size:12px;font-weight:700;">
                                                            {{ strtoupper(mb_substr($companyName, 0, 2)) }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td style="vertical-align:middle;">
                                                    <p class="brand">{{ $companyName }}</p>
                                                    <p class="badge">Contact Notification</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                    <!-- Right -->
                                    <td class="stack text-right" align="right" style="vertical-align:middle;">
                                        <div class="muted">{{ now()->format('M d, Y H:i') }}</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td class="p-body">
                            <p class="title">New Contact Us Message</p>
                            <p class="sub">A new message was submitted from your portfolio contact form.</p>

                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" class="box">
                                {{-- Sender --}}
                                <tr>
                                    <td class="boxcell divider">
                                        <div class="label">Sender</div>
                                        <div class="value-lg">{{ $contactUs->name }}</div>
                                        <div class="value-sm">
                                            <a class="link"
                                                href="mailto:{{ $contactUs->email }}">{{ $contactUs->email }}</a>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Subject --}}
                                <tr>
                                    <td class="boxcell divider">
                                        <div class="label">Subject</div>
                                        <div class="value">{{ $contactUs->subject }}</div>
                                    </td>
                                </tr>

                                {{-- Message --}}
                                <tr>
                                    <td class="boxcell">
                                        <div class="label">Message</div>
                                        <div class="msg">{!! nl2br(e($contactUs->message)) !!}</div>
                                    </td>
                                </tr>
                            </table>

                            <div style="margin-top:18px;" class="muted">
                                Tip: You can reply directly to this email to continue the conversation.
                            </div>

                            @php
                                $replySubject = rawurlencode('Re: ' . ($contactUs->subject ?? 'Your message'));
                                $replyTo = $contactUs->email;
                            @endphp

                            <div class="btn-wrap">
                                <a class="btn" href="mailto:{{ $replyTo }}?subject={{ $replySubject }}">Reply
                                    to Sender</a>
                            </div>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td class="p-foot footer">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="muted">Sent from {{ $companyName }}</td>
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

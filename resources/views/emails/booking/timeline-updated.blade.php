<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Update</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f7fb;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #0f172a;
        }
        .wrapper {
            width: 100%;
            background: #f5f7fb;
            padding: 32px 0;
        }
        .container {
            max-width: 640px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }
        .header {
            background: linear-gradient(90deg, #0f172a 0%, #2563eb 100%);
            padding: 28px 32px;
            color: #ffffff;
        }
        .brand {
            font-size: 22px;
            font-weight: 700;
            margin: 0;
        }
        .subtext {
            font-size: 13px;
            margin: 6px 0 0;
            color: #dbeafe;
        }
        .content {
            padding: 32px;
        }
        .badge {
            display: inline-block;
            background: #e0f2fe;
            color: #075985;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 10px;
            border-radius: 999px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .title {
            font-size: 24px;
            font-weight: 700;
            margin: 14px 0 8px;
        }
        .meta {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            margin: 18px 0;
        }
        .meta p {
            margin: 0 0 8px;
            font-size: 14px;
            color: #475569;
        }
        .meta strong {
            color: #0f172a;
        }
        .message-box {
            background: #eff6ff;
            border-left: 4px solid #2563eb;
            border-radius: 10px;
            padding: 16px;
            margin: 18px 0;
            color: #1e3a8a;
        }
        .proof-image {
            width: 100%;
            max-width: 520px;
            border-radius: 10px;
            margin-top: 12px;
            border: 1px solid #dbeafe;
        }
        .footer {
            padding: 22px 32px 32px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <p class="brand">AkieRepair</p>
                <p class="subtext">Booking progress update for {{ $booking->id ?? $timeline->booking_id }}</p>
            </div>
            <div class="content">
                <span class="badge">{{ $recipientRole }}</span>
                <h2 class="title">{{ $timeline->title }}</h2>
                <p style="margin: 0; color: #475569;">A booking status update has been recorded for your service request.</p>

                <div class="meta">
                    <p><strong>Booking ID:</strong> #{{ $timeline->booking_id }}</p>
                    <p><strong>Customer:</strong> {{ $booking->customer->name ?? '-' }}</p>
                    <p><strong>Technician:</strong> {{ $booking->technician->name ?? '-' }}</p>
                    <p><strong>Updated At:</strong> {{ $timeline->created_at->format('d M Y, h:i A') }}</p>
                </div>

                <div class="message-box">
                    <p style="margin: 0; font-size: 15px;">{{ $timeline->description }}</p>
                </div>

                @if($timeline->image)
                    <p style="margin: 18px 0 8px; color: #334155; font-weight: 600;">Proof / Attachment</p>
                    <img src="{{ url($timeline->image) }}" alt="Timeline proof image" class="proof-image">
                @endif
            </div>
            <div class="footer">
                This email was sent automatically by AkieRepair.
            </div>
        </div>
    </div>
</body>
</html>

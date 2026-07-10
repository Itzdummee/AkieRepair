<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer Registration</title>
</head>
<body style="margin: 0; padding: 24px; background: #f3f4f6; color: #111827; font-family: Arial, sans-serif;">
    <div style="max-width: 620px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden;">
        <div style="background: #1e3c72; color: #ffffff; padding: 24px;">
            <h1 style="margin: 0; font-size: 22px;">New Customer Registration</h1>
            <p style="margin: 8px 0 0; color: #dbeafe;">A new customer account is waiting for admin verification.</p>
        </div>

        <div style="padding: 24px;">
            <p style="margin: 0 0 18px;">Please review and verify this customer account:</p>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 24px;">
                <tr>
                    <td style="padding: 10px; border: 1px solid #e5e7eb; background: #f9fafb; width: 150px;"><strong>Customer ID</strong></td>
                    <td style="padding: 10px; border: 1px solid #e5e7eb;">{{ $customer->id }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #e5e7eb; background: #f9fafb;"><strong>Name</strong></td>
                    <td style="padding: 10px; border: 1px solid #e5e7eb;">{{ $customer->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #e5e7eb; background: #f9fafb;"><strong>Email</strong></td>
                    <td style="padding: 10px; border: 1px solid #e5e7eb;">{{ $customer->email }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #e5e7eb; background: #f9fafb;"><strong>Phone</strong></td>
                    <td style="padding: 10px; border: 1px solid #e5e7eb;">{{ $customer->phone_number ?: 'Not provided' }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #e5e7eb; background: #f9fafb;"><strong>Status</strong></td>
                    <td style="padding: 10px; border: 1px solid #e5e7eb;">{{ ucfirst($customer->approval_status) }}</td>
                </tr>
            </table>

            <p style="margin: 0 0 24px;">
                <a href="{{ route('admin.customers.pending') }}" style="display: inline-block; padding: 12px 18px; background: #1e3c72; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: bold;">
                    Review Pending Customers
                </a>
            </p>

            <p style="margin: 0; color: #6b7280; font-size: 13px;">This is an automated message from AkieRepair Enterprise.</p>
        </div>
    </div>
</body>
</html>

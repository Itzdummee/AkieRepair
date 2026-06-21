<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AkieRepair – Quotation</title>
  <style>
    body {
      font-family: 'DejaVu Sans', sans-serif;
      font-size: 13px;
      color: #333;
      margin: 0;
      padding: 0;
    }
    .container {
      padding: 30px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    .text-right {
      text-align: right;
    }
    .text-center {
      text-align: center;
    }
    .text-left {
      text-align: left;
    }
    
    /* Green Theme Colors */
    .theme-color {
      color: #15803d; /* Green-700 */
    }
    .theme-bg {
      background-color: #15803d;
      color: #fff;
    }
    .section-bg {
      background-color: #f0fdf4; /* Green-50 */
      border: 1px solid #bbf7d0; /* Green-200 */
      border-radius: 6px;
      padding: 15px;
      margin-bottom: 15px;
    }

    /* Header */
    .brand {
      font-size: 26px;
      font-weight: bold;
    }
    .brand small {
      font-size: 13px;
      font-weight: normal;
      color: #4b5563;
    }
    
    /* Tables */
    .repair-table th {
      padding: 10px;
      font-size: 12px;
      text-transform: uppercase;
    }
    .repair-table td {
      padding: 10px;
      border-bottom: 1px solid #e5e7eb;
    }
    
    .summary-table {
      width: 300px;
      float: right;
      margin-top: 15px;
    }
    .summary-table td {
      padding: 8px 10px;
      border-bottom: 1px solid #e5e7eb;
    }
    .summary-table .total-row td {
      font-weight: bold;
      font-size: 16px;
      border-bottom: none;
    }

    /* Signatures */
    .signature-table {
      margin-top: 50px;
      width: 100%;
    }
    .signature-line {
      border-top: 1px solid #333;
      width: 200px;
      padding-top: 5px;
      font-size: 12px;
    }

    /* Footer */
    .footer {
      margin-top: 30px;
      text-align: center;
      font-size: 11px;
      color: #6b7280;
      border-top: 1px solid #e5e7eb;
      padding-top: 10px;
    }
    
    /* Layout Helpers */
    .mb-2 { margin-bottom: 8px; }
    .mt-4 { margin-top: 20px; }
    .font-bold { font-weight: bold; }
    .text-sm { font-size: 11px; color: #6b7280; }
  </style>
</head>
<body>
<div class="container">

  <!-- HEADER -->
  <table style="margin-bottom: 25px; border-bottom: 2px solid #15803d; padding-bottom: 15px;">
    <tr>
      <td style="vertical-align: bottom;">
        <div class="brand theme-color">
          AkieRepair
          <br><small style="color: #4b5563;">| repair · restore</small>
        </div>
      </td>
      <td class="text-right" style="vertical-align: bottom;">
        <h2 class="theme-color" style="margin: 0 0 5px 0; font-size: 22px;">QUOTATION</h2>
        <p style="margin: 0;"><strong>No:</strong> Q-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</p>
        <p style="margin: 0;"><strong>Date:</strong> {{ now()->format('d M Y') }}</p>
      </td>
    </tr>
  </table>

  <!-- INFO GRID -->
  <div class="section-bg">
    <table>
      <tr>
        <td style="width: 33%; vertical-align: top; padding-right: 10px;">
          <div class="font-bold theme-color mb-2" style="font-size: 14px;">COMPANY INFO</div>
          <p style="margin: 2px 0; font-weight: bold;">AkieRepair</p>
          <p style="margin: 2px 0;">018-2784602</p>
          <p style="margin: 2px 0;">SSM: 201903235633</p>
          <p style="margin: 2px 0;">Nilai Impian, 71800 Nilai</p>
          <p style="margin: 2px 0;">Negeri Sembilan</p>
        </td>
        <td style="width: 33%; vertical-align: top; padding-right: 10px;">
          <div class="font-bold theme-color mb-2" style="font-size: 14px;">BILL TO</div>
          <p style="margin: 2px 0; font-weight: bold;">{{ $booking->customer->name }}</p>
          <p style="margin: 2px 0;">{{ $booking->customer->email }}</p>
          <p style="margin: 2px 0;">{{ $booking->customer->phone_number ?? '-' }}</p>
        </td>
        <td style="width: 34%; vertical-align: top;">
          <div class="font-bold theme-color mb-2" style="font-size: 14px;">PAYMENT DETAILS</div>
          <p style="margin: 2px 0;">Maybank: 1234 5678 9012</p>
          <p style="margin: 2px 0;">Beneficiary: AkieRepair</p>
          <p style="margin: 2px 0;">Ref: Q-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</p>
        </td>
      </tr>
    </table>
  </div>

  <!-- DEVICE INFO -->
  <div class="section-bg">
    <div class="font-bold theme-color mb-2" style="font-size: 14px;">DEVICE INFORMATION</div>
    <table>
      <tr>
        <td style="width: 33%;"><strong>Device:</strong> {{ $booking->device->name }}</td>
        <td style="width: 33%;"><strong>Brand:</strong> {{ $booking->device->brand }}</td>
        <td style="width: 34%;"><strong>Model:</strong> {{ $booking->device->model }}</td>
      </tr>
    </table>
  </div>

  <!-- REPAIR TABLE -->
  <table class="repair-table mt-4" style="border: 1px solid #e5e7eb;">
    <thead>
      <tr class="theme-bg">
        <th style="width:5%;" class="text-center">#</th>
        <th style="width:45%;" class="text-left">DESCRIPTION</th>
        <th style="width:10%;" class="text-center">QTY</th>
        <th style="width:20%;" class="text-right">UNIT PRICE</th>
        <th style="width:20%;" class="text-right">TOTAL</th>
      </tr>
    </thead>
    <tbody>
      @foreach($repairs as $index => $repair)
      <tr>
        <td class="text-center">{{ $index + 1 }}</td>
        <td>
          <strong style="color: #111827;">{{ $repair->repair_type }}</strong>
          @if($repair->description)
          <br><small class="text-sm">{{ $repair->description }}</small>
          @endif
        </td>
        <td class="text-center">1</td>
        <td class="text-right">RM {{ number_format($repair->price, 2) }}</td>
        <td class="text-right">RM {{ number_format($repair->price, 2) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <!-- REPORTS & NOTES -->
  @if($booking->inspection_report)
  <div class="mt-4">
    <div class="font-bold theme-color mb-2" style="font-size: 13px;">INSPECTION REPORT</div>
    <div style="background-color: #f9fafb; padding: 10px; border: 1px solid #e5e7eb; font-size: 12px; border-radius: 4px;">
      {{ $booking->inspection_report }}
    </div>
  </div>
  @endif

  @if($booking->quotation_note)
  <div class="mt-4">
    <div class="font-bold theme-color mb-2" style="font-size: 13px;">QUOTATION NOTE</div>
    <div style="background-color: #f9fafb; padding: 10px; border: 1px solid #e5e7eb; font-size: 12px; border-radius: 4px;">
      {{ $booking->quotation_note }}
    </div>
  </div>
  @endif

  <!-- SUMMARY TABLE -->
  <table style="width: 100%;">
    <tr>
      <td style="width: 50%;"></td>
      <td style="width: 50%;">
        <table class="summary-table">
          <tr>
            <td>Repair Subtotal</td>
            <td class="text-right">RM {{ number_format(max(0, $booking->quotation_price - 50), 2) }}</td>
          </tr>
          <tr>
            <td>Site Visit Charge</td>
            <td class="text-right">RM 50.00</td>
          </tr>
          <tr>
            <td>Tax</td>
            <td class="text-right">RM 0.00</td>
          </tr>
          <tr class="total-row theme-bg">
            <td style="color: white;">Total to Pay</td>
            <td class="text-right" style="color: white;">RM {{ number_format($booking->quotation_price, 2) }}</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

  <div style="clear: both;"></div>

  <!-- SIGNATURE AREA -->
  <table class="signature-table">
    <tr>
      <td style="width: 50%; text-align: left;">
        <div class="signature-line">Authorized Signature</div>
      </td>
      <td style="width: 50%; text-align: right;">
        <div class="signature-line" style="float: right;">Client Signature</div>
        <div style="clear: both;"></div>
      </td>
    </tr>
  </table>

  <!-- FOOTER -->
  <div class="footer">
    AkieRepair | 018-2784602 | Nilai Impian, 71800 Nilai, Negeri Sembilan
    <br><span style="opacity:0.7;">— repairs with care</span>
  </div>

</div>
</body>
</html>
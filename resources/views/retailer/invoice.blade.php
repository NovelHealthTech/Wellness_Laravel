<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tax Invoice</title>
    <style>
        @page {
            margin: 10mm 10mm 25mm 10mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: white;
            font-size: 10px;
            padding: 0;
            margin: 0;
        }

        .page-wrapper {
            width: 100%;
            position: relative;
        }

        .invoice {
            padding: 5mm;
            padding-bottom: 5mm;
        }

        .bill-supply-header {
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            color: #2c3e50;
            padding: 8px;
            background: #f8f9fa;
            border: 2px solid #333333;
            margin-bottom: 6px;
            letter-spacing: 1px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
            border: 2px solid #333333;
        }

        .header-table td {
            padding: 4px 6px;
            border: 1px solid #333333;
            font-size: 9px;
            color: #555;
        }

        .logo-cell {
            text-align: center;
            padding: 6px;
            background: #f8f9fa;
        }

        .company-name-cell {
            text-align: center;
            background: #f8f9fa;
            padding: 5px;
        }

        .company-name-cell strong {
            font-size: 10px;
            color: #2c3e50;
            display: block;
            margin-bottom: 2px;
        }

        .info-label {
            font-weight: 600;
            color: #2c3e50;
            width: 20%;
            background: #f8f9fa;
        }

        .info-value {
            color: #555;
            width: 30%;
        }

        .company-logo {
            width: 120px;
            height: auto;
        }

        .billing-section {
            margin: 6px 0;
        }

        .billing-box {
            background: #f8f9fa;
            padding: 6px;
            border-radius: 3px;
            border: 1px solid #e0e0e0;
            margin-bottom: 6px;
        }

        .billing-box h3 {
            color: #2c3e50;
            font-size: 10px;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .billing-box p {
            color: #555;
            line-height: 1.3;
            font-size: 9px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 6px 0;
            border: 1px solid #ddd;
        }

        .items-table thead {
            background: #333333;
            color: white;
        }

        .items-table th {
            padding: 5px;
            text-align: left;
            font-weight: 600;
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .items-table tbody tr {
            border-bottom: 1px solid #ecf0f1;
        }

        .items-table td {
            padding: 5px;
            color: #555;
            font-size: 9px;
        }

        .items-table .text-right {
            text-align: right;
        }

        .items-table .text-center {
            text-align: center;
        }

        .service-description {
            color: #7f8c8d;
            font-size: 8px;
            margin-top: 2px;
        }

        .totals-section {
            background: #f8f9fa;
            padding: 6px;
            border-radius: 3px;
            margin: 6px 0;
            border: 1px solid #e0e0e0;
        }

        .total-row {
            display: block;
            overflow: hidden;
            padding: 2px 0;
            font-size: 9px;
            color: #555;
        }

        .total-row span:first-child {
            float: left;
        }

        .total-row span:last-child {
            float: right;
        }

        .total-row.grand-total {
            border-top: 2px solid #333333;
            margin-top: 3px;
            padding-top: 5px;
            font-size: 11px;
            font-weight: 700;
            color: #2c3e50;
        }

        .amount-words {
            background: #f8f9fa;
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #e0e0e0;
            margin: 6px 0;
        }

        .amount-words p {
            color: #2c3e50;
            font-size: 9px;
            line-height: 1.3;
        }

        .tax-table {
            width: 100%;
            border-collapse: collapse;
            margin: 6px 0;
            background: white;
            border: 1px solid #ddd;
        }

        .tax-table th {
            background: #333333;
            color: white;
            padding: 5px;
            font-size: 8px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .tax-table td {
            padding: 5px;
            border-bottom: 1px solid #ecf0f1;
            color: #555;
            font-size: 9px;
        }

        .payment-details-box {
            background: #f8f9fa;
            padding: 6px;
            border-radius: 3px;
            border: 1px solid #e0e0e0;
            margin: 6px 0 15mm 0;
        }

        .payment-details-box h3 {
            color: #2c3e50;
            font-size: 10px;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .payment-details-box p {
            color: #555;
            line-height: 1.3;
            font-size: 9px;
        }

        .footer-notes {
            background: #333333;
            color: white;
            padding: 8px;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
        }

        .footer-notes h4 {
            font-size: 9px;
            margin-bottom: 2px;
            letter-spacing: 1px;
        }

        .footer-notes p {
            font-size: 7px;
            color: #cccccc;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div class="invoice">
            <div class="bill-supply-header">BILL OF SUPPLY</div>

            <table class="header-table">
                <tr>
                    <td class="logo-cell" colspan="4">
                        <img src="{{ public_path('images/Dark Logo.png') }}" class="company-logo" alt="Company Logo" />
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="company-name-cell">
                        <strong>Novel Healthtech Solutions Private Limited</strong><br>
                        101-D, 2nd Floor Udyog Vihar, Phase - 5, Gurugram, Haryana - 122001
                    </td>
                </tr>
                <tr>
                    <td class="info-label"><strong>GSTIN:</strong></td>
                    <td class="info-value">06AAGCN8283M1ZT</td>
                    <td class="info-label"><strong>CIN:</strong></td>
                    <td class="info-value">U62090HR2020PTC122803</td>
                </tr>
                <tr>
                    <td class="info-label"><strong>Contact:</strong></td>
                    <td class="info-value">0124-4278179</td>
                    <td class="info-label"><strong>Email:</strong></td>
                    <td class="info-value">support@novelhealthtech.com</td>
                </tr>
                <tr>
                    <td class="info-label"><strong>Website:</strong></td>
                    <td colspan="3" class="info-value">www.novelhealthtech.com</td>
                </tr>
                <tr>
                    <td class="info-label"><strong>Invoice No:</strong></td>
                    <td class="info-value">{{ $invoice_no }}</td>
                    <td class="info-label"><strong>Invoice Date:</strong></td>
                    <td class="info-value">{{ \Carbon\Carbon::parse($invoice_date)->format('d/m/Y') }}</td>
                </tr>
            </table>

            <div class="billing-section">
                <div class="billing-box">
                    <h3>Bill To</h3>
                    <p>
                        <strong style="font-size: 10px; color: #2c3e50;">{{ $patient_name }}</strong><br>
                        {{ $patient_address }}<br>
                        {{ $patient_city }}<br>
                        <strong>PIN:</strong> {{ $patient_pincode }}<br>
                        <strong>State Code:</strong> {{ $state_code }}
                    </p>
                </div>
            </div>

            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">S.No</th>
                        <th style="width: 45%;">Description of Services</th>
                        <th style="width: 15%;" class="text-center">HSN/SAC</th>
                        <th style="width: 10%;" class="text-right">Rate</th>
                        <th style="width: 10%;" class="text-center">Qty</th>
                        <th style="width: 15%;" class="text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>
                            <strong>{{ $service_name }}</strong>
                            <div class="service-description">{{ $service_description }}</div>
                        </td>
                        <td class="text-center">999316</td>
                        <td class="text-right">Rs. {{ number_format($rate, 2) }}</td>
                        <td class="text-center">{{ $quantity }}</td>
                        <td class="text-right">Rs. {{ number_format($amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" style="height: 20px; background: #fafafa;"></td>
                    </tr>
                </tbody>
            </table>

            <div class="totals-section">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>Rs. {{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="total-row">
                    <span>Tax (0%):</span>
                    <span>Rs. {{ number_format($tax, 2) }}</span>
                </div>
                <div class="total-row">
                    <span>Discount:</span>
                    <span>Rs. {{ number_format($discount, 2) }}</span>
                </div>
                <div class="total-row grand-total">
                    <span>Grand Total:</span>
                    <span>Rs. {{ number_format($grand_total, 2) }}</span>
                </div>
            </div>

            <div class="amount-words">
                <p>
                    <strong>Amount in Words:</strong><br>
                    {{ $amount_words }}
                </p>
            </div>

            <table class="tax-table">
                <thead>
                    <tr>
                        <th>HSN/SAC</th>
                        <th class="text-right">Taxable Value</th>
                        <th class="text-center">CGST Rate</th>
                        <th class="text-right">CGST Amount</th>
                        <th class="text-center">SGST Rate</th>
                        <th class="text-right">SGST Amount</th>
                        <th class="text-right">Total Tax</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>999316</td>
                        <td class="text-right">Rs. {{ number_format($subtotal, 2) }}</td>
                        <td class="text-center">0%</td>
                        <td class="text-right">Rs. 0.00</td>
                        <td class="text-center">0%</td>
                        <td class="text-right">Rs. 0.00</td>
                        <td class="text-right"><strong>Rs. 0.00</strong></td>
                    </tr>
                    <tr style="background: #f8f9fa; font-weight: 600;">
                        <td><strong>Total</strong></td>
                        <td class="text-right"><strong>Rs. {{ number_format($subtotal, 2) }}</strong></td>
                        <td class="text-center">-</td>
                        <td class="text-right"><strong>Rs. 0.00</strong></td>
                        <td class="text-center">-</td>
                        <td class="text-right"><strong>Rs. 0.00</strong></td>
                        <td class="text-right"><strong>Rs. 0.00</strong></td>
                    </tr>
                </tbody>
            </table>

            <div class="payment-details-box">
                <h3>Payment Details</h3>
                <p>
                    <strong>Payment ID:</strong> {{ $payment_id }}<br>
                    <strong>Payment Method:</strong> {{ $payment_method }}<br>
                    <strong>Payment Status:</strong> <span style="color: #27ae60; font-weight: 600;">Paid</span><br>
                    <strong>Transaction Date:</strong> {{ \Carbon\Carbon::parse($transaction_date)->format('d/m/Y') }}
                </p>
            </div>
        </div>

        <div class="footer-notes">
            <h4>SUBJECT TO HARYANA JURISDICTION</h4>
            <p>This is a computer-generated invoice and does not require a physical signature</p>
        </div>
    </div>
    
    <script>
        if (window.history && window.history.pushState) {
            window.history.pushState(null, null, window.location.href);
            
            window.addEventListener('popstate', function() {
                window.location.href = "{{ route('retailer.allpackages') }}";
            });
        }
    </script>
</body>
</html>
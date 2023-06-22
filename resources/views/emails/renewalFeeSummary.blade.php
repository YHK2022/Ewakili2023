<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Control Number</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
        }
        h1, h2, h3 {
            margin-top: 0;
            margin-bottom: 0;
        }
        h1 {
            font-size: 24px;
            color: #0047ab;
        }
        h2 {
            font-size: 18px;
            color: #000000;
        }
        p {
            margin-top: 0;
            margin-bottom: 10px;
            line-height: 1.5;
        }
        ul {
            margin-top: 0;
            margin-bottom: 10px;
            padding-left: 20px;
        }
        li {
            list-style-type: none;
        }
        .total-amount {
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Renewal Fee Summary</h1>
        <p>Dear {{ Auth::user()->full_name }},</p>
        <p>Here's a summary of your fees:</p>
        <ul>
            @foreach($profile_fees as $profile_fee)
                <li>{{ $profile_fee['profile_id'] }} ({{ $profile_fee['amount_to_be_paid'] }})</li>
            @endforeach
        </ul>
        <p class="total-amount">Total amount: {{ $total_all_fees }}</p>
        <p class="total-amount">Control Number: {{ $control_number }}</p>

        <p>Thank you for your payment.</p>
        <div class="footer">
            {{-- <p>Best regards,</p> --}}
         <p style="margin: 0;">Best Regards,<br> OFFICE OF REGISTRAR<br>HIGH COURT OF TANZANIA
        </br>Calls: 0739303038</p>
        </div>
    </div>
</body>
</html>
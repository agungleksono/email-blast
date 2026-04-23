<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    
    <style type="text/css">
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body style="width: 600px; font-family: sans-serif;">
    <p>Dear {{ $data['pic'] }} {{ $data['company_name'] }} <br>{{ $data['company_address'] }}</p>

    {!! $data['upper_body'] !!}

    <img src="{{ url('/assets/sample.png') }}" style="width: 400px" alt="products" />

    {!! $data['lower_body'] !!}
    
    <br>
    <!-- <p>{{ $data['signature_name'] }}</p>
    <p><i>Sales and Marketing</i></p> -->

    <img src="{{ url('/assets/signature.png') }}" style="width: 300px" alt="signature" />
</body>
</html>
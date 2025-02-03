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
    <p>Dear {{ $data['pic'] }} {{ $data['company_name'] }}</p>
    <p>{{ $data['company_address'] }}</p>

    <p>I hope this email finds you well. My name is Intan, and I am reaching out to you on behalf of Sagara Trading Co., a leading supplier of premium agriculture products based in Indonesia.</p>
    <p>We would like to offering our all-supplying product from Indonesian Agriculture.</p>

    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>No</th>
                <th>Product Name</th>
                <th>Product Spec</th>
                <th>Details Packing</th>
                <th>MOQ</th>
                <th>Terms</th>
                <th>Price</th>
            </tr>
        </thead>
    </table>

    <p>If you are interested in exploring this oportunity further, please feel free to reply to this email or give me a call at +62 878 4405 6342</p>
    <p>I am eager to hear from you and discuss how we can collaborate to meet your business needs.</p>
    <p>Thank you for considering Sagara Trading Co. as your trusted supplier of Agriculture Product from Indonesia.</p>
    <p>I lokk forward to the possibility of working together and forging a successful partnership.</p>
</body>
</html>
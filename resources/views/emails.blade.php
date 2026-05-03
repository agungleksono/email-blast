<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body style="width: 600px; font-family: sans-serif;">

    @php
        $type = $data['email_type'];

        $typeMap = [
            'type 1' => 'website',
            'type 4' => 'website',
            'type 2' => 'product',
            'type 5' => 'product',
            'type 3' => 'section',
            'type 6' => 'section',
        ];
    @endphp

    {{-- Greeting --}}
    <p>
        Dear {{ $data['pic'] }}
        @if (in_array($type, ['type 4', 'type 5', 'type 6']))
            {{ $data['section'] }}
        @else
            {{ $data['company_name'] }}
        @endif
        <br>
        {{ $data['company_address'] }}
    </p>

    {{-- Intro --}}
    <p>{{ $data['email_intro'] }}</p>

    {{-- Dynamic sentence --}}
    <p>
        {{ $data['form_1'] }}
        {{ $data[$typeMap[$type]] ?? '' }}
        {{ $data['form_3'] }}
    </p>

    {{-- Upper body (HTML content) --}}
    {!! $data['upper_body'] !!}

    {{-- Product Image --}}
    <img src="{{ url('/assets/sample.png') }}" style="width: 400px" alt="products" />

    {{-- Lower body (HTML content) --}}
    {!! $data['lower_body'] !!}
    
    <br>

    {{-- Signature image --}}
    <img src="{{ url('/assets/signature.png') }}" style="width: 300px" alt="signature" />
</body>
</html>
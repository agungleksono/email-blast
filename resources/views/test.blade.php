<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('includes.style')
</head>
<body>
    <div class="bg-info">
        {{ env('APP_URL') }}
    </div>
    <img src="http://127.0.0.1:8000/assets/signature.png" alt="" style="width: 50px;">

    @include('includes.script')
</body>
</html>
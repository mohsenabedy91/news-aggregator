<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #d35400;
            color: #ffffff;
            padding: 15px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
        }

        .content {
            padding: 20px;
            color: #333333;
            line-height: 1.6;
            font-size: 16px;
        }

        .footer {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            color: #666666;
        }

        .otp {
            font-size: 20px;
            font-weight: bold;
            color: #d35400;
        }
    </style>
    <title>{{ $title }}</title>
</head>
<body>
<div class="container">
    @yield('header')
    @yield('content')
    @yield('footer')
</div>
</body>
</html>

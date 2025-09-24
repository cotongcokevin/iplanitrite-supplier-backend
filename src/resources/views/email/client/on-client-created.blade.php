<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Event Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #dddddd;
        }
        h1 {
            color: #2c3e50;
        }
        .footer {
            font-size: 12px;
            color: #888888;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>New Event Created!</h1>

    <p>Hello Test,</p>

    <p>A new event has been created: <strong>Test</strong>.</p>

    <p>
        Date: Some Date<br>
        Location: Some Location
    </p>

    <p>Thank you for staying up to date with our events!</p>

    <div class="footer">
        &copy; {{ date('Y') }} Your Company. All rights reserved.
    </div>
</div>
</body>
</html>
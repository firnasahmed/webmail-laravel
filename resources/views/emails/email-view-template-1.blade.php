<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .content {
            padding: 20px;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            color: #888888;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $subject }}</h1>
        </div>
        <div class="content">
            <p>{{ $message }}</p>
        </div>
        <div class="footer">
            <p>This is an automated email from Webmail App, please do not reply.</p>
        </div>
    </div>
</body>
</html>

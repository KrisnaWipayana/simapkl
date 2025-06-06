<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lamaran Kerja</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #ffffff;
            margin: 0;
            padding: 20px;
        }
        .info-item {
            margin-bottom: 20px;
        }
        
        .info-value {
            font-size: 16px;
            color: #333333;
            margin-bottom: 0;
        }
        @media (max-width: 600px) {
            body {
                padding: 15px;
            }
            
            .header h1 {
                font-size: 22px;
            }
            
            .header .subtitle {
                font-size: 15px;
            }
            
            .info-value, .message-content {
                font-size: 15px;
            }
        }
    </style>
</head>
    <body>
        <div class="info-item">
            <div class="info-value">{!! nl2br(e($email_message)) !!}</div>
        </div>
    </body>
</html>
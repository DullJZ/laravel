<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif; 
            }

            .container {
                width: 100%;
                max-width: 600px;
                margin: auto;
            }

            .header {
                background-color: #f0f0f0;
                padding: 20px;
                text-align: center;
            }

            .content {
                padding: 20px;
            }

            .code {
                background-color: #f0f0f0;
                padding: 20px;
                text-align: center;
                font-size: 24px;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>Email Verification</h2>
            </div>
            <div class="content">
                <p>Dear user,</p>
                <p>Your verification code is:</p>
                <div class="code">{{ $code }}</div>
            </div>
        </div>
    </body>
</html>
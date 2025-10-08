<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h2>Reset Your Password</h2>
    <p>Click the link below to reset your password:</p>
    <a href="{{ url('reset-password/'.$token) }}">Reset Password</a>

</body>
</html>
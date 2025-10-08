<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Forgot Password</title>
    <style>
        body{
            display:flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form{
            border: 1px solid black;
            padding: 30px;
            border-radius: 10px;
        }
        form .form-label{
            font-weight: bold;
        }
        form .form-group{
            width: 250px;
        }
        button{
            width:100%;
        }
        form .form-group input{
            margin-bottom: 15px;
            width:100%;
            padding: 8px;
        }
        form .form-group input::placeholder{
            font-size: 14px;
            color:gray;
            font-weight: lighter;
            padding-left: 5px;
        }

        form .mb-3 a{
            text-decoration: none;
        }
        .alert{
            position: absolute;
            top:10px;
            width: 300px;
        }
    </style>
</head>
<body>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        
    @endif

    <form action="{{ route('reset.password') }}" method="post">
        @csrf
        <input type="hidden" name="email" value="{{ $mail }}">
       <div class="form-group">
        <h2 class="text-center mb4">Reset Password</h2>
        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">OTP:</label>
            <input type="text" class="p-1 w-4" style="border-radius: 10px" name="otp" id="exampleFormControlInput2" placeholder="Enter OTP" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput3" class="form-label">Password:</label>
            <input type="password" class="p-1 w-4" style="border-radius: 10px" name="password" id="exampleFormControlInput3" placeholder="Enter Password" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput4" class="form-label">Conform Password:</label>
            <input type="password" class="p-1 w-4" style="border-radius: 10px" name="cpassword" id="exampleFormControlInput4" placeholder="Re-Enter Your Password" required>
        </div>
        <button type="submit" class="btn btn-success">Change</button>
       </div>
    </form>

</body>
</html>
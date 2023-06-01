<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="/css/Login.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>

    <div class="login-box">
        <h2>Login</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="user-box">
                    <input type="text" name="email" required="">
                    <label>Username</label>
                    @error('email')
                    <p class="alert alert-danger">{{ $message }} </p>
                @enderror
                </div>
                <div class="user-box">
                    <input type="password" name="password" required="">
                    <label>Password</label>
                    @error('password')
                    <p class="alert alert-danger">{{ $message }} </p>
                @enderror
                 </div>
                <button type="submit">
                     Login
                </button>
            </form>
        </div>
    </div>

    <script>
        @if(Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
        @endif
    </script>
</body>
</html>

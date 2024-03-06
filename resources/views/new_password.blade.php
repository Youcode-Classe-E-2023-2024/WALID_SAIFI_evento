<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/image/Wiki.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" integrity="sha384-QV8+oaDlJKJwQ/Scnkxm5oWfsR5Zgqn1ZlW4FL4jK71ftjF8VcOGUE3NIn1QFZDv" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0">Password Reset</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('rest.passwordPost')}}">
                        @csrf
                        <input type="text" name = "token_email" hidden value="{{$token}}">
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                        <div class="form-group mb-3">
                            <label for="password">New Password:</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Enter your new password">
                        </div>
                        @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirm New Password:</label>
                            <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm your new password">
                        <button class="btn btn-primary btn-block">Reset Password</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-1">Remember your password? <a href="{{ route('login') }}" class="text-primary">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

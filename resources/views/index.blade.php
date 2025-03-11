<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login Form</title>
</head>

<body>
    <div class="login-reg-panel">
        <div class="login-info-box">
            <h2>Have an account?</h2>
            <p>Login to access your scholarship details, track your application status, and stay updated with important
                announcements.</p>
            <label id="label-register" for="log-reg-show">Login</label>
            <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
        </div>
        <div class="register-info-box">
            <h2>Don't have an account?</h2>
            <p>Register now to submit your application, upload required documents, and manage your scholarship profile
                easily.</p>
            <label id="label-login" for="log-login-show">Register</label>
            <input type="radio" name="active-log-panel" id="log-login-show">
        </div>
        <div class="white-panel">
            <div class="login-show">
                <h2>LOGIN</h2>
                <input type="text" placeholder="Email">
                <input type="password" placeholder="Password">
                <input type="button" value="Login">
                <a href="#">Forgot password?</a>
            </div>
            <div class="register-show">
                <h2>REGISTER</h2>
                <form id="registerForm" method="POST" action="{{ route('register') }}">

                    @csrf
                    <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
                    @error('firstName') <span class="text-danger">{{ $message }}</span> @enderror

                    <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
                    @error('lastName') <span class="text-danger">{{ $message }}</span> @enderror

                    <input type="date" id="birthdate" name="birthdate" required>
                    @error('birthdate') <span class="text-danger">{{ $message }}</span> @enderror

                    <input type="password" id="password" name="password" placeholder="Password" required>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                    <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password" required>

                    <select id="role" name="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role') <span class="text-danger">{{ $message }}</span> @enderror

                    <input type="button" value="Register" id="registerButton">
                </form>
            </div>
        </div>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  

    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>

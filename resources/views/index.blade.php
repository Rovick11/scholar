<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Login Form</title>
    <style>
        body {
            font-family: 'Mukta', sans-serif;
            height: 100vh;
            min-height: 550px;
            background: rgb(160, 213, 241);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow-y: hidden;
        }

        a {
            text-decoration: none;
            color: #ffffff;
        }

        .login-reg-panel {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            text-align: center;
            width: 70%;
            right: 0;
            left: 0;
            margin: auto;
            height: 400px;
            background-color: rgba(30, 144, 255, 0.9);
            border-radius: 25px;
        }

        .white-panel {
            background-color: rgba(255, 255, 255, 1);
            position: absolute;
            top: -50px;
            width: 50%;
            right: calc(50% - 50px);
            transition: .3s ease-in-out;
            z-index: 0;
            box-shadow: 0 0 15px 9px #00000096;
            border-radius: 25px;
        }

        .login-reg-panel input[type="radio"] {
            position: relative;
            display: none;
        }

        .login-reg-panel {
            color: rgb(0, 0, 0);
        }

        .login-reg-panel #label-login,
        .login-reg-panel #label-register {
            border: 1px solid #ffffff;
            padding: 5px 5px;
            width: 150px;
            display: block;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 18px;
            background-color: #1E90FF;
            color: #ffffff;
        }

        .login-info-box,
        .register-info-box {
            width: 30%;
            padding: 0 50px;
            top: 20%;
            position: absolute;
            text-align: left;
        }

        .login-info-box {
            left: 0;
        }

        .register-info-box {
            right: 0;
        }

        .right-log {
            right: 50px !important;
        }

        .login-show {
            height: 500px;
            z-index: 1;
            display: none;
            opacity: 0;
            transition: 0.3s ease-in-out;
            color: #242424;
            text-align: left;
            padding: 50px;
        }

        .register-show {
            height: 600px;
            z-index: 1;
            display: none;
            opacity: 0;
            transition: 0.3s ease-in-out;
            color: #242424;
            text-align: left;
            padding: 20px;
            overflow-y: auto;
            max-height: 600px;
        }

        .show-log-panel {
            display: block;
            opacity: 0.9;
        }

        .login-show input[type="text"],
        .login-show input[type="password"],
        .register-show input[type="text"],
        .register-show input[type="password"],
        .register-show input[type="date"],
        .register-show select {
            width: 100%;
            display: block;
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #b5b5b5;
            outline: none;
        }

        .login-show input[type="button"],
        .register-show input[type="button"] {
            max-width: 150px;
            width: 100%;
            background: #1E90FF;
            color: #ffffff;
            border: none;
            padding: 10px;
            text-transform: uppercase;
            border-radius: 2px;
            float: right;
            cursor: pointer;
        }

        .login-show a {
            display: inline-block;
            padding: 10px 0;
        }

        .credit {
            position: absolute;
            bottom: 10px;
            left: 10px;
            color: #3B3B25;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            z-index: 99;
        }

        a {
            text-decoration: none;
            color: #2c7715;
        }

        .card {
            width: 500px;
            margin: 0 auto;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
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
                <form>
                    <input type="text" id="firstName" placeholder="First Name" required>
                    <input type="text" id="lastName" placeholder="Last Name" required>
                    <input type="date" id="birthdate" required>
                    <input type="password" id="password" placeholder="Password" required>
                    <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
                    <select id="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <input type="button" value="Register">
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.login-info-box').fadeOut();
            $('.login-show').addClass('show-log-panel');
        });

        $('.login-reg-panel input[type="radio"]').on('change', function () {
            if ($('#log-login-show').is(':checked')) {
                $('.register-info-box').fadeOut();
                $('.login-info-box').fadeIn();

                $('.white-panel').addClass('right-log');
                $('.register-show').addClass('show-log-panel');
                $('.login-show').removeClass('show-log-panel');
            } else if ($('#log-reg-show').is(':checked')) {
                $('.register-info-box').fadeIn();
                $('.login-info-box').fadeOut();

                $('.white-panel').removeClass('right-log');

                $('.login-show').addClass('show-log-panel');
                $('.register-show').removeClass('show-log-panel');
            }
        });
    </script>
</body>

</html>
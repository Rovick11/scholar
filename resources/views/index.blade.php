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
            <form id = "loginForm" method="POST" action="{{ route('login') }}">
            @csrf
                    <div class="login-show">
                        <h2>LOGIN</h2>
                        <input type="text" name ="email" placeholder="Email" required>
                        <input type="password" name ="password" placeholder="Password" required>
                        <input type="button" value="Login" id = "loginButton">
                        <a href="#">Forgot password?</a>
                    </div>
            </form>
            <div class="register-show">
                <h2>REGISTER</h2>

                <form id="registerForm" method="POST" action="{{ route('register') }}">

                    @csrf
                    <div id="step1">
                            <h3>Step 1: Personal Information</h3>
                            <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
                            @error('firstName') <span class="text-danger">{{ $message }}</span> @enderror

                            <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
                            @error('lastName') <span class="text-danger">{{ $message }}</span> @enderror

                            <input type="text" id="email" name="email" placeholder="Email" required>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                           

                            <select id="barangay" name="barangay" required>
                                <option value="">Select Barangay</option>
                                <option value="Aga">Aga</option>
                                <option value="Balaytigui">Balaytigui</option>
                                <option value="Banilad">Banilad</option>
                                <option value="Barangay 1">Barangay 1</option>
                                <option value="Barangay 2">Barangay 2</option>
                                <option value="Barangay 3">Barangay 3</option>
                                <option value="Barangay 4">Barangay 4</option>
                                <option value="Barangay 5">Barangay 5</option>
                                <option value="Barangay 6">Barangay 6</option>
                                <option value="Barangay 7">Barangay 7</option>
                                <option value="Barangay 8">Barangay 8</option>
                                <option value="Barangay 9">Barangay 9</option>
                                <option value="Barangay 10">Barangay 10</option>
                                <option value="Barangay 11">Barangay 11</option>
                                <option value="Barangay 12">Barangay 12</option>
                                <option value="Bilaran">Bilaran</option>
                                <option value="Bucana">Bucana</option>
                                <option value="Bulihan">Bulihan</option>
                                <option value="Bunducan">Bunducan</option>
                                <option value="Butucan">Butucan</option>
                                <option value="Calayo">Calayo</option>
                                <option value="Catandaan">Catandaan</option>
                                <option value="Kaylaway">Kaylaway</option>
                                <option value="Kayrilaw">Kayrilaw</option>
                                <option value="Cogunan">Cogunan</option>
                                <option value="Dayap">Dayap</option>
                                <option value="Latag">Latag</option>
                                <option value="Looc">Looc</option>
                                <option value="Lumbangan">Lumbangan</option>
                                <option value="Malapad na Bato">Malapad na Bato</option>
                                <option value="Mataas na Pulo">Mataas na Pulo</option>
                                <option value="Maugat">Maugat</option>
                                <option value="Munting Indan">Munting Indan</option>
                                <option value="Natipuan">Natipuan</option>
                                <option value="Pantalan">Pantalan</option>
                                <option value="Papaya">Papaya</option>
                                <option value="Putat">Putat</option>
                                <option value="Reparo">Reparo</option>
                                <option value="Talangan">Talangan</option>
                                <option value="Tumalim">Tumalim</option>
                                <option value="Utod">Utod</option>
                                <option value="Wawa">Wawa</option>
                            </select>


                            <div class="input-group" style="display: flex; align-items: center; gap: 13px;">
                            <label for="birthdate">Birthdate:</label>
                            <input type="date" id="birthdate" name="birthdate" required style="width: 160px;">
                            @error('birthdate') <span class="text-danger">{{ $message }}</span> @enderror
                            <label for="sex">sex:</label>
                            <select id="sex" name="sex" style="width: 110px;">
                                <option value="" disabled selected>Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            </div>  

                            <span class="phone-prefix">+63</span>
                            <input type="tel" id="contact" name="contact" pattern="[0-9]{10}" placeholder="9123456789"
                             maxlength="10" required class="phone-input"></input>
                            <input type="button" value ="Next" id="nextStep" ></input>
                    </div>
                    <div id="step2" style="display: none;">
                            <h3>Step 2: Account Security</h3>
                            <input type="password" id="password" name="password" placeholder="Password" required>
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                            <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password" required>

                            <select id="role" name="role" required>
                                <option value="user">User</option>
                                <option value="pending">Admin</option>
                            </select>
                            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                            <button type="button" id="prevStep" class="btn btn-secondary">Back</button>
                            <input type="button" value="Register" id="registerButton">
                    </div>
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

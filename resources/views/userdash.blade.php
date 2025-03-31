<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/userdash.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <div class="sidebar">
    <div class="logo">
    <img src="{{ asset('images/logo.png') }}" alt="Logo">
    <span class="logo-text">Municipality of Nasugbu</span>
    <img src="{{ asset('images/logo1.png') }}" alt="Logo">
</div>
        <ul>
        <li><a href="{{ route('user_appSub') }}"><i class="fas fa-file-alt"></i> Application Submission</a></li>
        <li><a href="{{ route('user_appStatus') }}"><i class="fas fa-tasks"></i> Application Status Tracking</a></li>
        <li><a href="{{ route('user_docUpload') }}"><i class="fas fa-upload"></i> Document Upload & Management</a></li>
        <li><a href="{{ route('user_acceptForm') }}"><i class="fas fa-file-alt"></i> Acceptance Form</a></li>
        </ul>
        <div class="bottom-links">
            <ul>
                <li><a href="#" id ="logoutButton"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="topbar">
    <div class="notification">
        <i class="fas fa-bell" onclick="toggleNotifications()"></i>
        <span class="badge">3</span> <!-- Example: 3 unread notifications -->
        <div class="dropdown-menu" id="notificationDropdown">
            <h3>Notifications</h3>
            <ul>
                <li>
                    <a href="#">
                        <p>Your application has been approved.</p>
                        <span class="timestamp">March 12, 2025</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <p>Upcoming deadline for document submission.</p>
                        <span class="timestamp">March 10, 2025</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <p>New announcement: Scholarship renewal process.</p>
                        <span class="timestamp">March 8, 2025</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <a href="javascript:void(0);" onclick="showPopup()" class="user-link">
        <div class="user-info">
            <img src="{{ asset('images/dp.png') }}" alt="User Image">
            <span class="logo-text">SCHOLAR</span>
        </div>
    </a>
</div>

<!-- Chat Button -->
<div class="chat-button" onclick="toggleChatBox()">
        <i class="fas fa-comments"></i>
    </div>

    <!-- Chat Box -->
    <div class="chat-box" id="chatBox">
        <div class="chat-header">
            <span>Support Chat</span>
            <button class="close-chat" onclick="toggleChatBox()">&times;</button>
        </div>
        <div class="chat-body">
            <!-- Chat messages will appear here -->
        </div>
        <div class="chat-footer">
            <input type="text" placeholder="Type your message..." />
            <button>Send</button>
        </div>
    </div>
    
<!-- Overlay Background -->
<div id="overlay" class="overlay" onclick="closePopup()"></div>

<!-- Pop-up Box -->
<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <h2> </h2>
        <form id="updateForm" action="{{ route('userprofile.update', ['id' => $user->id ?? 0]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PUT for updating data -->

        <fieldset>
        <legend>Personal Information</legend>
        <div class="form-container">
        <div class="input-group">
            <input type="text" id="last-name" name="last_name" class="small-input" value="{{ $user->lastName }}" required placeholder=" ">
            <label for="last-name">Last Name</label>
        </div>

        <div class="input-group">
            <input type="text" id="first-name" name="first_name" class="small-input" value="{{ $user->firstName }}" required placeholder=" ">
            <label for="first-name">First Name</label>
        </div>
        
        <div class="input-group">
            <input type="text" id="middle-initial" name="middle_initial" class="small-input" value="{{ $user->middleName }}" required placeholder=" ">
            <label for="middle-initial">Middle Initial</label>
        </div>
        
        <div class="input-group">
            <input type="email" id="email" name="email" class="small-input" value="{{ $user->email }}" required placeholder=" ">
            <label for="email">Email</label>
        </div>
        
        <div class="input-group">
            <input type="text" id="phone" name="phone" class="small-input" value="{{ $user->contactNo }}" required placeholder=" ">
            <label for="phone">Phone Number</label>
        </div>
        
        <div class="input-group">
            <input type="date" id="birth-date" name="birth_date" class="small-input" value="{{ $user->birthDate }}" required>
            <label for="birth-date">Birth Date</label>
        </div>
        
        <div class="input-group">
            <select id="barangay" name="barangay" required>
                <option value="{{ $user->barangay }}">{{ $user->barangay }}</option>
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
            <label for="barangay">Barangay</label>
        </div>
        
        <div class="input-group">
            <select id="sex" name="sex" required>
                <option value="{{ $user->sex }}">{{ $user->sex }}</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <label for="sex">Sex</label>
        </div>
    </fieldset>

    <!-- Educational Information -->
    <fieldset>
        <legend>Educational Information</legend>
        <div class="form-container">
        <div class="input-group">
            <input type="text" id="university" name="university" class="small-input" value="{{ $user->university }}" required placeholder=" ">
            <label for="university">University</label>
        </div>
        <div class="input-group">
    <select id="year" name="year"  required>
        <option value="" disabled selected></option>
        <option value="1st">1st year</option>
        <option value="2nd">2nd year</option>
        <option value="3rd">3rd year</option>
        <option value="4th">4th year</option>
    </select>
    <label for="year">Year</label>
</div>

<div class="input-group">
    <select id="semester" name="semester" required>
        <option value="" disabled selected></option>
        <option value="1st">1st sem</option>
        <option value="2nd">2nd sem</option>
    </select>
    <label for="semester">Semester</label>
</div>
        <div class="input-group">
            <input type="text" id="course" name="course" class="small-input1" value="{{ $user->course }}" required placeholder=" ">
            <label for="course">Course</label>
        </div>
    </fieldset>

    <!-- Account Security -->
    <fieldset>
    <legend>Account Security</legend>
    <div class="form-container1">
        <div class="input-group1">
            <div class="otp-container">
                <input type="text" id="otp" name="otp" maxlength="6" placeholder=" " disabled>
                <label for="otp">Enter OTP</label>
                <button type="button" class="btn btn-secondary" id="sendOtp">Send OTP</button>
            </div>
            <span id="otpStatus" class="text-danger"></span>
        </div>

        <div class="password-container">
            <div class="input-group1">
                <input type="password" id="password" name="password" placeholder=" " disabled>
                <label for="password">New Password</label>
            </div>

            <div class="input-group1">
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder=" " disabled>
                <label for="password_confirmation">Confirm Password</label>
            </div>
        </div>
    </div>
</fieldset>
    
    <button type="submit">Update</button>
</form>


    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    var logoutUrl = "{{ route('logout') }}";
    var sendURL = "{{ route('send.otp') }}";
    var verifyURL = "{{ route('verify.otp') }}";
</script>
<script>
   
</script>
<script src="{{ asset('js/login.js') }}"></script>
<script src="{{ asset('js/userdash.js') }}"></script>
</body>
</html>
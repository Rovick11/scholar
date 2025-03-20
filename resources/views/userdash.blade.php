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
        <li><a href="{{ route('user_renewal') }}"><i class="fas fa-redo"></i> Renewal & Reapplication </a></li>
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
        <h2>Personal Information</h2>
        <form id="updateForm" action="{{ route('userprofile.update', ['id' => $user->id ?? 0]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PUT for updating data -->

            <div class="input-group">
                <label for="last-name">Last Name</label>
                <input type="text" id="last-name" name="last_name" value="{{ $user->lastName }}" required>
            </div>

            <div class="input-group">
                <label for="first-name">First Name</label>
                <input type="text" id="first-name" name="first_name" value="{{ $user->firstName }}" required>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="input-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" value="{{ $user->contactNo }}" required>
            </div>

            <div class="input-group">
                <label for="birth-date">Birth Date</label>
                <input type="date" id="birth-date" name="birth_date" value="{{ $user->birthDate }}" required>
            </div>

            
          

            <!-- OTP Input -->
            <div class="input-group1">
                <label for="otp" class="form-label">Enter OTP</label>
                <input type="text" id="otp" name="otp" class="form-control" maxlength="6" disabled>
                <span id="otpStatus" class="text-danger"></span> <!-- Display OTP validation -->
                <button type="button" class="btn btn-secondary" id="sendOtp">Send otp</button>
                
            </div>

          

            <!-- New Password Fields -->
            <div class="input-group">
                <label for="password" class="form-label">New Password</label>
                <input type="password" id="password" name="password" class="form-control" disabled>
            </div>

            <div class="input-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" disabled>
            </div>


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
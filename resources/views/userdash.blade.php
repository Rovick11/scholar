<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/userdash.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
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
            <li><a href="shortlist.php"><i class="fas fa-file-alt"></i> Acceptance Form</a></li>
            <li><a href="notify.php"><i class="fas fa-redo"></i> Renewal & Reapplication </a></li>
        </ul>
        <div class="bottom-links">
            <ul>
                <li><a href="contact.php"><i class="fas fa-comments"></i> Communication & Support </a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
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
<!-- Overlay Background -->
<div id="overlay" class="overlay" onclick="closePopup()"></div>

<!-- Pop-up Box -->
<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <h2>Personal Information</h2>

        <div class="input-group">
            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" value="Doe">
        </div>

        <div class="input-group">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" value="John">
        </div>

        <div class="input-group">
            <label for="middle-name">Middle Name</label>
            <input type="text" id="middle-name" value="Michael">
        </div>

        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" value="johndoe@example.com">
        </div>

        <div class="input-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" value="09123456789">
        </div>

        <div class="input-group">
            <label for="birth-date">Birth Date</label>
            <input type="date" id="birth-date" value="2000-01-01">
        </div>

        <button onclick="saveDetails()">Save</button>
    </div>
</div>
<script src="{{ asset('js/userdash.js') }}"></script>
</body>
</html>
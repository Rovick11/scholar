<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset(path: 'css/admin_navbar.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span class="logo-text">SCHOLAR</span>
            <img src="{{ asset('images/logo1.png') }}" alt="Logo">
        </div>
        <ul>
            <li><a href="{{ route('admindash') }}"><i class="fas fa-calendar-plus"></i> Add New Semester</a></li>
            <li><a href="{{ route('admindash') }}"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('admin_scholarMan') }}"><i class="fas fa-file-alt"></i> Scholar Management</a></li>
            <li><a href="{{ route('admin_userAppMan') }}"><i class="fas fa-check-circle"></i> User and Application
                    Management</a></li>
            <li><a href="{{ route('admin_scholarAward') }}"><i class="fas fa-award"></i> Scholarship Award Dashboard</a>
            </li>
            <li><a href="{{ route('admin_reportAna') }}"><i class="fas fa-chart-line"></i> Reports & Analytics</a></li>
        </ul>
        <div class="bottom-links">
            <ul>
                <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="topbar">
        <div class="semester-text">2nd SEMESTER A.Y 2024-2025</div>
        <div class="user-info">
            <div class="notification">🔔</div>
            <img src="user.jpg" alt="User">
            <span>Admin</span>
        </div>
    </div>

    <div class="content">
        <p></p>
    </div>
</body>

</html>

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
        <span class="logo-text">SCHOLAR</span>
        </div>
        <ul>
        <li><a href="applications.php"><i class="fas fa-file-alt"></i> Application Submission</a></li>
        <li><a href="applications.php"><i class="fas fa-upload"></i> Document Upload & Management</a></li>
            <li><a href="verify.php"><i class="fas fa-tasks"></i> Application Status Tracking</a></li>
            <li><a href="review.php"><i class="fas fa-bell"></i> Notifications & Alerts</a></li>
            <li><a href="shortlist.php"><i class="fas fa-trophy"></i> Scholarship Award Dashboard </a></li>
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
        <div class="user-info">
            <div class="notification">🔔</div>
            <img src="{{ asset('images/dp.png') }}" alt="Logo">
        <span class="logo-text">SCHOLAR</span>
        </div>
    </div>

</body>

</html>
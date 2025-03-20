<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admindash.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    @include('admin_navbar')
        <div class="container">
            <div class="stats">
            <a href="{{ route('admin_userAppMan') }}" class="card">
                <i class="fas fa-hourglass-half"></i> Pending Applications <span>10</span>
            </a>
            <a href="{{ route('admin_reportAna') }}" class="card">
                <i class="fas fa-award"></i> Awarded Scholarships <span>5</span>
            </a>
            <a href="{{ route('admin_reportAna') }}" class="card">
                <i class="fas fa-users"></i> Total Users <span>5</span>
            </a>
        </div>
        <div class="activity">
            <h2>Recent System Activity</h2>
            <ul>
                <li>Admin approved an application <span class="timestamp">10 mins ago</span></li>
                <li>New user registered <span class="timestamp">30 mins ago</span></li>
                <li>System backup completed <span class="timestamp">1 hour ago</span></li>
                <li>Notification sent to applicants <span class="timestamp">2 hours ago</span></li>
            </ul>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<style>
    .activity {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        width: 95%;
    }

    .activity h2 {
        font-size: 20px;
        margin-bottom: 15px;
        color: #333;
    }

    .activity ul {
        list-style: none;
        padding: 0;
    }

    .activity ul li {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        display: flex;
        justify-content: space-between;
    }

    .activity ul li:last-child {
        border-bottom: none;
    }

    .activity .timestamp {
        font-size: 12px;
        color: #777;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .sidebar {
        width: 250px;
        background: #007BFF;
        height: 95vh;
        position: fixed;
        left: 5px;
        top: 5px;
        padding-top: 25px;
        border-radius: 20px;
        /* Soft rounded corners */
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        flex-grow: 1;
    }

    .sidebar ul li {
        padding: 15px;
        text-align: left;
        display: flex;
        align-items: center;
    }

    .sidebar ul li a {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        font-size: 16px;
        transition: 0.3s;
    }

    .sidebar ul li a i {
        margin-right: 10px;
    }

    .sidebar ul li a:hover {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
    }

    .sidebar .bottom-links {
        margin-bottom: 20px;
    }

    .sidebar .logo {
        text-align: center;
        margin-bottom: 20px;
    }

    .sidebar .logo img {
        width: 100px;
        height: auto;
    }

    .topbar {
        width: 1225px;
        height: 60px;
        background: white;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 0 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: fixed;
        left: 260px;
        top: 5px;
        border-radius: 20px;
        /* Soft rounded corners */
    }

    .topbar .user-info {
        display: flex;
        align-items: center;
    }

    .topbar img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-left: 15px;
    }

    .topbar .notification {
        font-size: 20px;
        cursor: pointer;
        margin-right: 15px;
    }

    .content {
        margin-left: 250px;
        margin-top: 50px;
        padding: 20px;
        width: calc(100% - 250px);
    }

    .stats {
        display: flex;
        justify-content: space-around;
        margin: 20px 0;
        flex-wrap: wrap;
    }

    .card {
        background: linear-gradient(135deg, #007BFF, #0056b3);
        color: white;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        width: 250px;
        height: auto;
        font-size: 16px;
        font-weight: 600;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .card i {
        font-size: 30px;
        margin-bottom: 10px;
    }
</style>

<body>
    <div class="sidebar">
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="applications.php"><i class="fas fa-file-alt"></i> Application Management</a></li>
            <li><a href="verify.php"><i class="fas fa-check-circle"></i> Document Verification</a></li>
            <li><a href="review.php"><i class="fas fa-star"></i> Review & Scoring</a></li>
            <li><a href="shortlist.php"><i class="fas fa-list"></i> Shortlisting</a></li>
            <li><a href="notify.php"><i class="fas fa-bell"></i> Notification System</a></li>
            <li><a href="reports.php"><i class="fas fa-chart-line"></i> Reports & Analytics</a></li>
        </ul>
        <div class="bottom-links">
            <ul>
                <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="topbar">
        <div class="user-info">
            <div class="notification">🔔</div>
            <img src="user.jpg" alt="User">
            <span>Admin</span>
        </div>
    </div>

    <div class="content">
        <div class="stats">
            <div class="card"><i class="fas fa-hourglass-half"></i> Pending Applications <span>10</span></div>
            <div class="card"><i class="fas fa-award"></i> Awarded Scholarships <span>5</span></div>
            <div class="card"><i class="fas fa-chart-bar"></i> Total Users <span>5</span></div>
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
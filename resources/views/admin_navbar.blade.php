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
            <li><a href="{{ route('admindash') }}"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('admin_addNewSem') }}"><i class="fas fa-calendar-plus"></i> Add New Semester</a></li>
            <li><a href="{{ route('admin_scholarMan') }}"><i class="fas fa-file-alt"></i> Scholar Management</a></li>
            <li><a href="{{ route('admin_userAppMan') }}"><i class="fas fa-check-circle"></i> User and Application
                    Management</a></li>
            <li><a href="{{ route('admin_scholarAward') }}"><i class="fas fa-award"></i> Scholarship Award Dashboard</a>
            </li>
            <li><a href="{{ route('admin_award') }}"><i class="fas fa-file-alt"></i> Scholarship Award Records</a></li>
            <li><a href="{{ route('admin_reportAna') }}"><i class="fas fa-chart-line"></i> Reports & Analytics</a></li>
            <li><a href="{{ route('admin_history') }}"><i class="fas fa-history"></i> History Reports</a></li>
        </ul>
        <div class="bottom-links">
            <ul>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="topbar">
        <div class="semester-text">2nd SEMESTER A.Y 2024-2025</div>
        <div class="user-info">
            <div class="notification">
                <i class="fas fa-bell" onclick="toggleNotifications()"></i>
                <span class="badge">3</span>
                <div class="dropdown-menu" id="notificationDropdown">
                    <h3>Notifications</h3>
                    <ul>
                        <li><a href="#">
                                <p>Your application has been approved.</p><span class="timestamp">March 12, 2025</span>
                            </a></li>
                        <li><a href="#">
                                <p>Upcoming deadline for document submission.</p><span class="timestamp">March 10,
                                    2025</span>
                            </a></li>
                        <li><a href="#">
                                <p>New announcement: Scholarship renewal process.</p><span class="timestamp">March 8,
                                    2025</span>
                            </a></li>
                    </ul>
                </div>
            </div>
            <img src="{{ asset('images/dp.png') }}" alt="Profile Picture">
            <span class="clickable" onclick="openPopup()">Admin</span>
        </div>
    </div>

    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Personal Information</h2>
            <form id="updateForm" action="{{ route('userprofile.update', ['id' => $user->id ?? 0]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="input-group"><label for="last-name">Last Name</label><input type="text" id="last-name"
                        name="last_name" required></div>
                <div class="input-group"><label for="first-name">First Name</label><input type="text" id="first-name"
                        name="first_name" required></div>
                <div class="input-group"><label for="email">Email</label><input type="email" id="email" name="email"
                        required></div>
                <div class="input-group"><label for="phone">Phone Number</label><input type="text" id="phone"
                        name="phone" required></div>
                <div class="input-group"><label for="birth-date">Birth Date</label><input type="date" id="birth-date"
                        name="birth_date" required></div>
                <button type="submit">Update</button>
            </form>
        </div>
    </div>

    <script>
        function toggleNotifications() {
            var dropdown = document.getElementById('notificationDropdown');
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
        }

        window.onclick = function (event) {
            if (!event.target.matches('.notification, .notification *')) {
                var dropdown = document.getElementById('notificationDropdown');
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            }
        }

        function openPopup() {
            document.getElementById("popup").style.display = "block";
        }

        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }
    </script>
</body>

</html>
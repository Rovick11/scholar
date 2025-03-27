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
            <img src="{{ asset('images/dp.png') }}" alt="Profile Picture">
            <span class="clickable" onclick="openPopup()">Admin</span>
        </div>
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

                <div class="input-group">
                    <label for="address">Address</label>
                    <select id="barangay" name="barangay" required>
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
                </div>

                <div class="input-group">
                    <label for="sex">sex:</label>
                    <select id="sex" name="sex" style="width: 110px;">

                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
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
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        disabled>
                </div>

                <button type="submit">Update</button>
            </form>
        </div>
    </div>

    <script>
        function toggleNotifications() {
            var dropdown = document.getElementById('notificationDropdown');
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
        }

        // Close the dropdown if clicked outside
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
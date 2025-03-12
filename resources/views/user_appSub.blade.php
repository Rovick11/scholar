<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Submission</title>
    <link rel="stylesheet" href="{{ asset('css/user_appSub.css') }}">

</head>
<body>
@include('userdash')
    <div class="content">
        <h1>Application Submission</h1>
        <form action="submit_application.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
            <label for="text">Full Name</label>
                <input type="text" placeholder="Full Name" id="name" name="name" required>
            </div>
            <label for="email">Email Address</label>
            <div class="form-group">
                <input type="email" placeholder="Email Address" id="email" name="email" required>
            </div>
            <label for="contact">Phone Number</label>
<div class="form-group phone-group">
    <span class="phone-prefix">+63</span>
    <input type="tel" id="contact" name="contact" pattern="[0-9]{10}" placeholder="9123456789"
maxlength="10" required class="phone-input">
</div>

            <label for="file">Certificate of Registration</label>
            <div class="form-group">
                <input type="file" id="cor" name="cor" accept=".pdf,.doc,.docx,.jpg,.png" required>
            </div>
            <label for="file">Grades Form</label>
            <div class="form-group">
                <input type="file" id="grades" name="grades" accept=".pdf,.doc,.docx,.jpg,.png" required>
            </div>
            <label for="file">Indigency Certificate</label>
            <div class="form-group">
                <input type="file" id="indigency" name="indigency" accept=".pdf,.doc,.docx,.jpg,.png" required>
            </div>

            <input type="submit" value="Submit Application" class="submit-btn">
        </form>
    </div>
</body>
</html>

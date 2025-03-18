<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Submission</title>
    <link rel="stylesheet" href="{{ asset('css/user_renewal.css') }}">
    </head>
<body>
@include('userdash')
    <div class="content">
        <h1>Renewal Submission</h1>
        <form action="submit_application.php" method="POST" enctype="multipart/form-data">

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

            <input type="submit" value="Submit Reapplication" class="submit-btn">
        </form>
    </div>
</body>
</html>

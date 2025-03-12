<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Status Tracking</title>
    <link rel="stylesheet" href="{{ asset('css/user_appStatus.css') }}">

</head>
<body>
@include('userdash')
<div class="content">
        <h1>Application Status Tracking</h1>
        <table>
            <tr>
                <th>Uploaded Files</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>Certificate of Registration.pdf</td>
                <td rowspan="3" class="date">March 12, 2025</td>
                <td rowspan="3" class="pending">Pending</td>
            </tr>
            <tr>
                <td>Grades Form.pdf</td>
            </tr>
            <tr>
                <td>Indigency Certificate.pdf</td>
            </tr>
        </table>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Award Records</title>
    <link rel="stylesheet" href="{{ asset('css/admin_award.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    @include('admin_navbar')

    <div class="container">
        <h2>Scholarship Award Records</h2>

        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Date of Claim</th>
                    <th>Amount Received</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="Student Name">John Doe</td>
                    <td data-label="Date of Claim">March 15, 2025</td>
                    <td data-label="Amount Received">$1,500</td>
                </tr>
                <tr>
                    <td data-label="Student Name">Jane Smith</td>
                    <td data-label="Date of Claim">March 15, 2025</td>
                    <td data-label="Amount Received">$1,200</td>
                </tr>
                <tr>
                    <td data-label="Student Name">Michael Johnson</td>
                    <td data-label="Date of Claim">March 14, 2025</td>
                    <td data-label="Amount Received">$1,800</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>
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
                    <th>Barangay</th>
                    <th>Amount Received</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Date of Claim</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="Student Name">John Doe</td>
                    <td data-label="Barangay">Nasugbu</td>
                    <td data-label="Amount Received">$1,500</td>
                    <td data-label="Email">John@gmail.com</td>
                    <td data-label="Contact Number">09476458293</td>
                    <td data-label="Date of Claim">March 15, 2025</td>
                </tr>
                <tr>
                <td data-label="Student Name">John Doe</td>
                    <td data-label="Barangay">Nasugbu</td>
                    <td data-label="Amount Received">$1,500</td>
                    <td data-label="Email">John@gmail.com</td>
                    <td data-label="Contact Number">09476458293</td>
                    <td data-label="Date of Claim">March 15, 2025</td>
                </tr>
                <tr>
                <td data-label="Student Name">John Doe</td>
                    <td data-label="Barangay">Nasugbu</td>
                    <td data-label="Amount Received">$1,500</td>
                    <td data-label="Email">John@gmail.com</td>
                    <td data-label="Contact Number">09476458293</td>
                    <td data-label="Date of Claim">March 15, 2025</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>
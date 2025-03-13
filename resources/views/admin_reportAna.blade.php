<!DOCTYPE html>
<html>

<head>
    <title>Reports & Analytics</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset(path: 'css/admin_reportAna.css') }}">
</head>

<body>
    @include('admin_navbar')
    <div class="container">
        <div class="stats">
            <div class="card"><i class="fas fa-user-edit"></i> Applied Scholars <span>50</span></div>
            <div class="card"><i class="fas fa-times-circle"></i> Rejected <span>15</span></div>
            <div class="card"><i class="fas fa-check-circle"></i> Accepted <span>35</span></div>
            <div class="card"><i class="fas fa-money-bill-wave"></i> Fund Usage <span>₱10,000</span></div>
        </div>

        <h2>Scholarship Reports</h2>
        <table class="report-table">
            <thead>
                <tr>
                    <th>Scholar Name</th>
                    <th>Status</th>
                    <th>Amount Awarded</th>
                    <th>Demographics</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Juan Dela Cruz</td>
                    <td>Accepted</td>
                    <td>₱2,000</td>
                    <td>Male, 18, NCR</td>
                </tr>
                <tr>
                    <td>Maria Santos</td>
                    <td>Rejected</td>
                    <td>₱0</td>
                    <td>Female, 19, Region 4</td>
                </tr>
                <tr>
                    <td>Carlos Reyes</td>
                    <td>Accepted</td>
                    <td>₱2,500</td>
                    <td>Male, 20, Region 3</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
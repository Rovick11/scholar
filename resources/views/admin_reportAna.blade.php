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
        <div class="card" data-filter="all">
            <i class="fas fa-user-edit"></i> Applied Scholars 
            <span>{{ $scholarReports->count() }}</span>
        </div>
        <div class="card" data-filter="rejected">
            <i class="fas fa-times-circle"></i> Rejected 
            <span>{{ $scholarReports->where('status', 'rejected')->count() }}</span>
        </div>
        <div class="card" data-filter="approved">
            <i class="fas fa-check-circle"></i> Approved 
            <span>{{ $scholarReports->where('status', 'approved')->count() }}</span>
        </div>
        <div class="card">
            <i class="fas fa-money-bill-wave"></i> Fund Usage 
            <span>₱{{ number_format($scholarReports->where('status', 'approved')->count() * 5000, 2) }}</span>
        </div>
    </div>
        <h2>Scholarship Reports</h2>
        <table class="report-table">
            <thead>
                <tr>
                    <th>Scholar Name</th>
                    <th>Status</th>
                    <th>Demographics</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scholarReports as $report)
                    <tr data-status="{{ strtolower($report->status) }}">
                        <td>{{ $report->firstName }} {{ $report->lastName }}</td>
                        <td>{{ ucfirst($report->status) }}</td>
                        <td>{{ $report->sex }}, {{ \Carbon\Carbon::parse($report->birthDate)->age }}, {{ $report->barangay }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', function () {
                const filter = this.getAttribute('data-filter');
                document.querySelectorAll('tbody tr').forEach(row => {
                    if (filter === 'all' || row.getAttribute('data-status') === filter) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>
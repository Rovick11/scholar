<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Award List</title>
    <link rel="stylesheet" href="{{ asset('css/admin_scholarAward.css') }}">

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".claim-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const row = this.closest("tr");
                    const userId = row.getAttribute("data-user-id");
                    const amount = 5000; // You can make this dynamic if needed
                    const claimedAt = new Date().toISOString().split("T")[0]; // Format: YYYY-MM-DD

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    fetch('/claim-scholarship', {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken
                        },
                        body: JSON.stringify({
                            user_id: userId,
                            amount: amount,
                            claimed_at: claimedAt
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
    if (data.success) {
        alert("Scholarship claimed successfully!");
        row.remove(); // Remove the row from the table
    } else {
        alert("Error: " + data.message);
    }
})

                    .catch(error => {
                        console.error("Fetch Error:", error);
                        alert("Something went wrong.");
                    });
                });
            });
        });
    </script>
</head>

<body>
    @include('admin_navbar')

    <div class="container">
        <h2>Scholarship Award List</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($showApproved as $approved)
                <tr data-user-id="{{ $approved->id }}">
                    <td>{{ $approved->firstName }} {{ $approved->lastName }}</td>
                    <td>{{ $approved->email }}</td>
                    <td>{{ $approved->contactNo }}</td>
                    <td>
                        <button class="claim-btn">Claim</button>
                        <span class="claim-date" style="margin-left: 10px;"></span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Award List</title>
    <link rel="stylesheet" href="{{ asset('css/admin_scholarAward.css') }}">
    <script>
        function claimScholarship(button) {
            let row = button.parentElement.parentElement;
            let dateCell = row.querySelector(".claim-date");

            if (!button.disabled) {
                button.innerText = "Claimed";
                button.classList.add("claimed");
                button.disabled = true;
                let currentDate = new Date().toLocaleDateString();
                dateCell.innerText = currentDate;
            }
        }
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
                @foreach($showApproved as $approved) <!-- Change here -->
                    <tr data-status="{{ strtolower($approved->status) }}">
                        <td>{{ $approved->firstName }} {{ $approved->lastName }}</td>
                        <td>{{ ucfirst($approved->email) }}</td>
                        <td>{{ ucfirst($approved->contactNo) }}</td>
                        <td>
                            <button onclick="claimScholarship(this)">Claim</button>
                            <span class="claim-date"></span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
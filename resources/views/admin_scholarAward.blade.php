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
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Contact</th>
                    <th>Action</th>
                    <th>Date Claimed</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>johndoe@example.com</td>
                    <td>123-456-7890</td>
                    <td><button onclick="claimScholarship(this)">Claim</button></td>
                    <td class="claim-date"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jane Smith</td>
                    <td>janesmith@example.com</td>
                    <td>098-765-4321</td>
                    <td><button onclick="claimScholarship(this)">Claim</button></td>
                    <td class="claim-date"></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
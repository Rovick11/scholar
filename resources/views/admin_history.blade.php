<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Report</title>
    <link rel="stylesheet" href="{{ asset('css/admin_history.css') }}">
</head>

<body>
    @include ('admin_navbar')
    <div class="container">
        <h2>History Report</h2>
        <div class="filter-section">
            <select id="semester">
                <option value="Semester">Semester</option>
                <option value="First">First</option>
                <option value="Second">Second</option>
            </select>

            <select id="year">
                <option value="Year">Year</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
            </select>

            <button onclick="filterHistory()">Apply Filter</button>
        </div>

        <table>
            <tr>
                <th>Grantees</th>
                <th>Semester</th>
                <th>Year</th>
                <th>Date</th>
            </tr>
        </table>
    </div>

    <script>
        function filterHistory() {
            let semester = document.getElementById("semester").value;
            let year = document.getElementById("year").value;
            let rows = document.querySelectorAll("table tr");

            rows.forEach((row, index) => {
                if (index === 0) return;
                let rowSemester = row.cells[1].textContent.toLowerCase();
                let rowYear = row.cells[2].textContent;

                if ((semester === "all" || rowSemester === semester) && (year === "all" || rowYear === year)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
</body>

</html>
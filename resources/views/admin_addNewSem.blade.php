<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Semester</title>
    <link rel="stylesheet" href="{{ asset('css/admin_addNewSem.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
    @include('admin_navbar')
    <div class="container">
        <h2>Add New Semester</h2>
        <form action="#" method="post">
            <label for="semester">Semester:</label>
            <select id="semester" name="semester" required>
                <option value="First">First</option>
                <option value="Second">Second</option>
            </select>

            <label for="start-date">Start Date:</label>
            <input type="date" id="start-date" name="start_date" required>

            <label for="end-date">End Date:</label>
            <input type="date" id="end-date" name="end_date" required>

            <button type="submit">Add Semester</button>
        </form>
    </div>
</body>

</html>
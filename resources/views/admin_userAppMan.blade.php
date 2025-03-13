<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin_userAppMan.css') }}">
    <title>User & Application Management</title>
</head>

<body>
    @include('admin_navbar')
    <div class="container">
        <table>
            <tr>
                <th>Name</th>
                <th>Uploaded File</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>John Doe</td>
                <td><a href="#" class="file-link">Resume.pdf</a></td>
                <td>2024-03-12</td>
                <td class="status pending">Pending</td>
                <td class="action-buttons">
                    <button class="approve">Approve</button>
                    <button class="reject">Reject</button>
                    <textarea placeholder="Add a comment..."></textarea>
                    <button class="save-comment">Save Comment</button>
                    <button class="edit">Edit</button>
                </td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td><a href="#" class="file-link">Portfolio.pdf</a></td>
                <td>2024-03-10</td>
                <td class="status under-review">Under Review</td>
                <td class="action-buttons">
                    <button class="approve">Approve</button>
                    <button class="reject">Reject</button>
                    <textarea placeholder="Add a comment..."></textarea>
                    <button class="save-comment">Save Comment</button>
                    <button class="edit">Edit</button>
                </td>
            </tr>
        </table>
    </div>

    <script>
        document.querySelectorAll('.reject').forEach(button => {
            button.addEventListener('click', function () {
                let row = this.closest('tr');
                let commentBox = row.querySelector('textarea');
                let saveBtn = row.querySelector('.save-comment');
                let editBtn = row.querySelector('.edit');

                // Show comment box, save button, and edit button
                commentBox.style.display = 'block';
                saveBtn.style.display = 'block';
                editBtn.style.display = 'block';
            });
        });

        document.querySelectorAll('.approve').forEach(button => {
            button.addEventListener('click', function () {
                let row = this.closest('tr');
                let status = row.querySelector('.status');
                let commentBox = row.querySelector('textarea');
                let saveBtn = row.querySelector('.save-comment');
                let editBtn = row.querySelector('.edit');

                // Change status to Approved
                status.textContent = 'Approved';
                status.classList = 'status approved';

                // Hide comment-related elements
                commentBox.style.display = 'none';
                saveBtn.style.display = 'none';
                editBtn.style.display = 'none';

                // Disable all action buttons after approval
                button.disabled = true;
                row.querySelector('.reject').disabled = true;
            });
        });

        document.querySelectorAll('.save-comment').forEach(button => {
            button.addEventListener('click', function () {
                let row = this.closest('tr');
                let commentBox = row.querySelector('textarea');
                let status = row.querySelector('.status');
                let editBtn = row.querySelector('.edit');

                if (commentBox.value.trim() === '') {
                    alert('Please enter a comment before saving.');
                    return;
                }

                // Change status to Rejected
                status.textContent = 'Rejected';
                status.classList = 'status rejected';

                alert('Comment saved: ' + commentBox.value);

                // Disable comment box and save button
                commentBox.disabled = true;
                button.disabled = true;
                row.querySelector('.reject').disabled = true;

                // Show edit button for rejected comments
                editBtn.style.display = 'inline-block';
            });
        });

        document.querySelectorAll('.edit').forEach(button => {
            button.addEventListener('click', function () {
                let row = this.closest('tr');
                let commentBox = row.querySelector('textarea');
                let saveBtn = row.querySelector('.save-comment');

                // Enable editing
                commentBox.disabled = false;
                saveBtn.disabled = false;
            });
        });
    </script>
</body>

</html>
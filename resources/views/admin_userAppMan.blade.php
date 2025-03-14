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
                <th>Uploaded Files</th>
                <th>Date Submitted</th>
                <th>Actions</th>
            </tr>
            @foreach ($submissions as $submission)
                <tr>
                    <td>{{ $submission->user->firstName . ' ' . $submission->user->lastName }}</td>
                    <td>
                        <a href="{{ Storage::url($submission->COR) }}" class="file-link">COR</a>
                        <a href="{{ Storage::url($submission->gradesForm) }}" class="file-link">Grades</a>
                        <a href="{{ Storage::url($submission->indigency_Certificate) }}" class="file-link">Indigency</a>
                    </td>
                    <td>{{ $submission->created_at->format('Y-m-d') }}</td>
                    <td class="action-buttons">
                        <button class="approve" data-id="{{ $submission->id }}">Approve</button>
                        <button class="reject" data-id="{{ $submission->id }}">Reject</button>
                        <textarea placeholder="Add a comment..."></textarea>
                        <button class="save-comment" data-id="{{ $submission->id }}">Save Comment</button>
                        <button class="edit" data-id="{{ $submission->id }}">Edit</button>
                    </td>
                </tr>
            @endforeach
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
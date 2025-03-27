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
                        <a href="{{ Storage::url($submission->indigencyCertificate) }}" class="file-link">Indigency</a>
                    </td>
                    <td>{{ $submission->created_at->format('Y-m-d') }}</td>
                    <td class="action-buttons">
                        <button class="approve" data-id="{{ $submission->id }}">Approve</button>
                        <button class="reject" data-id="{{ $submission->id }}">Reject</button>
                        <textarea placeholder="Add a comment..." style="display:none;"></textarea>
                        <!--<button class="save-comment" data-id="{{ $submission->id }}" style="display:none;">Save Comment</button>
                        <button class="edit" data-id="{{ $submission->id }}" style="display:none;">Edit</button>-->
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
            //let saveBtn = row.querySelector('.save-comment');
            //let editBtn = row.querySelector('.edit');

            // Show comment box, save button, and edit button
            commentBox.style.display = 'block';
            //saveBtn.style.display = 'block';
            //editBtn.style.display = 'block';
        });
    });

    document.querySelectorAll('.approve').forEach(button => {
        button.addEventListener('click', function () {
            // Confirmation dialog
            if (!confirm('Are you sure you want to approve this submission?')) {
                return; // Exit if the user clicks "Cancel"
            }

            let row = this.closest('tr');
            let submissionId = this.getAttribute('data-id'); // Get the submission ID
            let commentBox = row.querySelector('textarea');
            //let saveBtn = row.querySelector('.save-comment');
            //let editBtn = row.querySelector('.edit');

            // Send AJAX request to update the status
            fetch(`/submissions/${submissionId}/approve`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
                },
                body: JSON.stringify({ status: 'approved' }) // Send the new status
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Optionally, you can show a success message
                    alert('Submission approved successfully.');

                    // Hide comment-related elements
                    commentBox.style.display = 'none';
                    //saveBtn.style.display = 'none';
                    //editBtn.style.display = 'none';

                    // Disable all action buttons after approval
                    button.disabled = true;
                    row.querySelector('.reject').disabled = true;
                } else {
                    alert('Failed to approve submission: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while approving the submission.');
            });
        });
    });
    document.addEventListener('click', function (event) {
    if (event.target.classList.contains('reject')) {
        console.log('Reject button clicked!');
        
        let row = event.target.closest('tr');
        let submissionId = event.target.getAttribute('data-id');
        let commentBox = row.querySelector('textarea');

        if (commentBox.value.trim() === '') {
            alert('Please enter a comment before rejecting.');
            return;
        }

        fetch(`/submissions/${submissionId}/reject`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                comment: commentBox.value.trim()
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Submission rejected successfully.');
                row.querySelector('.approve').disabled = true;
                event.target.disabled = true;
                commentBox.disabled = true;
                //row.querySelector('.save-comment').disabled = true;
                //row.querySelector('.edit').style.display = 'inline-block';
            } else {
                alert('Failed to reject submission: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while rejecting the submission.');
        });
    }
});

    document.querySelectorAll('.save-comment').forEach(button => {
        button.addEventListener('click', function () {
            let row = this.closest('tr');
            let commentBox = row.querySelector('textarea');
            //let editBtn = row.querySelector('.edit');

            if (commentBox.value.trim() === '') {
                alert('Please enter a comment before saving.');
                return;
            }

            // Optionally, you can show a success message
            alert('Comment saved: ' + commentBox.value);

            // Disable comment box and save button
            commentBox.disabled = true;
            button.disabled = true;
            row.querySelector('.reject').disabled = true;

            // Show edit button for rejected comments
            //editBtn.style.display = 'inline-block';
        });
    });

    document.querySelectorAll('.edit').forEach(button => {
        button.addEventListener('click', function () {
            let row = this.closest('tr');
            let commentBox = row.querySelector('textarea');
            //let saveBtn = row.querySelector('.save-comment');

            // Enable editing
            commentBox.disabled = false;
            //saveBtn.disabled = false;
        });
    });
    


</script>
</body>

</html>
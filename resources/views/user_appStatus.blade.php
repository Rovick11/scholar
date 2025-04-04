<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Status Tracking</title>
    <link rel="stylesheet" href="{{ asset('css/user_appStatus.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> <!-- Font Awesome for icons -->
</head>
<body>

@include('userdash')

<div class="content">
    <h1>Application Status Tracking</h1>
    <table id="appTable" class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Status</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $application)
                @php
                    $files = [
                        'Certificate of Registration.pdf' => $application->COR,
                        'Grades Form.pdf' => $application->gradesForm,
                        'Indigency Certificate.pdf' => $application->indigencyCertificate
                    ];
                    $filteredFiles = array_filter($files); // Remove empty entries
                @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($application->created_at)->format('F d, Y') }}</td>
                    <td class="status-cell">{{ ucfirst($application->status) }}</td>
                    <td>{{ $application->remarks }}</td>
                    <td>
                        @if (!empty($filteredFiles))
                            <button class="btn btn-primary btn-sm view-files" data-files="{{ json_encode($filteredFiles) }}">
                                <i class="fa-solid fa-folder-open"></i> View Files
                            </button>
                        @else
                            <span class="text-muted">No files</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalLabel">Uploaded Files</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="fileList" class="d-flex justify-content-start flex-nowrap overflow-auto gap-4"> <!-- One Row Layout -->
                    <!-- Icons will be injected here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('#appTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [5, 10, 25, 50],
            "pageLength": 5
        });

        $(".status-cell").each(function () {
            let statusText = $(this).text().trim().toLowerCase();
            if (statusText === "pending") {
                $(this).css({"background-color": "yellow", "color": "black", "font-weight": "bold"});
            } else if (statusText === "rejected" || statusText === "resubmit") {
                $(this).css({"background-color": "red", "color": "white", "font-weight": "bold"});
            } else if (statusText === "approved") {
                $(this).css({"background-color": "green", "color": "white", "font-weight": "bold"});
            }
        });

        // Handle View Files button click
        $('.view-files').on('click', function () {
            let files = JSON.parse($(this).attr('data-files'));
            let fileList = $("#fileList");
            fileList.empty();

            $.each(files, function(name, path) {
                let fileUrl = "{{ asset('storage/') }}/" + path;
                fileList.append(`
                    <a href="${fileUrl}" target="_blank" class="text-decoration-none">
                        <div class="text-center">
                            <i class="fa-solid fa-file-pdf fa-3x text-danger"></i> <!-- Icon for PDF -->
                            <p class="small text-dark">${name}</p> <!-- File Name -->
                        </div>
                    </a>
                `);
            });

            $('#fileModal').modal('show');
        });
    });
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document Upload & Management</title>
    <link rel="stylesheet" href="{{ asset('css/user_docUpload.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @include('userdash')
    <div class="content">
        <h1>Document Upload & Management</h1>
        <table>
            <tr>
                <th>No. of Files</th>
                <th>File Names</th>
                <th>Action</th>
            </tr>
            @if($application) 
                @php
                    $files = [
                        'Certificate of Registration.pdf' => $application->COR ?? '',
                        'Grades Form.pdf' => $application->gradesForm ?? '',
                        'Indigency Certificate.pdf' => $application->indigencyCertificate ?? ''
                    ];
                    $fileCount = count(array_filter($files));
                @endphp

                @if($fileCount > 0)
                    @php $firstRow = true; @endphp
                    @foreach($files as $fileName => $filepath)
                        @if(!empty($filepath))
                            <tr>
                                @if($firstRow)
                                    <td rowspan="{{ $fileCount }}">{{ $fileCount }}</td>
                                    @php $firstRow = false; @endphp
                                @endif
                                <td>{{ $fileName }}</td>
                                <td>
                                        <a href="{{ asset('storage/' . $filepath) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        <button class="btn btn-warning btn-sm" onclick="showUpdateForm('{{ $fileName }}')"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">No application documents found.</td>
                    </tr>
                @endif
            @else
                <tr>
                    <td colspan="3">No application documents found.</td>
                </tr>
            @endif
        </table>
      
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Document</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateForm" action="{{ route('document.update', ['id' => $application->id ?? 0]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="document_type" id="document_type">
                            <div class="mb-3">
                                <label for="file" class="form-label">Select new file</label>
                                <input type="file" class="form-control" name="file" required>
                            </div>
                            <button type="submit" class="btn btn-success">Update File</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        


    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/docUpload.js') }}"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document Upload & Management</title>
    <link rel="stylesheet" href="{{ asset('css/user_docUpload.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
                                    <a href="{{ asset('storage/' . $filepath) }}" class="icon-btn"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="icon-btn"><i class="fas fa-edit"></i></a>
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


    </div>
</body>
</html>

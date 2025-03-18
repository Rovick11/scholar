<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Status Tracking</title>
    <link rel="stylesheet" href="{{ asset('css/user_appStatus.css') }}">

</head>
<body>
@include('userdash')
<div class="content">
    <h1>Application Status Tracking</h1>
        <table>
            <tr>
                <th>Uploaded Files</th>
                <th>Date</th>
                <th>Status</th>
                <th>Remarks</th>
            </tr>
            @foreach ($applications as $application)
                @php
                    $files = [
                        'Certificate of Registration.pdf' => $application->COR,
                        'Grades Form.pdf' => $application->gradesForm,
                        'Indigency Certificate.pdf' => $application->indigencyCertificate
                    ];
                @endphp
                @foreach ($files as $fileName => $filePath)
                    @if (!empty($filePath))
                        <tr>
                            <td>{{ $fileName }}</td>
                            @if ($loop->first)
                                <td rowspan="{{ count(array_filter($files)) }}" class="date">
                                    {{ \Carbon\Carbon::parse($application->created_at)->format('F d, Y') }}
                                </td>
                                <td rowspan="{{ count(array_filter($files)) }}" class="{{ strtolower($application->status) }}">
                                    {{ $application->status }}
                                </td>
                                <td rowspan="{{ count(array_filter($files)) }}" class="{{ strtolower($application->remarks) }}">
                                    {{ $application->remarks }}
                                </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </table>
    </div>
</body>
</html>

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
            <tr>
                <td>1</td>
                <td>Certificate of Registration.pdf</td>
                <td>
                    <a href="#" class="icon-btn"><i class="fas fa-eye"></i></a>
                    <a href="#" class="icon-btn"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Grades Form.pdf</td>
                <td>
                    <a href="#" class="icon-btn"><i class="fas fa-eye"></i></a>
                    <a href="#" class="icon-btn"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Indigency Certificate.pdf</td>
                <td>
                    <a href="#" class="icon-btn"><i class="fas fa-eye"></i></a>
                    <a href="#" class="icon-btn"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>

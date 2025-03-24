<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Submission</title>
    <link rel="stylesheet" href="{{ asset('css/user_appSub.css') }}">

</head>
<body>
@include('userdash')
    <div class="content">
        <h1>Application Submission</h1>
        <form id = "appForm" action="{{route('applicationForm')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
            <label for="text">Full Name</label>
                <input type="text" placeholder="Full Name" id="name" name="name" value="{{ $user->firstName . ' ' . $user->lastName }}" readonly required>
            </div>
            <label for="email">Email Address</label>
            <div class="form-group">
                <input type="email" placeholder="Email Address" id="email" name="email" value ="{{ $user->email }}"readonly required>
            </div>
            <label for="contact">Phone Number</label>
            <div class="form-group phone-group">
                <span class="phone-prefix">+63</span>
                <input type="tel" id="contact" name="contact" pattern="[0-9]{10}" placeholder="9123456789"
            maxlength="10" required class="phone-input"  value = "{{$user->contactNo}}"readonly>
            </div>

            <label for="barangay">Barangay</label>
            <div class="form-group">
                <input value ="{{ $user->barangay }}"readonly required>
            </div>
            <label for="sex">sex</label>
            <div class="form-group">
                <input value ="{{ $user->sex }}"readonly required>
            </div>

            <label for="file">Certificate of Registration</label>
            <div class="form-group">
                <input type="file" id="cor" name="cor" accept=".pdf,.doc,.docx,.jpg,.png" required>
            </div>
            <label for="file">Grades Form</label>
            <div class="form-group">
                <input type="file" id="grades" name="grades" accept=".pdf,.doc,.docx,.jpg,.png" required>
            </div>
            <label for="file">Indigency Certificate</label>
            <div class="form-group">
                <input type="file" id="indigency" name="indigency" accept=".pdf,.doc,.docx,.jpg,.png" required>
            </div>
            @php
                $isPending = $applicationStatus === 'pending';
            @endphp
            <input type="button" value="Submit Application" class="submit-btn {{ $isPending ? 'disabled-btn' : '' }}" id="appButton" {{ $isPending ? 'disabled' : '' }}>
        </form>
    </div>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="{{ asset('js/applicationForm.js') }}"></script>
</body>
</html>

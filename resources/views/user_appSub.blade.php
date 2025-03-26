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
       
    <form id = "appForm" action="{{route('applicationForm')}}" method="POST" enctype="multipart/form-data">
    @csrf   
            <div id="step1">
                <h3>Step 1: Personal Information</h3>
                
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Full Name" value="{{ $user->firstName . ' ' . $user->lastName }}" required readonly>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email Address" value ="{{ $user->email }}" required readonly>
                </div>

                <div class="form-group">
                  <label for="phonenumber">Phone Number</label>
                    <div class="phone-group">
                        <span class="phone-prefix">+63</span>
                        <input type="tel" id="contact" name="contact" pattern="[0-9]{10}" placeholder="9123456789" maxlength="10" required class="phone-input" value = "{{$user->contactNo}}" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="barangay">Barangay</label>
                    <input value ="{{ $user->barangay }}"readonly required>
                </div>

                <div class="form-group row">
                    <div class="col">
                        <label for="bdate">Birth Date</label>
                        <input type="text" id="birthdate" name="birthdate" placeholder="MM/DD/YYYY" required readonly>
                    </div>

                    <div class="col">
                        <label for="sex">Sex</label>
                        <input value ="{{ $user->sex }}"readonly required>
                    </div>

                    <div class="col btn-container">
                        <button type="button" id="nextStep" class="btn">Next</button>
                    </div>
                </div>
            </div>

            <div id="step2" style="display: none;">
                <!-- Back button at the top -->
            <div class="back-container">
                <button type="button" id="prevStep" class="back-btn">&larr; </button>
            </div>
                <h3>Step 2: Document Submission</h3>

                <div class="form-group">
                    <label for="cor">Certificate of Registration</label>
                    <input type="file" id="cor" name="cor" accept=".pdf,.doc,.docx,.jpg,.png" required>
                </div>

                <div class="form-group">
                    <label for="grades">Grades Form</label>
                    <input type="file" id="grades" name="grades" accept=".pdf,.doc,.docx,.jpg,.png" required>
                </div>

                <div class="form-group">
                    <label for="indigency">Indigency Certificate</label>
                    <input type="file" id="indigency" name="indigency" accept=".pdf,.doc,.docx,.jpg,.png" required>
                </div>

                @php
                $isPending = $applicationStatus === 'pending';
            @endphp

                <!-- Submit button at the bottom right -->
                <div class="btn-container">
                    <input type="submit" value="Submit Application" class="submit-btn {{ $isPending ? 'disabled-btn' : '' }}" id="appButton" {{ $isPending ? 'disabled' : '' }}>
                </div>
            </div>
        </form>
    </div>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="{{ asset('js/applicationForm.js') }}"></script>
</body>
</html>

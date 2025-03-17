<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/user_acceptForm.css') }}">
    <title>Scholarship Acceptance Letter</title>
    <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
    </head>
<body>
@include('userdash')
    <div class="container">
        <div class="button-container">
            <button class="print-button" onclick="window.print()">Print Letter</button>
        </div>
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="Left Logo">
            <h2>Republic of the Philippines<br>Province of Batangas<br>Nasugbu, Batangas</h2>
            <img src="{{ asset('images/logo1.png') }}" alt="Right Logo">
        </div>
        <div class="letter">
            <h2 style="text-align: center;">Scholarship Acceptance Letter</h2>
            <p>Dear [Recipient's Name],</p>
            <p style="text-align: justify;">We are pleased to inform you that your application for the government scholarship has been approved. This scholarship will be awarded on a first-semester basis, following the guidelines set by the government.</p>
            <p>Please keep this letter as official proof of your scholarship acceptance.</p>
        </div>
        <div class="signature">
            <p>Sincerely,</p>
            <div class="signature-line">Fernando U. Arizobal Jr.</div>
        </div>
    </div>
</body>
</html>    
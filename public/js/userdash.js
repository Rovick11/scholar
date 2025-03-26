$(document).ready(function () {
    const sendOtpButton = $("#sendOtp");
    const sendOtpinput = $("#otp");
    const next = $("#nextStep1");
    let cooldownTime = 30;


    // Ensure CSRF Token is set for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#sendOtp").click(function () {
        console.log("Send OTP button clicked");
        sendOtpButton.prop("disabled", true).text("Sending...");
        let email = $("#email").val();

        if (!email) {
            alert("Please enter an email address.");
            sendOtpButton.prop("disabled", false).text("Send OTP");
            return;
        }

        $.ajax({
            url: sendURL,
            type: "POST",
            data: { email: email },
            success: function (response) {
                console.log("OTP sent successfully:", response);
                sendOtpinput.prop("disabled", false);
                startCooldown(cooldownTime);
                Swal.fire({
                    icon: "success",
                    title: "Otp Sent Successful",
                    confirmButtonColor: "#3085d6",
                    heightAuto: false
                })
            },
            error: function (xhr, status, error) {
                console.log("Error sending OTP:", xhr.responseText);
                $("#otpMessage").text("Failed to send OTP").removeClass("text-success").addClass("text-danger");
                sendOtpButton.prop("disabled", false).text("Send OTP");
            }
        });
    });

    $("#otp").on("input", function () {
        let otp = $(this).val();
        if (otp.length === 6) {
            console.log("Verifying OTP:", otp);
            $.ajax({
                url: verifyURL,
                type: "POST",
                data: { otp: otp },
                success: function (response) {
                    console.log("OTP Verification Response:", response);
                    if (response.success) {
                        $("#otpStatus").text("✅ OTP Verified").removeClass("text-danger").addClass("text-success");
                        $("#password, #password_confirmation").prop("disabled", false);
                        $("#updateBtn").prop("disabled", false);
                        nextBtn.disabled = false;
                    } else {
                        $("#otpStatus").text("❌ Invalid OTP").removeClass("text-success").addClass("text-danger");
                        $("#password, #password_confirmation").prop("disabled", true);
                        $("#updateBtn").prop("disabled", true);
                    }
                },
                error: function (xhr) {
                    console.log("Error verifying OTP:", xhr.responseText);
                    $("#otpStatus").text("❌ Error verifying OTP").addClass("text-danger");
                }
            });
        }
    });

    function startCooldown(seconds) {
        let remainingTime = seconds;
        sendOtpButton.text(`Resend OTP in ${remainingTime}s`);

        let countdown = setInterval(() => {
            remainingTime--;
            sendOtpButton.text(`Resend OTP in ${remainingTime}s`);

            if (remainingTime <= 0) {
                clearInterval(countdown);
                sendOtpButton.prop("disabled", false).text("Send OTP");
            }
        }, 1000);
    }
});


function toggleNotifications() {
    var dropdown = document.getElementById('notificationDropdown');
    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
}

// Close the dropdown if clicked outside
window.onclick = function(event) {
    if (!event.target.matches('.notification, .notification *')) {
        var dropdown = document.getElementById('notificationDropdown');
        if (dropdown.style.display === 'block') {
            dropdown.style.display = 'none';
        }
    }
}

function toggleChatBox() {
    const chatBox = document.getElementById('chatBox');
    if (chatBox.style.display === 'none' || chatBox.style.display === '') {
        chatBox.style.display = 'flex';
    } else {
        chatBox.style.display = 'none';
    }
}

   function showPopup() {
        document.getElementById("popup").style.display = "block";
        document.getElementById("overlay").style.display = "block";
    }

    function closePopup() {
        document.getElementById("popup").style.display = "none";
        document.getElementById("overlay").style.display = "none";
    }

    function saveDetails() {
        let lastName = document.getElementById("last-name").value;
        let firstName = document.getElementById("first-name").value;
        let middleName = document.getElementById("middle-name").value;
        let email = document.getElementById("email").value;
        let phone = document.getElementById("phone").value;
        let birthDate = document.getElementById("birth-date").value;

        alert("Details Saved!\n" +
            "Last Name: " + lastName + "\n" +
            "First Name: " + firstName + "\n" +
            "Middle Name: " + middleName + "\n" +
            "Email: " + email + "\n" +
            "Phone: " + phone + "\n" +
            "Birth Date: " + birthDate);
        
        closePopup();
    }

   
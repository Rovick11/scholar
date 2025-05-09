
$(document).ready(function () {
    $('.login-info-box').fadeOut();
    $('.login-show').addClass('show-log-panel');
    $("#registerButton").click(function (event) {
        event.preventDefault(); // Prevent default button behavior

        let form = $("#registerForm"); // Get the form element
        let formData = form.serialize(); // Serialize form data

        $.ajax({
            url: form.attr("action"), // Get form action URL
            type: "POST",
            data: formData,
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Registration Successful",
                        text: response.message,
                        confirmButtonColor: "#3085d6",
                        heightAuto: false
                    }).then(() => {
                        window.location.reload(); // Optional: Reload after success
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Registration Failed",
                        text: response.message,
                        confirmButtonColor: "#d33",
                        heightAuto: false
                    });
                }
            },
            error: function (xhr) {
                let errorMessage = "An error occurred. Please try again.";

                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        // Handle structured validation errors
                        errorMessage = "<ul>";
                        Object.keys(xhr.responseJSON.errors).forEach(field => {
                            errorMessage += `<li><strong>${field}:</strong> ${xhr.responseJSON.errors[field][0]}</li>`;
                        });
                        errorMessage += "</ul>";
                    } else if (xhr.responseJSON.error) {
                        // Handle generic error messages (e.g., password confirmation mismatch)
                        errorMessage = xhr.responseJSON.error;
                    }
                }

                Swal.fire({
                    icon: "error",
                    title: "Validation Error",
                    html: errorMessage, // Use 'html' to properly format error messages
                    confirmButtonColor: "#d33",
                    heightAuto: false
                });
            }
        });
    });

    $("#loginButton").click(function (event) {
        event.preventDefault(); // Prevent default button behavior
    
        let form = $("#loginForm"); // Get the form element
        let formData = form.serialize(); // Serialize form data
        let loginButton = $("#loginButton"); // Get button element
   
        loginButton.prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Logging in...');
    
        $.ajax({
            url: form.attr("action"), // Get form action URL
            type: "POST",
            data: formData,
            success: function (response) {
                if (response.success) {
                    form[0].reset();
                    Swal.fire({
                        icon: "success",
                        title: "Login Successful",
                        confirmButtonColor: "#3085d6",
                        heightAuto: false
                    }).then(() => {
                        if (response.role === "superAdmin" || response.role === "admin") {
                            window.location.href = "/admindash";
                        } else if (response.role === "user") {
                            window.location.href = "/userdash";
                        }
                    });
                } else {
                    if (response.role === "pending") {
                        Swal.fire({
                            icon: "warning",
                            title: "Your account is pending approval",
                            text: "Please wait for an administrator to approve your account.",
                            confirmButtonColor: "#f1c40f",
                            heightAuto: false
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Login Failed",
                            text: response.message,
                            confirmButtonColor: "#d33",
                            heightAuto: false
                        });
                    }
                }
            },
            error: function (xhr) {
                let errorMessage = "An error occurred. Please try again.";
    
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        // Handle structured validation errors
                        errorMessage = "<ul>";
                        Object.keys(xhr.responseJSON.errors).forEach(field => {
                            errorMessage += `<li><strong>${field}:</strong> ${xhr.responseJSON.errors[field][0]}</li>`;
                        });
                        errorMessage += "</ul>";
                    } else if (xhr.responseJSON.error) {
                        // Handle generic error messages (e.g., password confirmation mismatch)
                        errorMessage = xhr.responseJSON.error;
                    }
                }
    
                Swal.fire({
                    icon: "error",
                    title: "Validation Error",
                    html: "Incorrect Credentials", // Use 'html' to properly format error messages
                    confirmButtonColor: "#d33",
                    heightAuto: false
                });
            },
            complete: function () {
                // Re-enable button and restore original text
                loginButton.prop("disabled", false).html("Login");
            }
        });
    });
    

    $("#logoutButton").click(function (event) {
        event.preventDefault(); // Prevent default link behavior

        Swal.fire({
            title: "Are you sure?",
            text: "You will be logged out.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, logout"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: logoutUrl, // Laravel logout route
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") // Correct CSRF token
                    },
                    success: function () {
                        Swal.fire({
                            icon: "success",
                            title: "Logged out successfully",
                            confirmButtonColor: "#3085d6",
                            heightAuto: false
                        }).then(() => {
                            window.location.href = "/"; // Redirect after logout
                        });
                    },
                    error: function () {
                        Swal.fire({
                            icon: "error",
                            title: "Logout Failed",
                            text: "Something went wrong. Please try again.",
                            confirmButtonColor: "#d33",
                            heightAuto: false
                        });
                    }
                });
            }
        });
    });

    $(document).ready(function () {
        $("#updateForm").submit(function (event) {
            event.preventDefault(); // Prevent default form submission
    
            const form = $(this);
            const formData = new FormData(this);
    
            console.log("Form submission intercepted.");
            console.log("Form action URL:", form.attr("action"));
    
            // Show confirmation prompt before updating
            Swal.fire({
                title: "Are you sure?",
                text: "Do you really want to update this file?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("User confirmed update. Sending AJAX request...");
    
                    $.ajax({
                        url: form.attr("action"),
                        type: "POST", // Use POST instead of PUT
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: { "X-HTTP-Method-Override": "PUT" },
                        success: function (response) {
                            console.log("AJAX request successful.");
                            console.log("Response:", response);
    
                            if (response.success) {
                                form[0].reset();
                                Swal.fire({
                                    icon: "success",
                                    title: "User Profile Updated Successfully",
                                    confirmButtonColor: "#3085d6",
                                    heightAuto: false
                                }).then(() => {
                                    console.log("Redirecting to /userdash...");
                                    window.location.href = "/userdash";
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX request failed.");
                            console.error("Status:", status);
                            console.error("Error:", error);
                            console.error("XHR response:", xhr);
    
                            let errorMessage = "An error occurred. Please try again.";
    
                            if (xhr.responseJSON) {
                                console.error("XHR responseJSON:", xhr.responseJSON);
    
                                if (xhr.responseJSON.errors) {
                                    errorMessage = "<ul>";
                                    Object.keys(xhr.responseJSON.errors).forEach(field => {
                                        console.error(`Error in field '${field}':`, xhr.responseJSON.errors[field][0]);
                                        errorMessage += `<li><strong>${field}:</strong> ${xhr.responseJSON.errors[field][0]}</li>`;
                                    });
                                    errorMessage += "</ul>";
                                } else if (xhr.responseJSON.error) {
                                    errorMessage = xhr.responseJSON.error;
                                }
                            }
    
                            Swal.fire({
                                icon: "error",
                                title: "Update Failed",
                                html: errorMessage,
                                confirmButtonColor: "#d33",
                                heightAuto: false
                            });
                        }
                    });
                } else {
                    console.log("User canceled the update.");
                }
            });
        });
    
    
        function validateForm() {
            let isValid = true;
    
            // Check if required inputs are filled
            $('#step1 input[required], #step1 select[required]').each(function () {
                if ($(this).val().trim() === '') {
                    isValid = false;
                    return false; // Break loop
                }
            });
    
            // Enable or disable the button with styling
            if (isValid) {
                $('#nextStep').prop('disabled', false).removeClass('disabled-btn');
            } else {
                $('#nextStep').prop('disabled', true).addClass('disabled-btn');
            }
        }
    
        // Attach event listeners to inputs
        $('#step1 input, #step1 select').on('input change', validateForm);
    
        // Initially disable button and add styling
        $('#nextStep').prop('disabled', true).addClass('disabled-btn');
        
    });
    
 
    $('#nextStep').click(function(){
        $('#step1').hide();
        $('#step2').show();
    });
    $('#prevStep').click(function(){
        $('#step1').show();
        $('#step2').hide();
    })
    $('#nextStep1').click(function(){
        $('#step2').hide();
        $('#step3').show();
    });
    $('#prevStep1').click(function(){
        $('#step2').show();
        $('#step3').hide();
    })
    
});

$(document).ready(function () {
    const sendOtpButton = $("#sendOtp");
    const sendOtpinput = $("#otp");
  
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
                        $('#nextStep1').prop('disabled', false).removeClass('disabled-btn')
                    } else {
                        $("#otpStatus").text("❌ Invalid OTP").removeClass("text-success").addClass("text-danger");
                        $("#password, #password_confirmation").prop("disabled", true);
                        $("#updateBtn").prop("disabled", true);
                        $('#nextStep').prop('disabled', true).addClass('disabled-btn');
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

$('.login-reg-panel input[type="radio"]').on('change', function () {
    if ($('#log-login-show').is(':checked')) {
        $('.register-info-box').fadeOut();
        $('.login-info-box').fadeIn();

        $('.white-panel').addClass('right-log');
        $('.register-show').addClass('show-log-panel');
        $('.login-show').removeClass('show-log-panel');
    } else if ($('#log-reg-show').is(':checked')) {
        $('.register-info-box').fadeIn();
        $('.login-info-box').fadeOut();

        $('.white-panel').removeClass('right-log');

        $('.login-show').addClass('show-log-panel');
        $('.register-show').removeClass('show-log-panel');
    }
});

  function togglePassword1(icon) {
    const passwordField = document.getElementById("passwordLogin");
    
    if (passwordField.type === "password") {
      passwordField.type = "text";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    } else {
      passwordField.type = "password";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }
  }

  function togglePassword2(icon) {
    const passwordField = document.getElementById("password");
    
    if (passwordField.type === "password") {
      passwordField.type = "text";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    } else {
      passwordField.type = "password";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }
  }

  function togglePassword3(icon) {
    const passwordField = document.getElementById("confirmPassword");
    
    if (passwordField.type === "password") {
      passwordField.type = "text";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    } else {
      passwordField.type = "password";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }
  }
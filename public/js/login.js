
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
                        } else if (response.role === "user"){
                            window.location.href = "/userdash";
                        }
                     
                    });
                } else {

                     if (response.role === "pending"){
                        Swal.fire({
                           icon: "warning",
                            title: "Your account is pending approval",
                            text: "Please wait for an administrator to approve your account.",
                            confirmButtonColor: "#f1c40f",
                            heightAuto: false
                        });
                    }
                    else{
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
                    html: errorMessage, // Use 'html' to properly format error messages
                    confirmButtonColor: "#d33",
                    heightAuto: false
                });
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
                    // Proceed with AJAX request if user confirms
                    $.ajax({
                        url: form.attr("action"),
                        type: "POST", // Use POST instead of PUT
                        data: formData,
                        processData: false,  
                        contentType: false,  
                        headers: { "X-HTTP-Method-Override": "PUT" },
                        success: function (response) {
                            if (response.success) {
                                form[0].reset();
                                Swal.fire({
                                    icon: "success",
                                    title: "User Profile Updated Successfully",
                                    confirmButtonColor: "#3085d6",
                                    heightAuto: false
                                }).then(() => {
                                    window.location.href = "/userdash";
                               
                                });
                            }
                        },
                        error: function (xhr) {
                            let errorMessage = "An error occurred. Please try again.";
    
                            if (xhr.responseJSON) {
                                if (xhr.responseJSON.errors) {
                                    errorMessage = "<ul>";
                                    Object.keys(xhr.responseJSON.errors).forEach(field => {
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
                }
            });
        });
    });

    $('#nextStep').click(function(){
        $('#step1').hide();
        $('#step2').show();
    });
    $('#prevStep').click(function(){
        $('#step1').show();
        $('#step2').hide();
    })
    
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

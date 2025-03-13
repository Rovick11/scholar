
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
                        if (response.role === "admin") {
                            window.location.href = "/admindash";
                        } else {
                            window.location.href = "/userdash";
                        }
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

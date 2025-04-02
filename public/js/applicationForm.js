    $(document).ready(function () {
        $("#appButton").click(function (event) {
        
            let form = $("#appForm"); 
            let formData = new FormData(form[0]); ; 
            
            Swal.fire({
                title: "Are you sure?",
                text: "Do you really want to submit this form?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, submit it!"
                
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: form.attr("action"), 
                        type: "POST",
                        data: formData,
                        processData: false,  
                        contentType: false,  
                        success: function (response) {
                        
                        
                            if (response.success) {
                                form[0].reset();
                                Swal.fire({
                                    icon: "success",
                                    title: "Successful Submission",
                                    confirmButtonColor: "#3085d6",
                                    heightAuto: false
                                }).then(() => {
                                    console.log("Redirecting to:", response.redirect);
                                    if (response.redirect) {
                                        window.location.href = response.redirect; 
                                    } else {
                                        console.error("Redirect URL is missing in response.");
                                    }
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
                                title: "Error",
                                html: errorMessage, // Use 'html' to properly format error messages
                                confirmButtonColor: "#d33",
                                heightAuto: false
                            });
                        }
                    });
                }
        });
    });

});

$('#nextStepSub').click(function(){
    $('#step1').hide();
    $('#step2').show();
    $('#step3').hide();
});
$('#secStepSub').click(function(){
    $('#step1').hide();
    $('#step2').show();
    $('#step3').hide();
});
$('#thirdStepSub').click(function(){
    $('#step1').hide();
    $('#step2').hide();
    $('#step3').show();
});
$('#fourthStepSub').click(function(){
    $('#step1').show();
    $('#step2').hide();
    $('#step3').hide();
});
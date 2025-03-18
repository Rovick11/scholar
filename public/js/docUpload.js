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
                                title: "File Updated Successfully",
                                confirmButtonColor: "#3085d6",
                                heightAuto: false
                            }).then(() => {
                           
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

function showUpdateForm(docType) {
    document.getElementById('document_type').value = docType;
    var updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
    updateModal.show();
}
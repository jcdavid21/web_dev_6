$(document).ready(function() {
    // Add a new credential
    $('#add-credential-btn').click(function() {
        const newCredential = $('#new-credential').val().trim();

        if(newCredential !== "") {
            $.ajax({
                type: "POST",
                url: "../backend/account/addCredentials.php",
                data: { credential_title: newCredential },
                success: function(response) {
                    // Remove "No credentials added yet" if it exists
                    if ($("#credential-list").find("li").text() === "No credentials added yet") {
                        $("#credential-list").empty();
                    }
                    // Append new credential with delete icon
                    $('#credential-list').append(
                        "<li>" + newCredential + 
                        " <i class='fa-solid fa-minus delete-credential' style='color: red;' data-title='" + newCredential + "'></i></li>"
                    );
                    $('#new-credential').val(""); // Clear input
                },
                error: function() {
                    alert("Error adding credential.");
                }
            });
        } else {
            alert("Please enter a credential.");
        }
    });

    // Delete a credential
    $('#credential-list').on('click', '.delete-credential', function() {
        const credentialTitle = $(this).data('title');
        const credentialItem = $(this).closest('li');

        $.ajax({
            type: "POST",
            url: "../backend/account/deleteCredential.php",
            data: { credential_title: credentialTitle },
            success: function(response) {
                credentialItem.remove(); // Remove the credential from the list
                // Check if list is empty, then show "No credentials added yet"
                if ($('#credential-list').children().length === 0) {
                    $('#credential-list').append("<li>No credentials added yet</li>");
                }
            },
            error: function() {
                alert("Error deleting credential.");
            }
        });
    });
});

$('.update-space').click(function(){
    // Get the data-space-id attribute from the clicked button
    const spaceId = $(this).data('space-id');

    // Get the values from the modal inputs
    const spaceName = $("#space_name").val();
    const spaceImgInput = $("#space_img")[0];
    const new_space_img = spaceImgInput ? spaceImgInput.files[0] : null;

    // Debugging: Log the values to the console
    console.log("Space ID:", spaceId);
    console.log("Space Name:", spaceName);
    console.log("Space Image File:", new_space_img);

    if(!spaceName) {
        Swal.fire({
            title: "Missing Fields!",
            icon: "warning",
            text: "Please fill out all required fields.",
            confirmButtonText: 'OK'
        });

        return;
    }

    // Prepare the form data for an AJAX request
    const formData = new FormData();
    formData.append("space_id", spaceId);
    formData.append("space_name", spaceName);
    if (new_space_img) {
        formData.append("space_img", new_space_img);
    }

    Swal.fire({
        title: 'Are you sure you want to update this space?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../backend/spaces/updateSpaces.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.status === 'success') {
                        Swal.fire({
                            title: 'Update space',
                            icon: 'success',
                            text: data.message,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result) {
                                window.location.reload();
                            }
                        });
                    } else if (data.status === 'error') {
                        Swal.fire({
                            title: 'Update space',
                            icon: 'info',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                    Swal.fire({
                        title: 'An error occurred while updating the space',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
})

$('.delete-space').click(function(){
    const spaceId = $(this).data('space-id');
    Swal.fire({
        title: 'Are you sure you want to delete this space?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../backend/spaces/deleteSpace.php',
                type: 'post',
                data: {
                    space_id: spaceId
                },
                success: function (response) {
                    if (response === 'success') {
                        Swal.fire({
                            title: 'Delete space',
                            icon: 'success',
                            text: data.message,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result) {
                                window.location.href = './homepage.php';
                            }
                        });
                    } else if (reponse === 'error') {
                        Swal.fire({
                            title: 'Delete space',
                            icon: 'info',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                    Swal.fire({
                        title: 'An error occurred while deleting the space',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
})
 // Handle Update button click
 $(".update-post").on("click", function () {
    const postId = $(this).data("post-id"); // Get the post ID
    const title = $(`#exampleModal${postId} #posted_title`).val(); // Get the title
    const tags = $(`#exampleModal${postId} #posted_tags`).val(); // Get the tags
    const message = $(`#exampleModal${postId} #message-text`).val(); // Get the message
    const privacy = $(`#exampleModal${postId} #posted_privacy`).val(); // Get the privacy
    // Check if any of the fields are empty
    if (title === '' || tags === '' || message === '') {
        Swal.fire({
            title: 'All fields are required',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return;
    }

    $.ajax({
        url: '../backend/spaces/updatePost.php',
        type: 'post',
        data: {
            post_id: postId,
            title: title,
            tags: tags,
            message: message,
            privacy: privacy
        },
        success: function (response) {
            if (response === 'success') {
                window.location.reload();
            } else {
                Swal.fire({
                    title: 'Failed to update post',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
            Swal.fire({
                title: 'An error occurred while updating the post',
                icon: 'error',
                confirmButtonText: 'OK'
            }); 
        }
    })
   
});


$(".delete-post").on("click", function () {
    const postId = $(this).data("posted-id"); // Get the post ID
    Swal.fire({
        title: 'Are you sure you want to delete this post?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../backend/spaces/deletePost.php',
                type: 'post',
                data: {
                    post_id: postId
                },
                success: function (response) {
                    if (response === 'success') {
                        window.location.reload();
                    } else {
                        Swal.fire({
                            title: 'Failed to delete post',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                    Swal.fire({
                        title: 'An error occurred while deleting the post',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
        }
    });
});
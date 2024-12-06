$(document).ready(function () {
    $('.submit-comment').on("click", function(e) {
        e.preventDefault();
    
        var comment = $(this).closest('.input-comment').find('.comment').val();
        var acc_id = $(this).data('acc-id');
        var posted_id = $(this).data('posted-id');
        var profile_img = $(this).data('profile-img'); // Assuming you have the profile image URL
        var full_name = $(this).data('full-name');    // Assuming you have the user's full name
    
        // Ensure comment is not empty
        if (comment.trim() === '') {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Comment cannot be empty.',
            });
            return false;
        }
    
        $.ajax({
            url: '../backend/spaces/addComment.php',
            type: 'post',
            data: {
                comment: comment,
                acc_id: acc_id,
                posted_id: posted_id
            },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    // Clear input field
                    $('.comment').val('');
    
                    // Format today's date
                    var currentDate = new Date().toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    });
    
                    // Dynamically append the new comment
                    var newComment = `
                        <div class="flex justify-between gap-2 comment-container" data-comment-con-id="new">
                            <div class="comment">
                                <div class="left">
                                    ${profile_img 
                                        ? `<div class="h-16">
                                                <img src="${profile_img}" alt="Profile Image" class="h-full rounded-full">
                                           </div>`
                                        : `<i class="fa-regular fa-circle-user"></i>`}
                                </div>
                            </div>
                            <div class="right">
                                <div class="flex gap-2 text-sm right-details">
                                    <div class="name">${full_name || 'You'}</div>
                                    <div class="date font-semibold">${currentDate}</div>
                                </div>
                                <div class="modify-comment" data-comment-id="new">
                                    <div class="comment-text">${comment}</div>
                                    <div class="flex gap-2">
                                        <div class="edit cursor-pointer">
                                            <i class="fa-regular fa-edit text-blue-700 font-medium"></i>
                                        </div>
                                        <div class="delete delete-comment cursor-pointer">
                                            <i class="fa-regular fa-trash-can text-red-700"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
    
                    // Append the new comment to the correct container
                    $(`.comments-con[data-posted-id="${posted_id}"]`).append(newComment);
                } else {
                    alert('Error: Unable to add comment.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                alert('An error occurred. Please try again.');
            }
        });
    
        return false;
    });
    
});




$(document).on('click', '.edit', function() {
    const modifyComment = $(this).closest('.modify-comment');
    const commentId = modifyComment.data('comment-id');
    const commentText = modifyComment.find('.comment-text').text().trim();

    // Replace the comment text with an input box
    modifyComment.html(`
        <div class="flex items-center gap-2">
            <input type="text" value="${commentText}" class="edit-comment-input border border-gray-300 rounded px-2 py-1 w-full">
            <button class="save-edit text-sm bg-blue-500 text-white px-4 py-2 rounded" data-comment-id="${commentId}">Save</button>
            <button class="cancel-edit text-sm bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
        </div>
    `);
});

// Save the edited comment
$(document).on('click', '.save-edit', function() {
    const modifyComment = $(this).closest('.modify-comment');
    const commentId = $(this).data('comment-id');
    const updatedComment = modifyComment.find('.edit-comment-input').val().trim();

    if (updatedComment === '') {
        alert('Comment cannot be empty.');
        return;
    }

    $.ajax({
        url: '../backend/spaces/editComment.php',
        type: 'post',
        data: { 
            comment_id: commentId,
            updated_comment: updatedComment 
        },
        success: function(response) {
            if (response === 'success') {
                // Replace the input box with the updated comment text
                modifyComment.html(`
                    <div class="comment-text">${updatedComment}</div>
                    <div class="flex gap-2">
                        <div class="edit cursor-pointer">
                            <i class="fa-regular fa-edit text-blue-700 font-medium"></i>
                        </div>
                        <div class="delete delete-comment cursor-pointer">
                            <i class="fa-regular fa-trash-can text-red-700"></i>
                        </div>
                    </div>
                `);
            } else {
                alert('Failed to update comment.');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            alert('An error occurred while updating the comment.');
        }
    });
});

// Cancel the edit
$(document).on('click', '.cancel-edit', function() {
    const modifyComment = $(this).closest('.modify-comment');
    const originalComment = modifyComment.find('.edit-comment-input').val();

    // Restore the original comment text
    modifyComment.html(`
        <div class="comment-text">${originalComment}</div>
        <div class="flex gap-2">
            <div class="edit cursor-pointer">
                <i class="fa-regular fa-edit text-blue-700 font-medium"></i>
            </div>
            <div class="delete delete-comment cursor-pointer">
                <i class="fa-regular fa-trash-can text-red-700"></i>
            </div>
        </div>
    `);
});

$(document).on('click', '.delete-comment', function() {
    Swal.fire({
        title: 'Are you sure you want to delete this comment?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            const commentContainer = $(this).closest('.comment-container');
            const commentId = commentContainer.data('comment-con-id');

            $.ajax({
                url: '../backend/spaces/deleteComment.php',
                type: 'post',
                data: { comment_id: commentId },
                success: function(response) {
                    if (response === 'success') {
                        // Remove the comment from the DOM
                        commentContainer.remove();
                    } else {
                        alert('Error: Unable to delete comment.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    alert('An error occurred. Please try again.');
                }
            });
        }
    });
});


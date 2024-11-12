let tags = [];

$(document).ready(function() {
    // Function to handle saving a post as a draft
    $('.submit').click(function() {
        const title = $('#title_post').val().trim();
        const description = $('#description').val().trim();
        const file = $('#file')[0].files[0];  // File input
        const category = $('#category').val();
        let visibility = $('#visibility-status').text(); // Get the selected visibility status
        const post_status = $(this).val();

        console.log(title + " " + file + " " + category + " " + visibility + " " + post_status + " " + description + " " + tags);

        if (visibility.toLowerCase() === 'public') {
            visibility = 1;
        } else if (visibility.toLowerCase() === 'private') {
            visibility = 2;
        } else {
            visibility = 3;
        }
        
        if (title && description && category && file) {
            let formData = new FormData();
            formData.append('action', post_status);
            formData.append('title', title);
            formData.append('description', description);
            formData.append('category', category);
            formData.append('visibility', visibility);
            formData.append('file', file);
            formData.append('tags', JSON.stringify(tags));

            $.ajax({
                type: 'POST',
                url: '../backend/spaces/addPost.php', // Update with actual backend URL
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    const responseObj = JSON.parse(response);
                    Swal.fire({
                        title: `${responseObj.status}`,
                        icon: "success",
                        text: `${responseObj.message}`,
                        confirmButtonText: 'OK'
                    });
                    $('input[type="text"]').val('');
                    $('#description').val('');
                    $('#file').val('');
                    $('#category').val('');
                    $('.tags-display .tag').remove(); // Clear tags
                },
                error: function() {
                    alert('Error saving post.');
                }
            });
        } else {
            Swal.fire({
                title: 'Incomplete Post',
                icon: 'warning',
                text: 'Please fill in all required fields.',
                confirmButtonText: 'OK'
            });
        }
    });

    // Add tags functionality
    $('.tags button').click(function() {
        const tagInput = $('.tags input').val().trim();
        if (tagInput) {
            // Create a new tag element
            const tag = $('<span class="tag">' + tagInput + '</span>');
            
            // Append the tag to the tags-display div
            $('.tags-display').append(tag);
            
            // Clear the input field after adding the tag
            $('.tags input').val('');

            tags.push(tagInput);
        } else {
            alert('Please enter a tag.');
        }
    });
});

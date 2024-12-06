$(document).on('click', '.upVote, .downVote', function () {
    const $this = $(this);
    const postedId = $this.data('posted-id');
    const isUpvote = !$this.hasClass('active');
    const $parent = $this.closest('.likes');

    const user_details = JSON.parse(localStorage.getItem('userDetails'));
    
    // Check if downvote is disabled
    if ($this.hasClass('downVote') && $this.hasClass('disabled')) {
        return;
    }

    if (!user_details) {
        Swal.fire('Error', 'You need to be logged in to vote.', 'info');
        return;
    }
    
    $.ajax({
        url: '../backend/spaces/vote.php', // Backend endpoint for handling votes
        type: 'POST',
        data: { posted_id: postedId, vote_type: isUpvote ? 1 : 0 }, // 1 for upvote, 0 for downvote
        success: function (response) {
            const parsedResponse = JSON.parse(response);
            if (parsedResponse.status === 'success') {
                // Update the UI based on the response
                if (isUpvote) {
                    $parent.find('.upVote').toggleClass('active', parsedResponse.user_has_voted);
                }
                $parent.find('span').text(parsedResponse.total_likes);
            } else {
                Swal.fire('Error', parsedResponse.message, 'error');
            }
        },
        error: function () {
            Swal.fire('Error', 'Something went wrong!', 'error');
        }
    });
});

$(document).ready(function () {

    // Handle review submission
    $('#submitReview').on('click', function () {
        const userDetails = JSON.parse(localStorage.getItem('userDetails'));
        const message = $('#message').val();

        if (stars_number === 0 || message.trim() === '') {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Please fill in all fields.',
            });
            return;
        }

        $.ajax({
            url: '../backend/spaces/submit_review.php',
            type: 'POST',
            data: { rating: stars_number, message: message },
            success: function (response) {
                if(response === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Review submitted successfully.',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    })
                }
            },
            error: function () {
                alert('An error occurred. Please try again.');
            }
        });
    });

});
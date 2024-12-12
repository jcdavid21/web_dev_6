$('.submit').click(function() {
    const formData = new FormData();
    formData.append('name', $('#name').val());
    formData.append('email', $('#email').val());
    formData.append('message', $('#message').val());

    if (!$('#name').val() || !$('#email').val() || !$('#message').val()) {
        Swal.fire({
            title: 'Missing Fields!',
            icon: 'warning',
            text: 'Please fill out all required fields.',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Show loading SweetAlert
    Swal.fire({
        title: 'Sending your message...',
        text: 'Please wait while we process your request.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading(); // Show the rotating loader
        }
    });

    $.ajax({
        url: '../backend/account/contactUs.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response === 'success') {
                Swal.fire({
                    title: 'Message sent!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if(result) {
                        window.location.reload();
                    }
                });
            } else {
                Swal.fire({
                    title: 'Failed to send message',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            Swal.fire({
                title: 'An error occurred while sending the message',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
});

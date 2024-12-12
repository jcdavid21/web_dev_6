$('.join-space').click(function() {
    const spaceId = $(this).data('space-id');
    Swal.fire({
        title: 'Are you sure you want to join this space?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../backend/spaces/joinSpace.php',
                type: 'post',
                data: {
                    space_id: spaceId
                },
                success: function (response) {
                    if (response === 'success') {
                        window.location.reload();
                    } else {
                        Swal.fire({
                            title: 'Failed to join space',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                    Swal.fire({
                        title: 'An error occurred while joining the space',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
});

$('.leave-space').click(function() {
    const spaceId = $(this).data('space-id');
    Swal.fire({
        title: 'Are you sure you want to leave this space?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../backend/spaces/leaveSpace.php',
                type: 'post',
                data: {
                    space_id: spaceId
                },
                success: function (response) {
                    if (response === 'success') {
                        window.location.reload();
                    } else {
                        Swal.fire({
                            title: 'Failed to leave space',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                    Swal.fire({
                        title: 'An error occurred while leaving the space',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
});
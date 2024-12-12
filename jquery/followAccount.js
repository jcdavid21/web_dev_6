$('.follow-account').click(function() {
    const accountId = $(this).data('following-id');

    Swal.fire({
        title: 'Are you sure you want to follow this account?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../backend/account/followAccount.php',
                type: 'post',
                data: {
                    account_id: accountId
                },
                success: function (response) {
                    if (response === 'success') {
                        window.location.reload();
                    } else {
                        Swal.fire({
                            title: 'Failed to follow account',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                    Swal.fire({
                        title: 'An error occurred while following the account',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
})

$('.unfollow').on('click', function() {
    const accountId = $(this).data('following-id');

    Swal.fire({
        title: 'Are you sure you want to unfollow this account?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../backend/account/unfollowAccount.php',
                type: 'post',
                data: {
                    account_id: accountId
                },
                success: function (response) {
                    if (response === 'success') {
                        window.location.reload();
                    } else {
                        Swal.fire({
                            title: 'Failed to unfollow account',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                    Swal.fire({
                        title: 'An error occurred while unfollowing the account',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
})
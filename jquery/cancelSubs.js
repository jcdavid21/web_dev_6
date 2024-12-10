$(document).ready(function(){
    $('.cancel-sub').on("click", function(e){
        const subs_id = $(this).data("subs-id");

        if(subs_id === undefined){
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Subscription ID not found.',
            });
            return false;
        }

        Swal.fire({
            title: 'Are you sure you want to cancel this subscription?',
            text: 'You will not be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../backend/spaces/cancelSubscription.php",
                    type: "POST",
                    data: {
                        subs_id: subs_id
                    },
                    success: function (response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Subscription has been cancelled.',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = './subscription.php';
                                }
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Failed to cancel subscription.',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        alert('An error occurred while cancelling the subscription.');
                    }
                });
            }
        });
    })
})
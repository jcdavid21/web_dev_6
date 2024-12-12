$(document).ready(function(){
    $('.publish').on('click', function(e){
        e.preventDefault();
        const post_id = $(this).data('post-id');
        Swal.fire({
            title: "Are you sure?",
            text: "This post will be published",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes publish it!"
          }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    url: '../backend/spaces/publishDraft.php',
                    type: 'post',
                    data: {
                        post_id: post_id
                    },
                    success: function(response){
                        if(response === 'success'){
                            window.location.reload();
                        }else{
                            Swal.fire({
                                title: 'Failed to publish post',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error){
                        console.error('AJAX Error:', error);
                        Swal.fire({
                            title: 'An error occurred while publishing the post',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
            }
          });
    })
})
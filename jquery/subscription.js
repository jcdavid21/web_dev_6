$(document).ready(function(){
    $('.submit').on("click", function(e){
        e.preventDefault();
        const subscriptionType = $('input[name="subs"]:checked').data("subs-id");
        const email = $("#emailInput").val();
        const password = $("#password").val();
        const gcashNumber = $("#gcashInput").val();
        const receipt = $("#receipt")[0].files[0];


        if (subscriptionType === undefined) {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Please select a subscription type.',
            });
            return false;
        }

        if(gcashNumber.length < 11 || gcashNumber.length > 11){
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'GCash number must be 11 digits.',
            });
            return false;
        }

        if (email.trim() === '' || password.trim() === '' || gcashNumber.trim() === '') {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Please fill in all fields.',
            });
            return false;
        }

        if (receipt === undefined) {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Please upload a receipt.',
            });
            return false;
        }

        const formData = new FormData();
        formData.append("subscriptionType", subscriptionType);
        formData.append("email", email);
        formData.append("password", password);
        formData.append("gcashNumber", gcashNumber);
        formData.append("receipt", receipt);
        $.ajax({
            url: "../backend/spaces/subscription.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'You have successfully subscribed.',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else if(response === 'incorrect'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Incorrect email or password.',
                    });
                } else if (response === "Error uploading the image.")
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error uploading the image.',
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert("An error occurred. Please try again.");
            },
        });
        
    })
})
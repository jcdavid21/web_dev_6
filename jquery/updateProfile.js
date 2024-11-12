function validatePassword(password) {
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    return passwordPattern.test(password);
}

function birthdateValidation(birthdate) {
    const currentDate = new Date();
    const minDate = new Date(
        currentDate.getFullYear() - 12,
        currentDate.getMonth(),
        currentDate.getDate()
    );


    const parsedBirthdate = new Date(birthdate);


    if (isNaN(parsedBirthdate) || parsedBirthdate > currentDate) {
        return false;
    }

    return parsedBirthdate <= minDate;
}

function validateImg(file) {
    const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    return allowedExtensions.test(file);
}


$(document).ready(function() {
    $('#submit').click(function() {
        // Collecting form data
        const formData = new FormData();
        formData.append("full_name", $('#full_name').val());
        formData.append("password", $('#password').val());
        formData.append('gender', $('#gender').val());
        formData.append('birthdate', $('#birth-date').val());
        formData.append('job', $('#job').val());
        formData.append('profile_img', $('#profile')[0].files[0]); // Adding file data


        if (!$('#gender').val() || !$('#birth-date').val() || !$('#job').val() || !$('#full_name').val()) {
            Swal.fire({
                title: "Missing Fields!",
                icon: "warning",
                text: "Please fill out all required fields.",
                confirmButtonText: 'OK'
            });
            return;
        }
        
            
        if($('#password').val() && !validatePassword($('#password').val())) {
            Swal.fire({
                title: "Weak Password!",
                icon: "warning",
                text: "Password must be at least 8 characters long and include at least one uppercase letter and one lowercase letter.",
                confirmButtonText: 'OK'
            });
            return;
        }

        if($('#profile')[0].files[0] && !validateImg($('#profile')[0].files[0].name)) {
            Swal.fire({
                title: "Invalid Image!",
                icon: "warning",
                text: "Please upload a valid image file (JPEG, JPG, PNG).",
                confirmButtonText: 'OK'
            });
            return;
        }

        if($('#birth-date').val() && !birthdateValidation($('#birth-date').val())) {
            Swal.fire({
                title: "Invalid Birthdate!",
                icon: "warning",
                text: "You must be at least 12 years old to register.",
                confirmButtonText: 'OK'
            });
            return;
        }
        $.ajax({
            url: '../backend/account/updateProfile.php', // PHP file to handle update
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                let responseObj = JSON.parse(response);
                if(responseObj.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Profile Updated!',
                        text: 'Your profile has been successfully updated.',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if(result.isConfirmed) {
                            window.location.reload();
                        }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Update Failed',
                        text: 'There was an issue updating your profile. Please try again.',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                // Display error message with SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: 'There was an issue updating your profile. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});

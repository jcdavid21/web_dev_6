
function validateEmail(email) {
    const emailPattern = /^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|outlook\.com|hotmail\.com)$/;
    return emailPattern.test(email);
}

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

$(document).ready(() => {
    $("#signup").on("click", function(event) {
        event.preventDefault();

        const full_name = $('#name').val();
        const email = $('#email').val();
        const gender = $('#gender').val();
        const birthdate = $('#birth-date').val();
        const username = $('#username').val();
        const password = $('#password').val();

        if (full_name && gender && email && username && password && birthdate) {
            if (!validateEmail(email)) {
                Swal.fire({
                    title: "Invalid Email!",
                    icon: "warning",
                    text: "Please enter a valid email address from gmail.com, yahoo.com, etc.",
                    
                });
                return;
            }

            if (!validatePassword(password)) {
                Swal.fire({
                    title: "Weak Password!",
                    icon: "warning",
                    text: "Password must be at least 8 characters long and include at least one uppercase letter and one lowercase letter.",
                    
                });
                return;
            }
            
            if (!birthdateValidation(birthdate)) {
                Swal.fire({
                    title: "Invalid Birthdate!",
                    icon: "warning",
                    text: "Age must be at least 12 years old and up.",
                    
                });
                return;
            }

            if (password) {
                $.ajax({
                    url: "../backend/account/signup.php",
                    method: "post",
                    data: {
                        full_name: full_name,
                        email: email,
                        gender: gender,
                        birthdate: birthdate,
                        username: username,
                        password: password
                    },
                    success: (response) => {
                        if (response !== "existed") {
                            Swal.fire({
                                title: "Registered Successfully",
                                icon: "success",
                                text: "Account has been created",
                                
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "./signup.php";
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "Account Existed!",
                                icon: "info",
                                text: "Your username/email are already exist.",
                                
                            });
                        }
                    },
                    error: () => {
                        alert("Failed to connect!");
                    }
                });
            } else {
                Swal.fire({
                    title: "Password doesn't match!",
                    text: "Make sure that your password are the same.",
                    
                });
            }
        } else {
            Swal.fire({
                title: "Empty Field!",
                icon: "info",
                text: "Make sure all fields are filled.",
                
            });
        }
    });
});

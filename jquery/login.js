$(document).ready(()=>{
    $("#submit").on("click", function(e){
        const email = $("#log_email").val()
        const password = $("#log_password").val()

        if(email && password){
            $.ajax({
                url: "../backend/account/login.php",
                method: "post",
                data:{
                    email,
                    password
                },
                success: function(response){
                    if(response === "invalid"){
                        Swal.fire({
                            title: "Invalid Password",
                            icon: "warning",
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }else if(response === "deactivated"){
                        Swal.fire({
                            title: "Account Deactivated!",
                            icon: "warning",
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }else{
                        console.log(response)
                        Swal.fire({
                            title: "Welcome to spaces!",
                            text: "Successfully Log in",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 3000,
                          }).then((result) => {
                            const data = JSON.parse(response);
                            if(data.role_id == 1){
                                localStorage.setItem("userDetails", response);
                                window.location.href = "./homepage.php";
                            }else if(data.role_id == 2){
                                localStorage.setItem("adminDetails", response);
                                window.location.href = "../admin/index.php"
                            }
                        });
                    }
                },
                error: function(){
                    alert("Connection Error")
                }
            })
        }else{
            Swal.fire({
                title: "Please fill up the form!",
                icon: "warning",
                showConfirmButton: false,
            });
        }
    })
})
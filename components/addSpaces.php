<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/createblog.css">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/spaces.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Create Blog</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php 
    $user_id = '';
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    } else {
        header('Location: ./signup.php');
        exit();
    } ?>

    <?php 
         $querySubsCheck = "SELECT * FROM tbl_subscription WHERE acc_id = ?";
         $stmtSubsCheck = $conn->prepare($querySubsCheck);
         $stmtSubsCheck->bind_param('i', $user_id);
         $stmtSubsCheck->execute();
         $resultSubsCheck = $stmtSubsCheck->get_result();
         $rowSubsCheck = $resultSubsCheck->fetch_assoc();
 
         if($resultSubsCheck->num_rows < 1)
         {
            echo "<script>window.location.href='./subscription.php'</script>";
         }
    ?>

    <div id="grid-con" class="overflow-hidden">
        <div class="space">
            <?php include 'spaces.php'; ?>
        </div>
        <div class="center">
            <div class="container">
                <div class="flex items-center justify-between">
                    <div class="title">Add new space</div>
                </div>
                <input type="text" id="space_name" placeholder="Enter space name here">
                <label for="img">Space image:</label>
                <div class="img-con flex items-center justify-center">
                    <img src="" alt="" class="object-cover" id="imgHolder" hidden
                    style="height: 250px; width: 250px; border-radius: 100%;">
                </div>
                <input type="file" id="space_img" accept="image/*">
                <button id="add_space" class="mt-4 p-2 bg-blue-500 text-white rounded">Add Space</button>
            </div>
        </div>
        <!-- profile -->
        <?php include 'profile.php'; ?>
    </div>

    <?php include 'footer.php'; ?>
    <script src="../js/sidebar.js"></script>
    <script>
        $(document).ready(function(){
            $('#space_img').change(function(){
                const file = $(this)[0].files[0];
                const fileReader = new FileReader();
                fileReader.onload = function(){
                    $('#imgHolder').attr('src', fileReader.result).show();
                }
                fileReader.readAsDataURL(file);
            });

            $('#add_space').click(function(){
                const space_name = $('#space_name').val();
                const space_img = $('#space_img')[0].files[0];
                const formData = new FormData();
                formData.append('space_name', space_name);
                formData.append('space_img', space_img);

                if(space_name == '' || space_img == '' || space_img == undefined){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please fill in all fields',
                        text: 'All fields are required',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }

                $.ajax({
                    url: '../backend/spaces/addSpace.php',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response == 'success'){
                            Swal.fire({
                                icon: 'success',
                                title: 'Space added successfully',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                if(result){
                                    window.location.reload();
                                }
                            });
                        } else if (response === "exists") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Space already exists',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to add space',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>

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
    } ?>
    <div id="grid-con" class="overflow-hidden">
        <div class="space">
            <?php include 'spaces.php'; ?>
        </div>
        <div class="center">
            <div class="container">
                <div class="flex items-center justify-between">
                    <div class="title">Add New Post</div>
                    
                    <a href="drafts.php">
                        <button class="drafts">View Drafts</button>
                    </a>
                </div>
                <input type="text" id="title_post" placeholder="Enter title here">
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter description here"></textarea>
                <div class="text">Add Media</div>
                <input type="file" name="file" id="file">
            </div>
        </div>
        <div class="left-con">
            <div class="container">
                <div class="title">Publish</div>
                <div class="div">
                    <i class="fa-regular fa-eye"></i>
                    <div>Visibility: <strong id="visibility-status">Public</strong> <span onclick="openModal()">Edit</span></div>
                </div>
                <div class="div">
                    <i class="fa-regular fa-calendar-days"></i>
                    <div>Publish: <strong>Immediately</strong></div>
                </div>
                <!-- <div class="div">
                    <i class="fa-regular fa-trash-can"></i>
                    <div class="delete">Delete</div>
                </div> -->
                <div class="btns">
                    <button class="draft submit" value="2">Save as draft</button>
                    <button class="publish submit" value="1">Publish</button>
                </div>
            </div>

            <div class="container format">
                <div class="title">Format</div>
                <select name="category" id="category">
                    <option value="" selected disabled>Select Category</option>
                    <?php 
                        $query = "SELECT * FROM tbl_spaces";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while($row = $result->fetch_assoc()){
                    ?>
                    <option value="<?php echo $row['space_id']; ?>"><?php echo $row['space_name']; ?></option>
                    <?php } ?>
                </select>

                <div class="tags">
                    <label for="">Tags:</label>
                    <input type="text">
                    <button>Add</button>
                </div>
                <div class="tags-display grid grid-cols-2 gap-2">

                </div>
            </div>
        </div>
    </div>
    

    <!-- Visibility Modal -->
    <div id="visibility-modal" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="relative w-full max-w-md bg-white rounded-lg shadow-lg">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900">Select Post Visibility</h3>
                <button type="button" onclick="closeModal()" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 space-y-3">
                <button type="button" onclick="setVisibility('Public')" class="w-full px-4 py-2 text-left text-gray-500 font-medium rounded-lg hover:bg-gray-200">Public</button>
                <button type="button" onclick="setVisibility('Private')" class="w-full px-4 py-2 text-left text-gray-500 font-medium rounded-lg hover:bg-gray-200">Private</button>
                <button type="button" onclick="setVisibility('Only Me')" class="w-full px-4 py-2 text-left text-gray-500 font-medium rounded-lg hover:bg-gray-200">Only Me</button>
            </div>
            <!-- Modal footer -->
            <div class="flex justify-end p-4 border-t border-gray-200 dark:border-gray-600">
                <!-- <button onclick="closeModal()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700">Save</button> -->
                <button onclick="closeModal()" class="ms-3 text-white bg-white border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700">Cancel</button>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="../js/sidebar.js"></script> 
    <script src="../jquery/addPost.js"></script>
    <script>
        function openModal() {
            document.getElementById('visibility-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('visibility-modal').classList.add('hidden');
        }

        function setVisibility(status) {
            document.getElementById('visibility-status').textContent = status;
            closeModal();
        }
    </script>
</body>
</html>

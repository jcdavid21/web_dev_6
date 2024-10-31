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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Create Blog</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="grid-con">
        <div class="space">
            <?php include 'spaces.php'; ?>
        </div>
        <div class="center">
            <div class="container">
                <div class="title">Add New Post</div>
                <input type="text" placeholder="Enter title here">
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
                    <div>Visibility: <strong>Public</strong> <span>Edit</span></div>
                </div>
                <div class="div">
                    <i class="fa-regular fa-calendar-days"></i>
                    <div>Publish: <strong>Immediately</strong> <span>Edit</span></div>
                </div>
                <div class="div">
                    <i class="fa-regular fa-trash-can"></i>
                    <div class="delete">Delete</div>
                </div>
                <div class="btns">
                    <button class="draft">
                        Save as draft
                    </button>
                    <button class="publish">
                        Publish
                    </button>
                </div>
            </div>

            <div class="container format">
                <div class="title">Format</div>
                <select name="category" id="category">
                    <option value="" selected disabled>Select Category</option>
                    <option value="1">Category 1</option>
                    <option value="2">Category 2</option>
                    <option value="3">Category 3</option>
                    <option value="4">Category 4</option>
                </select>

                <select name="category" id="category">
                    <option value="" selected disabled>Select Featured Image</option>
                    <option value="1">Category 1</option>
                    <option value="2">Category 2</option>
                    <option value="3">Category 3</option>
                    <option value="4">Category 4</option>
                </select>
                <div class="tags">
                    <label for="">Tabs:</label>
                    <input type="text">
                    <button>Add</button>
                </div>

                <div class="btns">
                    <button class="save">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="../js/sidebar.js"></script>
</body>
</html>
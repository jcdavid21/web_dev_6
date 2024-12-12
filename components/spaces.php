<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/spaces.css">
</head>
<body>
    <div class="spaces-con">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="cont">

        <div class="joined-spaces">
            <div class="title">Joined Spaces</div>
            <?php 
                $query2 = "SELECT ts.*, tj.* 
                        FROM tbl_spaces ts
                        JOIN tbl_spaces_joined tj ON tj.space_id = ts.space_id
                        WHERE tj.acc_id = ?
                        GROUP BY ts.space_id, tj.acc_id
                        ORDER BY ts.space_name ASC";
                $stmt2 = $conn->prepare($query2);
                $stmt2->bind_param('i', $user_id);
                $stmt2->execute();
                $result2 = $stmt2->get_result();

                if($result2->num_rows > 0){
                    while($row2 = $result2->fetch_assoc()){
            ?>
            <a href="./spacesPost.php?space_id=<?php echo $row2["space_id"] ?>">
                <div class="joined-details">
                    <div class="img-con">
                        <img src="<?php echo $row2["space_img"] ?>" alt="">
                    </div>
                    <div class="name"><?php echo $row2["space_name"] ?></div>
                </div>
            </a>
            <?php 
                    }
                }
            ?>
        </div>

        <!-- created spaces -->
        <div class="created-spaces joined-spaces">
            <div class="title">Created Spaces</div>
            <?php 
                $query4 = "SELECT * FROM tbl_spaces WHERE acc_id = ? ORDER BY space_name ASC";
                $stmt4 = $conn->prepare($query4);
                $stmt4->bind_param('i', $user_id);
                $stmt4->execute();
                $result4 = $stmt4->get_result();

                if($result4->num_rows > 0){
                    while($row4 = $result4->fetch_assoc()){
            ?>
            <a href="./spacesPost.php?space_id=<?php echo $row4["space_id"] ?>">
                <div class="joined-details">
                    <div class="img-con">
                        <img src="<?php echo $row4["space_img"] ?>" alt="">
                    </div>
                    <div class="name"><?php echo $row4["space_name"] ?></div>
                </div>
            </a>
            <?php 
                    }
                }else{
                    echo "No created spaces available.";
                }
            ?>
        </div>

        <div class="joined-spaces recommended-spaces">
            <div class="title">Recommended Spaces</div>
                <?php 
                    $query3 = "SELECT * FROM tbl_spaces WHERE acc_id != ? ORDER BY RAND() LIMIT 5";
                    $stmt3 = $conn->prepare($query3);
                    $stmt3->bind_param('i', $user_id);
                    $stmt3->execute();
                    $result3 = $stmt3->get_result();

                    if($result3->num_rows > 0){
                        while($row3 = $result3->fetch_assoc()){
                ?>
                <a href="./spacesPost.php?space_id=<?php echo $row3["space_id"] ?>">
                    <div class="joined-details">
                        <div class="img-con">
                            <img src="<?php echo $row3["space_img"] ?>" alt="">
                        </div>
                        <div class="name"><?php echo $row3["space_name"] ?></div>
                    </div>
                </a>
                <?php
                        }
                    } else {
                        echo "No recommended spaces available.";
                    }
                ?>




        </div>
        </div>
    </div>
</body>
</html>
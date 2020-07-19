<?php require_once "Includes/Sessions.php"; ?>
<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>
<?php
$_SESSION["trackingURL"] = $_SERVER["PHP_SELF"];
confirm_login();
?>

<?php
if (isset($_POST['postSubmit'])) {
    $author = $_SESSION["username"];
    date_default_timezone_set('Europe/Istanbul');
    $dateTime = "Date : " . date("Y/m/d h:i:sa");

    $postTitle = $_POST['postTitle'];
    $category = $_POST['category'];
    //to upload the image
    $image = $_FILES['image']['name'];
    $target = "Uploads/" . basename($_FILES['image']['name']);
    $img_tmp = $_FILES["image"]["tmp_name"];


    $postArea = $_POST['postArea'];


    // echo 'clicked';
    if (empty($postTitle)) {
        $_SESSION['errorMessage'] = "Post title can't be empty";

    // Redirect_to("addNewPost.php");
    } elseif (strlen($postTitle) < 5) {
        $_SESSION['errorMessage'] = "Category title must be greater than 5 character";
        Redirect_to("addNewPost.php");
    } elseif (strlen($postArea) > 400) {
        $_SESSION['errorMessage'] = "Category title can't be greater than 400";
        Redirect_to("addNewPost.php");
    } else {
        //insert to database
        $postsql = "INSERT INTO post(date, title, category, author, image, post)
                 VALUES(?,?,?,?,?,?)";
        $poststmt = $db->prepare($postsql);
        $ex = $poststmt->execute([$dateTime, $postTitle, $category, $author, $image, $postArea]);

        if (move_uploaded_file($img_tmp, $target)) {
            echo "The picture added to target folder";
        }

        if ($ex) {
            $_SESSION['successMessage'] = "Added all informations";
            Redirect_to("addNewPost.php");
        } else {
            $_SESSION['errorMessage'] = "Something went wrong";
            Redirect_to("addNewPost.php");
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/82feaba1d8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Posts</title>
</head>

<body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>


<!--navigation bar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">
        <a class="navbar-brand " href="dashboard.php" style="margin-right: 70px;">CMS</a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapseCMS">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-collapseCMS">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="MyProfile.php" class="nav-link" style="margin-right: 10px;"><i
                                class="fas fa-user text-success" style="margin-right:5px;"></i>My Profile</a>
                </li>

                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link" style="margin-right: 10px;">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a href="posts.php" class="nav-link" style="margin-right: 10px;">Posts</a>
                </li>

                <li class="nav-item">
                    <a href="categories.php" class="nav-link" style="margin-right: 10px;">Categories</a>
                </li>



                <li class="nav-item">
                    <a href="comments.php" class="nav-link" style="margin-right: 10px;">Comments</a>
                </li>

                <li class="nav-item">
                    <a href="blog.php?page=1" class="nav-link">Live Blog</a>
                </li>

            </ul>


            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="logout.php" class="nav-link" style="margin-left: 50px;">Logout <i
                                class="fas fa-sign-out-alt"></i></a>
                </li>

            </ul>

        </div>

    </div>

</nav>
<!--navbar end-->

<!--header-->

<!--header end-->


<!--Main Area-->
<section class="container py-2 mb-4">
    <div class="row" style="min-height: 50px;  ">
        <div class="offset-lg-1 col-lg-10" style="min-height: 450px; ">
            <?php
            //fonksiyonlar
            echo print_error_message();
            echo print_success_message();
            ?>
            <form action="addNewPost.php" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h2>Add New Post</h2>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="title"><span class="ct">Post Title:</span></label>
                            <input class="form-control" type="text" name="postTitle" id="title" placeholder="post title"
                                   autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="categoryTitle"><span class="ct">Choose Category</span></label>
                            <select class="form-control" name="category" id="categoryTitle">
                                <?php

                                $sql = "select id,title from category";
                                $stmt = $db->query($sql);

                                while ($row = $stmt->fetch()) {
                                    $id = $row['id'];
                                    $cat_name = $row['title']; ?>

                                    <option><?php echo $cat_name; ?></option>

                                <?php
                                } ?>

                            </select>
                        </div>

                        <div class="form-group">

                            <div class="custom-file">

                                <label for="imageSelect" class="custom-file-label">Select image</label>
                                <input type="file" name="image" id="imageSelect" class="custom-file-input">

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="postArea"><span class="FieldInfo">Post :</span></label>
                            <textarea class="form-control" id="postArea" name="postArea" rows="8" cols="80"></textarea>

                        </div>

                        <div class="row" style="min-height:50px; background-color: white;">
                            <div class="col-lg-6 mb-2">
                                <a href="dashboard.php" class="btn btn-secondary btn-block" style="margin-top: 6px;"><i
                                            class="fas fa-arrow-left"></i>Back to dashboard</a>

                            </div>
                            <div class="col-lg-6 mb-2">
                                <button type="submit" name="postSubmit" class="btn btn-success btn-block"
                                        style="margin-top: 6px;">
                                    <i class="fas fa-check"></i> Add info
                                </button>

                            </div>
                        </div>

                    </div>
                </div>

            </form>


        </div>

    </div>

</section>


<!--MainAreaEnd-->


<!--footer-->
<footer class="bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="lead text-center" style="text-align: center;">
                    Coded by Yasin | &copy; 2020| All rights reserved.

                </p>


            </div>

        </div>
    </div>

</footer>

<!--footer end-->

</body>

</html>

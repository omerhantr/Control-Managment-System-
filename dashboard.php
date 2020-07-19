<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>
<?php require_once "Includes/Sessions.php"; ?>

<?php
$_SESSION["trackingURL"] = $_SERVER["PHP_SELF"];//sayfanın url adresini trackingURL'e aktarıyoruz.Loginden sonra bu sayfanın acilmasi icin
confirm_login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/82feaba1d8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css" type="text/css">
    <title>Dashboard</title>
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
                    <a href="myprofile.php" class="nav-link" style="margin-right: 10px;"><i
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
<header class=" py-3">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fas fa-cog"></i>Dashboard</h1>
            </div>
            <div class="col-lg-3 mb-2">
                <a href="addNewPost.php" class="btn btn-primary btn-block">
                    <i class="fas fa-edit">Add New post</i>
                </a>
            </div>

            <div class="col-lg-3 mb-2">
                <a href="categories.php" class="btn btn-info btn-block">
                    <i class="fas fa-folder-plus">Add New Category</i>
                </a>
            </div>

            <div class="col-lg-3 mb-2">
                <a href="admins.php" class="btn btn-warning btn-block">
                    <i class="fas fa-user-plus">Add New Admin</i>
                </a>
            </div>

            <div class="col-lg-3 mb-2">
                <a href="comments.php" class="btn btn-success btn-block">
                    <i class="fas fa-check">Approve Comments</i>
                </a>
            </div>
        </div>
    </div>
</header>


<!--header end-->


<!--Main Area-->
<section class="container py-2 mb-4">
    <div class="row">
        <?php
        //fonksiyonlar
        echo print_error_message();
        echo print_success_message();
        ?>
        <!--left side area start -->
        <div class="col-lg-2 d-none d-md-block">
            <div class="card text-center bg-dark text-white mb-3">
                <h1 class="lead">Posts</h1>
                <h4 class="display-5">
                    <i class=" fab fa-readme "></i>
                    <?php total_posts(); ?>
                </h4>

            </div>

            <div class="card text-center bg-dark text-white mb-3">
                <h1 class="lead">Categories</h1>
                <h4 class="display-5">
                    <i class=" fas fa-folder "></i>
                    <?php total_category(); ?>
                </h4>

            </div>

            <div class="card text-center bg-dark text-white mb-3">
                <h1 class="lead">Admins</h1>
                <h4 class="display-5">
                    <i class=" fas fa-users "></i>
                    <?php total_admins(); ?>

                </h4>

            </div>

            <div class="card text-center bg-dark text-white mb-3">
                <h1 class="lead">Comments</h1>
                <h4 class="display-5">
                    <i class=" fas fa-comments "></i>
                    <?php total_comments(); ?>
                </h4>

            </div>

        </div>
        <!--left side area end -->

        <!--Right Side Area Start-->
        <div class="col-lg-10">
            <h1>Top Posts</h1>
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Date&Time</th>
                    <th>Author</th>
                    <th>Comments</th>
                    <th>Details</th>
                </tr>

                </thead>

                <?php
                //fetch process

                $count = 0;
                global $db;
                $sql = "SELECT * FROM post ORDER BY id desc LIMIT 0,5";
                $stmt = $db->query($sql);
                while ($dataRows = $stmt->fetch()) {
                    $title = $dataRows["title"];
                    $dateTime = $dataRows["date"];
                    $author = $dataRows["author"];
                    $postId = $dataRows["id"];
                    $count++; ?>

                    <tbody>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $dateTime; ?></td>
                        <td><?php echo $author; ?></td>
                        <td>

                  <span class="badge badge-success">
                    <?php

                    global $db;
                    $approveSql = "SELECT COUNT(*) FROM comment WHERE post_id='$postId' AND status='on' ";
                    $approveStmt = $db->query($approveSql);
                    $approveTotal = $approveStmt->fetch();
                    $approveTotal = array_shift($approveTotal);
                    echo $approveTotal; ?>

                  </span>

                            <span class="badge badge-danger">
                    <?php
                    global $db;
                    $disApproveSql = "SELECT COUNT(*) FROM comment WHERE post_id='$postId' AND status='off' ";
                    $disApproveStmt = $db->query($disApproveSql);
                    $disApproveTotal = $disApproveStmt->fetch();
                    $disApproveTotal = array_shift($disApproveTotal);
                    echo $disApproveTotal; ?>

                  </span>
                        </td>

                        <td>
                            <a target="_blank" href="fullpost.php?id=<?php echo $postId; ?>">
                                <span class="btn btn-info">Preview</span>
                            </a>

                        </td>
                    </tr>
                    </tbody>
                <?php
                } ?>
            </table>

        </div>


        <!-- Right Side Area End -->

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

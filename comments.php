<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>
<?php require_once "Includes/Sessions.php"; ?>
<?php
$_SESSION["trackingURL"] = $_SERVER["PHP_SELF"];
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
    <link rel="stylesheet" href="CSS/style.css">
    <title>Document</title>
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
<header class=" py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fas fa-comments" style="color: #27aae1"></i> Manage Comments</h1>
            </div>
        </div>
    </div>
</header>


<!--header end-->

<section class="container py-2 mb-4">
    <div class="row" style="min-height:30px;">
        <div class="col-lg-12" style="min-height:400px;">
            <?php
            //fonksiyonlar
            echo print_error_message();
            echo print_success_message();
            ?>

            <h2>Un-Approved Comments</h2>

            <table class="table table-striped table-hover">

                <thead class="thead-dark">
                <th>NO</th>
                <th>Name</th>
                <th>Date&Time</th>
                <th>Comment</th>
                <th>Approve Status</th>
                <th>Delete</th>
                <th>Details</th>

                </thead>


                <?php
                global $db;
                $sql = "SELECT * FROM comment
                       WHERE status = 'off'
                       ORDER BY com_id desc";

                $stmt = $db->query($sql);
                $count = 0;

                while ($dataRow = $stmt->fetch()) {
                    $commentId = $dataRow["com_id"];
                    $datetime = $dataRow["datetime"];
                    $name = $dataRow["name"];
                    $email = $dataRow["email"];
                    $comment = $dataRow["comment"];
                    $approvedBy = $dataRow["approvedBy"];
                    $status = $dataRow["status"];
                    $postId = $dataRow["post_id"];

                    $count++;

                    if (strlen($name) > 5) {
                        $name = substr($name, 0, 5) . "..";
                    }
                    if (strlen($datetime) > 10) {
                        $datetime = substr($datetime, 0, 9) . "..";
                    }
                    if (strlen($comment) > 20) {
                        $comment = substr($comment, 0, 20) . "..";
                    } ?>
                    <tbody>

                    <tr>

                        <td> <?php echo htmlentities($count) ?> </td>
                        <td> <?php echo htmlentities($name) ?> </td>
                        <td> <?php echo htmlentities($datetime) ?> </td>
                        <td> <?php echo htmlentities($comment) ?> </td>
                        <td><a class="btn btn-success"
                               href="approvecomments.php?id=<?php echo $commentId ?>">Approve</a></td>
                        <td><a class="btn btn-danger" href="deletecomments.php?id=<?php echo $commentId ?> "> Delete</a>
                        </td>
                        <td><a class="btn btn-primary" href="fullpost.php?id=<?php echo $commentId; ?>"> Live
                                Preview </a></td>

                    </tr>


                    </tbody>


                <?php
                } ?>

            </table>

            <h2>Approved Comments</h2>

            <table class="table table-striped table-hover">

                <thead class="thead-dark">
                <th>NO</th>
                <th>Name</th>
                <th>Date&Time</th>
                <th>Comment</th>
                <th>Approve Status</th>
                <th>Delete</th>
                <th>Details</th>

                </thead>


                <?php
                global $db;
                $sql = "SELECT * FROM comment
                       WHERE status = 'on'
                       ORDER BY com_id desc";

                $stmt = $db->query($sql);
                $count = 0;

                while ($dataRow = $stmt->fetch()) {
                    $commentId = $dataRow["com_id"];
                    $datetime = $dataRow["datetime"];
                    $name = $dataRow["name"];
                    $email = $dataRow["email"];
                    $comment = $dataRow["comment"];
                    $approvedBy = $dataRow["approvedBy"];
                    $status = $dataRow["status"];
                    $postId = $dataRow["post_id"];

                    $count++;

                    if (strlen($name) > 5) {
                        $name = substr($name, 0, 5) . "..";
                    }
                    if (strlen($datetime) > 10) {
                        $datetime = substr($datetime, 0, 9) . "..";
                    }
                    if (strlen($comment) > 20) {
                        $comment = substr($comment, 0, 20) . "..";
                    } ?>
                    <tbody>

                    <tr>

                        <td> <?php echo htmlentities($count) ?> </td>
                        <td> <?php echo htmlentities($name) ?> </td>
                        <td> <?php echo htmlentities($datetime) ?> </td>
                        <td> <?php echo htmlentities($comment) ?> </td>
                        <td><a class="btn btn-success" href="disapprovecomments.php?id=<?php echo $commentId ?>">Disapprove</a>
                        </td>
                        <td><a class="btn btn-danger" href="deletecomments.php?id=<?php echo $commentId ?> "> Delete</a>
                        </td>
                        <td><a class="btn btn-primary" href="fullpost.php?id=<?php echo $commentId; ?>"> Live
                                Preview </a></td>

                    </tr>


                    </tbody>


                <?php
                } ?>

            </table>


        </div>
    </div>
</section>


<!--Main Area-->
<section class="container py-2 mb-4">
    <div class="row" style="min-height: 50px; background-color: white;">
        <div class="offset-lg-1 col-lg-10" style="min-height: 50px; background-color: white;">


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

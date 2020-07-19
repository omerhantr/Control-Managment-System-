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
    <?php
    //fonksiyonlar
    echo print_error_message();
    echo print_success_message();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 style="text-align: center;"><i class="fas fa-blog"></i>Blog Posts</h1>
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
        <div class="col-lg-12">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">

                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date&Time</th>
                    <th>Author</th>
                    <th>Image</th>
                    <th>Comments</th>
                    <th>Action</th>
                    <th>Live Preview</th>
                </tr>


                </thead>


                <?php

                //fetch data from database
                $sql = "SELECT * FROM post";
                $stmt = $db->query($sql);
                $count = 0;

                while ($dataRows = $stmt->fetch()) { //veri tabanindan verileri cekmek

                    $id = $dataRows["id"];
                    $postTitle = $dataRows["title"];
                    $category = $dataRows["category"];
                    $dateTime = $dataRows["date"];
                    $author = $dataRows["author"];
                    $image = $dataRows["image"];
                    $post = $dataRows["post"];
                    $count++; ?>

                    <tbody>
                    <tr>
                        <td>
                            <?php echo $count ?>
                        </td>
                        <td>
                            <?php if (strlen($postTitle) > 15) { //basliktan sadece belli bir kısım göstermek icin
                        $postTitle = substr($postTitle, 0, 9) . "...";
                    } ?>
                            <?php echo $postTitle ?>
                        </td>
                        <td>
                            <?php

                            if (strlen($category) > 8) {
                                $category = substr($category, 0, 7) . "...";
                            }

                    echo $category
                            ?>
                        </td>
                        <td>
                            <?php echo $dateTime ?>
                        </td>
                        <td>
                            <?php
                            if (strlen($author) > 10) {
                                $author = substr($author, 0, 5) . "..";
                            } ?>
                            <?php echo $author ?>
                        </td>
                        <td>

                            <image src="Uploads/<?php echo $image ?>" width="100px;" height="100px;">
                        </td>
                        <td>Comments</td>

                        <td>
                            <div class="btn-group">
                                <a href="editpost.php?id=<?php echo $id; ?>"> <span class="btn btn-success">Edit</span></a>
                                <a href="deletepost.php?id=<?php echo $id; ?>"><span
                                            class="btn btn-danger center-block">Delete</span></a>

                            </div>

                        </td>

                        <td><a href="fullpost.php?id=<?php echo $id; ?>" target="_blank"><span class="btn btn-warning">Live Preview</span></a>
                        </td>


                    </tr>

                    </tbody>


                    <?php
                } ?>


            </table>
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

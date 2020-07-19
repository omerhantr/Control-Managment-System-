<?php require_once "Includes/Sessions.php"; ?>
<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>
<?php
$_SESSION["trackingURL"] = $_SERVER["PHP_SELF"];
confirm_login();
?>

<?php
$searchQueryParamater = $_GET["id"];//url üzerindeki id degerini get ile cekiyoruz.

$editSql = "SELECT * FROM post WHERE id='$searchQueryParamater'";
$editStmt = $db->query($editSql);
while ($dataRow = $editStmt->fetch()) {
    $titleUpdate = $dataRow["title"];
    $categoryUpdate = $dataRow["category"];
    $imageUpdate = $dataRow["image"];
    $postUpdate = $dataRow["post"];
}


if (isset($_POST['deletePost'])) {


    //romove item from database
    $dSql = "DELETE FROM post WHERE id='$searchQueryParamater'";
    $delEx = $db->query($dSql);


    if ($delEx) {
        $_SESSION['successMessage'] = "Post deleted successfully";
        Redirect_to("posts.php");
    } else {
        $_SESSION['errorMessage'] = "Something Went Wrong!";
        Redirect_to("posts.php");
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
    <title>Delete Post</title>
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
        <a class="navbar-brand " href="#" style="margin-right: 70px;">CMS</a>

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
                    <a href="Dashboard.php" class="nav-link" style="margin-right: 10px;">Dashboard</a>
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
            //posts sayfasından gelen id degerini get ile url üzerinden çekiyoruz ve sadece o id'ye ait olan bilgileri görüntülüyoruz.


            ?>
            <form action="deletepost.php?id=<?php echo $searchQueryParamater; ?>" method="post"
                  enctype="multipart/form-data">

                <div class="card">
                    <div class="card-header">
                        <h2>Delete Post</h2>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="title"><span class="ct">Post Title:</span></label>
                            <input disabled class="form-control" type="text" name="postTitle" id="title"
                                   placeholder="post title"
                                   autocomplete="off" value="<?php echo $titleUpdate; ?>">
                        </div>

                        <div class="form-group">

                            <span class="FieldInfo"><b>Existing Category :</b><?php echo $categoryUpdate; ?></span>
                            <br>


                        </div>

                        <div class="form-group">
                            <span class="FieldInfo"><b>Existing Image :</b> </span>
                            <img class="mb-2" src="Uploads/<?php echo $imageUpdate; ?> " width="250px" height="200px">


                        </div>

                        <div class="form-group">
                            <label for="postArea"><span class="FieldInfo">Post :</span></label>
                            <textarea disabled class="form-control" id="postArea" name="postArea" rows="8" cols="80">
                            <?php echo $postUpdate ?>
                            </textarea>

                        </div>


                        <div class="row" style="min-height:50px; background-color: white;">
                            <div class="col-lg-6 mb-2">
                                <a href="dashboard.php" class="btn btn-secondary btn-block" style="margin-top: 6px;"><i
                                            class="fas fa-arrow-left"></i>Back to dashboard</a>

                            </div>
                            <div class="col-lg-6 mb-2">
                                <button type="submit" name="deletePost" class="btn btn-danger btn-block"
                                        style="margin-top: 6px;">
                                    <i class="fas fa-trash"></i> Delete
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

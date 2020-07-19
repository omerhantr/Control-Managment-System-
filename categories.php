<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>
<?php require_once "Includes/Sessions.php"; ?>
<?php
$_SESSION["trackingURL"] = $_SERVER["PHP_SELF"];
confirm_login();
?>


<?php
if (isset($_POST['Submit'])) {
    $catTitle = $_POST['categoryTitle'];
    // echo 'clicked';
    if (empty($catTitle)) {
        $_SESSION['errorMessage'] = "All fields must be filled";

        Redirect_to("categories.php");
    } elseif (strlen($catTitle) < 2) {
        $_SESSION['errorMessage'] = "Category title must be greater than 2 character";
        Redirect_to("categories.php");
    } elseif (strlen($catTitle) > 49) {
        $_SESSION['errorMessage'] = "Category title can't be greater than 49";
        Redirect_to("categories.php");
    } else {
        $author = $_SESSION["username"]; //session ile giris yapıldıktan sonra veri direk olarak session üzerinden çekilebilir.
        date_default_timezone_set('Europe/Istanbul');
        $dateTime = "Date : " . date("Y/m/d") . " -- " . date(" h:i:sa");


        $sql = "INSERT INTO category(title , author , datetime) VALUES(?,?,?) ";
        $stmt = $db->prepare($sql);
        $ex = $stmt->execute([$catTitle, $author, $dateTime]);

        if ($ex) {
            $_SESSION['successMessage'] = "You added new category item with id " . $db->lastInsertId() . " successfully";
            Redirect_to("categories.php");
        } else {
            echo "something went wrong";
            Redirect_to("categories.php");
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
    <title>Categories</title>
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
                <h1 class="fas fa-edit" style="text-align: center;">Manage Categories</h1>
            </div>
        </div>
    </div>
</header>


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
            <form action="categories.php" class="" method="POST">
                <div class="card">
                    <div class="card-header">
                        <h2>Add New Category</h2>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="title"><span class="ct">Category Title:</span></label>
                            <input class="form-control" type="text" name="categoryTitle" id="title"
                                   placeholder="Type your title" autocomplete="off">
                        </div>

                        <div class="row" style="min-height:50px; background-color: white;">
                            <div class="col-lg-6 mb-2">
                                <a href="dashboard.php" class="btn btn-secondary btn-block" style="margin-top: 6px;"><i
                                            class="fas fa-arrow-left"></i>Back to dashboard</a>

                            </div>
                            <div class="col-lg-6 mb-2">
                                <button type="submit" name="Submit" class="btn btn-success btn-block"
                                        style="margin-top: 6px;">
                                    <i class="fas fa-check"></i> Publish
                                </button>

                            </div>
                        </div>

                    </div>
                </div>

            </form>

            </table>

            <h2>Existing Categories</h2>

            <table class="table table-striped table-hover">

                <thead class="thead-dark">
                <th>NO</th>
                <th>Name</th>
                <th>Date&Time</th>
                <th>Action</th>

                </thead>


                <?php
                global $db;
                $sql = "SELECT * FROM category ";

                $stmt = $db->query($sql);
                $count = 0;

                while ($dataRow = $stmt->fetch()) {
                    $catId = $dataRow["id"];
                    $categoryTitle = $dataRow["title"];
                    $author = $_SESSION["username"];
                    $date = $dataRow["datetime"];

                    $count++; ?>
                    <tbody>

                    <tr>

                        <td> <?php echo htmlentities($count) ?> </td>
                        <td> <?php echo htmlentities($categoryTitle) ?> </td>
                        <td> <?php echo htmlentities($date) ?> </td>

                        <td><a class="btn btn-danger"
                               href="deletecategory.php?id=<?php echo $catId ?>&name=<?php echo $categoryTitle ?>">
                                Delete</a></td>


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

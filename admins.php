<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>
<?php require_once "Includes/Sessions.php"; ?>
<?php
$_SESSION["trackingURL"] = $_SERVER["PHP_SELF"];
confirm_login();
?>


<?php
if (isset($_POST['Submit'])) {
    $dateTime = "Date : " . date("Y/m/d h:i:sa");
    $userName = $_POST['userName'];
    $name = $_POST['name'];
    $password = $_POST['upassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $addedBy = $_SESSION["username"];

    if (empty($userName) || empty($name) || empty($password)) {
        $_SESSION["errorMessage"] = "All fields must be filled";
        Redirect_to("admins.php");
    } elseif ($password != $confirmPassword) {
        $_SESSION["errorMessage"] = "Passwords can not match";
        Redirect_to("admins.php");
    } elseif (strlen($userName) < 5) {
        $_SESSION["errorMessage"] = "Username must be greater than  5 character...";
        Redirect_to("admins.php");
    } elseif (check_user_name($userName)) {
        $_SESSION["errorMessage"] = " $userName already taken by another someone... ";
        Redirect_to("admins.php");
    } else {
        $sql = "INSERT INTO admin(datetime,username,password,pername,addedBy) VALUES(?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $ex = $stmt->execute([$dateTime, $userName, $password, $name, $addedBy]);

        if ($ex) {
            $_SESSION["successMessage"] = "Admin added...";
            Redirect_to("admins.php");
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
    <title>Admin Page</title>
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
                <h1 class="fas fa-user" style="text-align: center;">Manage Admins</h1>
            </div>
        </div>
    </div>
</header>


<!--header end-->


<!--Main Area-->
<section class="container py-2 mb-4">
    <div class="row" style="min-height: 50px;  ">
        <div class="offset-lg-1 col-lg-10" style="min-height: 450px; ">

            <form action="admins.php" class="" method="POST">
                <div class="card">
                    <div class="card-header">
                        <h2>New Admin</h2>
                    </div>

                    <div class="card-body">
                        <?php
                        //fonksiyonlar
                        echo print_error_message();
                        echo print_success_message();
                        ?>

                        <div class="form-group">
                            <label for="userName"><span class="ct">Username:</span></label>
                            <input class="form-control" type="text" name="userName" id="userName" placeholder="username"
                                   autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="name"><span class="ct">Name:</span></label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="name"
                                   autocomplete="off">
                            <small class="text-warning text-muted">Optional</small>
                        </div>

                        <div class="form-group">
                            <label for="upassword"><span class="ct">Password:</span></label>
                            <input class="form-control" type="password" name="upassword" id="upassword"
                                   placeholder="password" autocomplete="off">
                        </div>


                        <div class="form-group">
                            <label for="confirmPassword"><span class="ct">Confirm Password:</span></label>
                            <input class="form-control" type="password" name="confirmPassword" id="confirmPassword"
                                   placeholder="password" autocomplete="off">
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

            <h2>Existing Admins</h2>

            <table class="table table-striped table-hover">

                <thead class="thead-dark">
                <th>NO</th>
                <th>User Name</th>
                <th>Date&Time</th>
                <th>Action</th>

                </thead>


                <?php
                global $db;
                $sql = "SELECT * FROM admin ";

                $stmt = $db->query($sql);
                $count = 0;

                while ($dataRow = $stmt->fetch()) {
                    $adminId = $dataRow["adminId"];
                    $userName = $dataRow["username"];
                    $author = $_SESSION["username"];
                    $date = $dataRow["datetime"];

                    $count++; ?>
                    <tbody>

                    <tr>

                        <td> <?php echo htmlentities($count) ?> </td>
                        <td> <?php echo htmlentities($userName) ?> </td>
                        <td> <?php echo htmlentities($date) ?> </td>

                        <td><a class="btn btn-danger"
                               href="deleteAdmin.php?id=<?php echo $adminId ?>&name=<?php echo $userName ?>"> Delete</a>
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

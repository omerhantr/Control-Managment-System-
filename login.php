<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>
<?php require_once "Includes/Sessions.php"; ?>

<?php

//giris yapıldıktan sonra tekrar login.php sayfasına ulasımı engellemek icin ...
if (isset($_SESSION["username"])) {
    Redirect_to("dashboard.php");
}

if (isset($_POST["Submit"])) {
    $userName = $_POST["userName"];
    $password = $_POST["password"];

    //  echo $userName;
    //  echo $password;

    if (empty($userName) || empty($password)) {
        $_SESSION["errorMessage"] = "Please fill all fields";
        Redirect_to("login.php");
    } else {
        $foundAccount = checkLogin($userName, $password);

        if ($foundAccount) {
            //$foundAccount dizisinden çekilem veriler $_SESSION[]'a aktarılıyor.
            $_SESSION["username"] = $foundAccount["username"];
            $_SESSION["password"] = $foundAccount["password"];
            $_SESSION["adminId"] = $foundAccount["adminId"];
            //admin login yaptıktan sonra admine ait verileri tüm sayfalarda görüntüleyebiliriz.

            if (isset($_SESSION["trackingURL"])) { //login yaptıktan sonra istenilen sayfaya yönlenmek icin
                Redirect_to($_SESSION["trackingURL"]);
            } else {
                Redirect_to("dashboard.php");
            }

            $_SESSION["successMessage"] = "Welcome " . $_SESSION["username"];
        } else {//eger null donerse
            $_SESSION["errorMessage"] = "Wrong password or username";
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
    <title>Login Page</title>
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


    </div>

</nav>
<!--navbar end-->

<!--header-->
<header class="bg-dark text-white py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>
</header>


<!--header end-->


<!--Main Area-->
<section class="container py-2 mb-4">
    <div class="row">
        <div class=" offset-sm-3 col-sm-6" style="min-height:400px; ">
            <?php
            //fonksiyonlar
            echo print_error_message();
            echo print_success_message();
            ?>
            <div class="card bg-secondary text-light">
                <div class="card-header">

                    <h3>Cms Login</h3>
                </div>
                <div class="card-body bg-dark">
                    <form class="" action="login.php" method="post">
                        <div class="form-group mt-2">
                            <label for="userName"> <span class="FieldInfo">Username</span> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-info"> <i class="fas fa-user"></i>
                    </span>

                                </div>

                                <input class="form-control" type="text" name="userName" id="userName">


                            </div>

                        </div>

                        <div class="form-group mt-2">
                            <label for="password"> <span class="FieldInfo">Password</span> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-info"> <i class="fas fa-lock"></i>
                    </span>

                                </div>

                                <input class="form-control" type="password" name="password" id="password">


                            </div>

                        </div>

                        <input type="submit" name="Submit" class="btn btn-info btn-block" value="Log In">

                    </form>

                </div>


            </div>

        </div>


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

<?php require_once "Includes/Sessions.php"; ?>
<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>
<?php
$_SESSION["trackingURL"] = $_SERVER["PHP_SELF"];
confirm_login();
?>

<?php
$adminId = $_SESSION["adminId"];
global $db;
$sql = "SELECT * FROM admin WHERE adminId='$adminId' ";
$stmt=$db->query($sql);
while ($dataRows = $stmt->fetch()) {
    $existingUserName = $dataRows["username"];
    $existingName = $dataRows["pername"];
    $existingBio = $dataRows["bio"];
    $existingImage = $dataRows["image"];
}



if (isset($_POST['postSubmit'])) {


    //to upload the image
    $image = $_FILES['image']['name'];
    $target = "Uploads/" . basename($_FILES['image']['name']);
    $img_tmp = $_FILES["image"]["tmp_name"];
    $adminId = $_SESSION["adminId"];
    $name = $_POST["name"];
    $bio = $_POST["bio"];

    if (move_uploaded_file($img_tmp, $target)) {
        echo "resim yuklendi";
    } else {
        echo "resim yuklemedi";
    }

    //update profile
    global $db;
    $sql = "UPDATE admin SET pername = ?,image = ?,bio = ? WHERE adminId=? ";
    $stmt = $db->prepare($sql);
    $ex = $stmt->execute([$name,$image,$bio,$adminId]);


    if ($ex) {
        $_SESSION['successMessage'] = "Profile Updated...";
        Redirect_to("myprofile.php");
    } else {
        $_SESSION['errorMessage'] = "Something went wrong...";
        Redirect_to("myprofile.php");
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

<header class="bg-dark text-white py-3 mt-2">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3><i class="fas fa-user mr-2"></i>My Profile</h3>

      </div>

    </div>

  </div>

</header>

<!--header end-->


<!--Main Area-->
<section class="container py-2 mb-4">
    <div class="row" style="min-height: 50px;  ">
      <!--left area-->
      <div class="col-md-3">
        <div class="card">
          <div class="card-header bg-dark text-light">
            <h3><?php echo $existingName ?></h3>
            <p class="small"> <?php echo $existingUserName;  ?>  </p>
          </div>
          <div class="card-body">
            <?php if (empty($existingImage)) { ?>
              <img src="Images/avatar.jpg" class="block img-fluid mb-2" width="150px" height="150px" >
            <?php } else { ?>
            <img src="Uploads/<?php echo $existingImage ?>" class="block img-fluid mb-2" width="150px" height="150px" >
          <?php } ?>
            <p style="font-family:italic; font-size:12px;">Status</p>
            <div class="text" style="font-family:italic;">
              <?php echo $existingBio; ?>
            </div>
          </div>

        </div>

      </div>
      <!--left area-->

        <div class="col-md-9" style="min-height: 450px; ">

            <form action="myprofile.php" method="post" enctype="multipart/form-data">
              <?php
              //fonksiyonlar
              echo print_error_message();
              echo print_success_message();
              ?>



               <div class="card">
                    <div class="card-header">
                        <h2>Edit Profile</h2>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="name"><span class="ct">Name:</span></label>
                            <input class="form-control" type="text" name="name" id="name"
                                   autocomplete="off" value="<?php echo $existingName ?>">
                        </div>



                        <div class="form-group">

                            <div class="custom-file">

                                <label for="imageSelect" class="custom-file-label">Select image for profile picture</label>
                                <input type="file" name="image" id="imageSelect" class="custom-file-input">

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="bio"><span class="FieldInfo">Status:</span></label>
                            <textarea class="form-control" id="bio" name="bio" rows="8" cols="80">
                              <?php echo $existingBio; ?>
                            </textarea>

                        </div>


                        <div class="row" style="min-height:50px; background-color: white;">
                            <div class="col-lg-6 mb-2">
                                <a href="dashboard.php" class="btn btn-secondary btn-block" style="margin-top: 6px;"><i
                                            class="fas fa-arrow-left"></i>Back to dashboard</a>

                            </div>
                            <div class="col-lg-6 mb-2">
                                <button type="submit" name="postSubmit" class="btn btn-success btn-block"
                                        style="margin-top: 6px;">
                                    <i class="fas fa-check"></i> Apply Changes
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

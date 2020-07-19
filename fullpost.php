<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>
<?php require_once "Includes/Sessions.php"; ?>
<?php $searchQueryParamater = $_GET['id']; ?>


<?php
if (isset($_POST['submitCom'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $comment = $_POST["commentArea"];
    $approvedBy = "pending";
    $status = "off";
    $mydate = date("Y-m-d h:i:sa");


    if (empty($name) || empty($email) || empty($comment)) {
        $_SESSION['errorMessage'] = "All fiels must be filled";
        echo print_error_message();
    } elseif (strlen($comment) > 500) {
        $_SESSION['errorMessage'] = "Comment can't be greater than 500 character";
        echo print_error_message();
    } else {
        //burada post_id foreign key yorumları çekmek için post_id'ye ihtiyac var.
        //foreign key : baska bir tablonun id verilerini başka bir tabloya çekmek için kullanilan yapi
        //if i delete the post , deletes the comment too because of foreign key
        $insertSql = "INSERT INTO comment(datetime,name,email,comment,approvedBy,status,post_id) VALUES(?,?,?,?,?,?,?)";
        $insertStmt = $db->prepare($insertSql);
        $ex = $insertStmt->execute([$mydate, $name, $email, $comment, $approvedBy, $status, $searchQueryParamater]);

        if ($ex) {
            $_SESSION["successMessage"] = "Comment added successfully";
            echo print_success_message();
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
    <title>Blog Page</title>
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

            <ul class="navbar-nav ">


                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link" style="margin-right: 10px;">Home</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" style="margin-right: 10px;">About Us </a>
                </li>

                <li class="nav-item">
                    <a href="blog.php?page=1" class="nav-link" style="margin-right: 10px;">Blog</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" style="margin-right: 10px;">Contact Us</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" style="margin-right: 10px;">Features</a>
                </li>


            </ul>


            <ul class="navbar-nav ml-auto">
                <form class="form-inline" action="blog.php">
                    <div class="form-group">
                        <input class="form-control" type="text" name="search" placeholder="What are you looking for?"
                               style="width:400px; margin-top:10px;">
                        </input>
                        <button type="submit" class="btn btn-primary" name="button"
                                style="margin-left:4px;margin-top:10px">Search
                        </button>
                    </div>
                </form>

            </ul>

        </div>

    </div>

</nav>
<!--navbar end-->

<!--header-->

<div class="container">

    <div class="row">

        <!--Main Area Start -->
        <div class="col-sm-8" style="min-height:40px; background:#f4f6ff;">
            <h3>The Complete Responsive CMS blog</h3>
            <h3 class="lead">The completed by yasin</h3>
            <?php

            if (isset($_GET['button'])) {
                $search = $_GET['search'];

                $sql = "SELECT * FROM post
					        WHERE date LIKE :search
							OR title LIKE :search
							OR category LIKE :search
							OR post LIKE :search";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $search . '%');
                $stmt->execute();
            } else {
                //amac : yalnızca bir post'u görüntülemek
                $postIdFromUrl = $_GET["id"]; //url üzerinden id degerini cektik
                if (!isset($postIdFromUrl)) {
                    $_SESSION["errorMessage"] = "Bad Request'";
                    Redirect_to("blog.php");
                }
                $sql = "SELECT * FROM post WHERE id ='$postIdFromUrl'";
                $stmt = $db->query($sql);
            }


            while ($dataRow = $stmt->fetch()) {
                $postId = $dataRow["id"];
                $postDate = $dataRow["date"];
                $postTitle = $dataRow["title"];
                $category = $dataRow["category"];
                $author = $dataRow["author"];
                $image = $dataRow["image"];
                $post = $dataRow["post"]; ?>

                <div class="card ">
                    <img src="Uploads/<?php echo htmlentities($image); ?>" style="max-height:500px;" width="500px"
                         height="300px">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $postTitle; ?></h4>
                        <small class="text-muted">Written by <?php echo htmlentities($author) ?>
                            on <?php echo $postDate ?></small>

                        <hr>
                        <p class="card-text">

                            <?php echo $post ?>
                        </p>

                    </div>
                </div>
            <?php
            } ?>
            <!--Comment Part Start-->

            <!--Fetching existing comment start-->
            <div>
                <br>
                <span class="FieldInfo" style="color:blue;"> <b>Comments</b> </span>
                <br><br>
            </div>
            <?php
            $sql = "SELECT * FROM comment WHERE post_id='$searchQueryParamater' AND status='on' ";
            $stmt = $db->query($sql);

            while ($dataRows = $stmt->fetch()) {
                $comDate = $dataRows['datetime'];
                $comName = $dataRows['name'];
                $comComment = $dataRows['comment']; ?>

            <div>

                <div class="media">
                    <img src="Images/plane.jpg " width="100px" height="200px" class="d-block img-fluid align-self-start"
                         alt="">
                    <div class="media-body ml-2">
                        <h3 class="lead"> <?php echo $comName; ?>   </h3>
                        <p class="small"> <?php echo $comDate; ?>  </p>
                        <p> <?php echo $comComment; ?>  </p>

                    </div>

                </div>

                <?php
            } ?>


            </div>


            <!--Fetching existing comment end-->

            <div class="">
                <form class="" action="fullpost.php?id=<?php echo $searchQueryParamater ?>" method="post">
                    <div class="card mt-1">
                        <div class="card-header">
                            <h5 class="FieldInfo">Share your thougts with us</h5>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-user"></i> </span>
                                </div>
                                <input class="form-control" type="text" name="name" placeholder="name">

                            </div>


                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-envelope"></i> </span>
                                </div>
                                <input class="form-control" type="text" name="email" placeholder="email">

                            </div>


                        </div>

                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend ">
                            <span class="input-group-text">  <i class="fas fa-pencil-alt "> Type Something  </i>  </span>
                            </div>


                            <textarea name="commentArea" rows="8" cols="73" style="border-radius:5px;"
                                      name="postArea"></textarea>

                          </div>

                        </div>

                        <div class="btn ">
                            <button type="submit" name="submitCom" class="btn btn-primary">Submit your comment</button>

                        </div>

                    </div>

                </form>

            </div>
            <!--Comment part end-->
        </div>


        <!--Main Area End -->

        <!--Side Area Start -->
        <div class="col-sm-4 mt-2" style="min-height:60px; background:#e4f9ff;">

        </div>
        <!--Side Area End -->

    </div>


    <!--header end-->


    <!--Main Area-->


    <!--MainAreaEnd-->


</body>

</html>

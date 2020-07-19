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

<div class="container">

    <div class="row">

        <!--Main Area Start -->
        <div class="col-sm-8 mt-3" style="min-height:40px; background:#f4f6ff;">
            <h3>The Complete Responsive CMS blog</h3>
            <h3 class="lead">The completed by yasin</h3>
            <?php
            //fonksiyonlar
            echo print_error_message();
            echo print_success_message();
            ?>

            <?php

            if (isset($_GET['button'])) {
                //SEARCH SECTION
                $search = $_GET['search'];

                $sql = "SELECT * FROM post
					          WHERE date LIKE :search
						      	OR title LIKE :search
						      	OR category LIKE :search
						      	OR post LIKE :search";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':search', '%' . $search . '%');
                $stmt->execute();
            } elseif (isset($_GET["page"])) {
                //PAGENATION SECTION
                //sayfa id sine göre her sayfada 5 adet icerik gostermek icin
                global $db;
                $page = $_GET["page"];
                if ($page == 0 || $page < 0) {
                    $pageFromUrl = 0;
                } else {
                    $pageFromUrl = ($page * 5) - 5;
                }
                //verilen sayıdan itibaren 5 icerik goster
                $pageSql = " SELECT * FROM post ORDER BY id desc LIMIT $pageFromUrl,5 ";
                $stmt = $db->query($pageSql);
            } elseif (isset($_GET['category'])) {
                //tiklanilan kategori ismi ile iliskili postları goruntulemek ıcın
                $catName = $_GET['category'];
                $sql = "SELECT * FROM post WHERE category='$catName' ORDER BY id desc ";
                $stmt = $db->query($sql);
            } else {
                 //MAIIN SECTION
                 $sql = "SELECT * FROM post ORDER BY id desc LIMIT 3 ";
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
                        <h4 class="card-title">
                            <?php echo $postTitle; ?>
                        </h4>
                        <small class="text-muted">
                            <span> <b> Category : <?php echo htmlentities($category) ?> </b></span> Written
                            by <?php echo htmlentities($author) ?> on <?php echo $postDate ?></small>
                        <span style="float:right;" class="badge badge-dark text-light">
              Comments:
                            <?php

                            global $db;
                $countSql = "SELECT COUNT(*) FROM comment WHERE post_id='$postId' AND status='on' ";
                $countStmt = $db->query($countSql);
                $total = $countStmt->fetch();
                $total = array_shift($total);
                echo $total; ?>
            </span>
                        <hr>
                        <p class="card-text">
                            <?php if (strlen($post) > 155) {
                    $post = substr($post, 0, 150) . "...";
                } ?>
                            <?php echo $post ?>
                        </p>
                        <a href="fullpost.php?id=<?php echo $postId; ?>" style="float:right;">
                            <span class="btn btn-info">Read More>></span>

                        </a>
                    </div>
                </div>
            <?php
            } ?>

            <!--pagination-->

            <nav>
                <ul class="pagination pagination-md mt-2">

                    <?php if (isset($page) && !empty($page)) { ?>

                        <?php if ($page>1) { ?>

                            <li class="page-item ">
                                <!-- url uzerinden page degerini aldık ve forward icin bir artırdık-->
                                <a href="blog.php?page=<?php echo $page -1; ?>" class="page-link"> &laquo; </a>
                            </li>
                        <?php } } ?>

                    <?php
                    global $db;
                    $sql = "SELECT COUNT(*) FROM post";
                    $stmt = $db->query($sql);
                    $rowPagination = $stmt->fetch();
                    $totalPosts = array_shift($rowPagination);
                    //echo $totalPosts."<br>";
                    $dividePage = ceil($totalPosts / 3);
                    // echo ceil($dividePage);
                    for ($i = 1; $i < $dividePage; $i++) {
                        if (isset($_GET['page'])) {//blog anasayfasında sayfa numaralarını gostermemek icin



                            if ($i == $_GET['page']) {
                                ?>
                                <!-- page numbers -->
                                <li class="page-item active">
                                    <a href="blog.php?page=<?php echo $i ?>" class="page-link"> <?php echo $i ?> </a>
                                </li>

                            <?php
                            } else { ?>


                                <li class="page-item ">
                                    <a href="blog.php?page=<?php echo $i ?>" class="page-link"> <?php echo $i ?> </a>
                                </li>

                            <?php } ?>


                        <?php
                        }
                    } ?>

                    <!--Createing forward button -->
                    <?php if (isset($page) && !empty($page)) { ?>

                        <?php if (($page+1)<$dividePage) { ?>

                        <li class="page-item ">
                            <!-- url uzerinden page degerini aldık ve forward icin bir artırdık-->
                            <a href="blog.php?page=<?php echo $page + 1; ?>" class="page-link"> &raquo; </a>
                        </li>
                    <?php } } ?>

                </ul>

            </nav>


        </div>


        <!--Main Area End -->

        <!--Side Area Start -->
        <div class="col-sm-4 mt-2" style="min-height:100px; background:#e4f9ff;">
          <div class="card mt-4">
            <div class="card-body">
              <img src="Images/start-blog.jpg" class="d-block img-fluid mb-3" >
              <div class="text-center">

                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque id gravida metus. Morbi blandit ornare libero, et fringilla nibh volutpat eu. In euismod dolor vel eros egestas rutrum ut non dolor. In vitae pellentesque purus. Maecenas vitae tellus malesuada, congue nisl a, vulputate ante. Mauris sagittis turpis justo. Sed volutpat sit amet lorem et dapibus. Nam eget pretium libero. Donec et mauris ut lacus vehicula malesuada. Quisque at tortor in velit sagittis sodales vitae quis metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Sed porttitor ultrices elit, at egestas orci blandit sed. Nulla faucibus metus justo, at viverra mi auctor a.
              </div>

            </div>

          </div>
          <br>
          <div class="card">
            <div class="card-header bg-dark text-light">
                 <h2 class="lead">Sign Up</h2>
            </div>

            <div class="card-body">
              <button type="button" name="button" class="btn btn-success btn-block text-center text-white">Join The Forum</button>
              <button type="button" name="button" class="btn btn-danger btn-block text-center text-white">Login</button>

              <div class="input-group mt-2">
                <input class="form-control" type="text" name="email"  placeholder="Input your email">
                <div class="input-group-append">
                  <button class="btn btn-primary btn-sm text-center text-white" type="submit" name="send">Subscribe</button>

                </div>

              </div>

            </div>



          </div>

          <div class="card mt-2">
            <div class="card-header bg-light text-dark">
                 <h4 class="heading">Categories</h4>

            </div>
            <div class="card-body">
              <?php
                  global $db;
                  $sql = "SELECT * FROM category";
                  $stmt = $db->query($sql);
                  while ($dataRows = $stmt->fetch()) {
                      $cat_id = $dataRows['id'];
                      $title =  $dataRows['title']; ?>

               <a href="blog.php?category=<?php echo $title; ?> "> <?php echo $title ?>  </a>
               <br>
             <?php
                  } ?>


            </div>
          </div>

          <div class="card mt-2">
            <div class="card-header bg-info text-white">
              <h3 class="lead">Recent Posts</h3>

            </div>

            <div class="card-body">
              <?php
                   global $db;
                   $sql = "SELECT * FROM post ORDER BY id desc LIMIT 3"; //artan sırada
                   $stmt = $db->query($sql);
                   while ($dataRow = $stmt->fetch()) {
                       $id = $dataRow["id"];
                       $title = $dataRow["title"];
                       $dateTime = $dataRow["date"];
                       $image = $dataRow["image"]; ?>
              <div class="media">
                <img src="Uploads/<?php echo $image; ?>" class="d-block img-fluid align-self-start" width="90px" height="100px">
                <div class="media-body ml-2">
                <a href="fullpost.php?id=<?php echo $id ?>"> <h4 class="lead"><?php echo $title; ?></h4>  </a>
                  <p class="small"> <?php echo $dateTime; ?> </p>

                </div>

              </div>
              <hr>

            <?php
                   } ?>

            </div>

          </div>



        </div>
        <!--Side Area End -->

    </div>


    <!--header end-->


    <!--Main Area-->


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

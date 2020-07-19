<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>
<?php require_once "Includes/Sessions.php"; ?>

<?php

if (isset($_GET["id"])) {
    $searchQueryParamater = $_GET["id"];

    global $db;
    $adminName = $_SESSION["username"];
    echo $adminName;

    $sql = "UPDATE comment SET status='on' , approvedBy='$adminName' WHERE com_id='$searchQueryParamater' ";
    $ex = $db->query($sql);
    if ($ex) {
        $_SESSION["successMessage"] = "Comment Approved";
        Redirect_to("comments.php");
    } else {
        $_SESSION["errorMessage"] = "Something Went Wrong";
        Redirect_to("comments.php");
    }
}

?>

<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>
<?php require_once "Includes/Sessions.php"; ?>

<?php

$searchQueryParamater = $_GET["id"];
if (isset($_GET["id"])) {
    global $db;
    $adminName = $_SESSION["username"];
    //echo $adminName;
    $sql = " UPDATE comment SET status='off' , approvedBy='$adminName' WHERE com_id='$searchQueryParamater' ";
    $ex = $db->query($sql);

    if ($ex) {
        $_SESSION["successMessage"] = "Comment disapproved..";
        Redirect_to("comments.php");
    } else {
        $_SESSION["errorMessage"] = "Something went wrong";
        Redirect_to("comments.php");
    }
}


?>

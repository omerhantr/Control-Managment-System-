<?php require_once "Includes/Sessions.php"; ?>
<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>

<?php
$searchQueryParamater = $_GET["id"];

global $db;

$sql = "DELETE FROM comment WHERE com_id='$searchQueryParamater'";
$stmt = $db->prepare($sql);

$ex = $stmt->execute();

if ($ex) {
    $_SESSION["successMessage"] = "Comment deleted...";
    Redirect_to("comments.php");//bildirimi comment.php üzerinde bildirmek istiyorsak yapmamız gereken tek sey link comments.php ye yönlendirmek
} else {
    $_SESSION["errorMessage"] = "Something Went Wrong";
    Redirect_to("comments.php");
}


?>

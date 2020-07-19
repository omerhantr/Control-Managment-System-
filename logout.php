<?php require_once "Includes/Sessions.php"; ?>
<?php require_once "Includes/Functions.php"; ?>

<?php
$_SESSION["username"] = null;
$_SESSION["password"] = null;
$_SESSION["adminId"] = null;

session_destroy();
Redirect_to("login.php");

?>

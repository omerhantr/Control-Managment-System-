<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>
<?php require_once "Includes/Sessions.php"; ?>

<?php
if (isset($_GET["id"])) {
    $searchQueryParameter = $_GET["id"];

    global $db;
    $sql = "DELETE FROM admin WHERE adminId='$searchQueryParameter' ";
    $stmt = $db->prepare($sql);
    $ex = $stmt->execute();

    if ($ex) {
        $_SESSION["successMessage"] = $_GET["name"] . " deleted..";
        Redirect_to("admins.php");
    } else {
        $_SESSION["errorMessage"] = "Something went wrong..";
        Redirect_to("admins.php");
    }
}

?>

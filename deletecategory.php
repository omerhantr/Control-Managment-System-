<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/Functions.php"; ?>
<?php require_once "Includes/Sessions.php"; ?>

<?php
if (isset($_GET["id"])) {
    $searchQueryParameter = $_GET["id"];

    //delete process
    global $db;
    $sql = "DELETE FROM category WHERE id='$searchQueryParameter' ";
    $stmt = $db->prepare($sql);
    $ex = $stmt->execute();

    if ($ex) {
        $_SESSION["successMessage"] = $_GET["name"] . " Category deleted...";
        Redirect_to("categories.php");
    } else {
        $_SESSION["errorMessage"] = "Something went wrong!";
        Redirect_to("categories.php");
    }
}

?>

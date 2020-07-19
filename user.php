<?php
require_once "Includes/DB.php";
$redirect_page = "user.php";

if (isset($_POST['button'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $address = $_POST['address'];


    $sql = "insert into user(name, surname, address) VALUES (?,?,?)";
    $stmt = $db->prepare($sql);
    $ex = $stmt->execute([$fname, $lname, $address]);

    if ($ex) {
        header("Location:" . $redirect_page);

        echo "veriler eklendi";
    } else {
        echo "veriler eklenemedi";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>


<form action="user.php" method="post">
    <table>
        <tr>
            <td>Firstname</td>
            <td><input type="text" name="firstname"></td>
        </tr>

        <tr>
            <td>Lastname</td>
            <td><input type="text" name="lastname"></td>
        </tr>

        <tr>
            <td>Address</td>
            <td><input type="text" name="address"></td>
        </tr>

        <tr>
            <td>
                <button type="submit" name="button">Send</button>
            </td>
        </tr>


    </table>

</form>

</body>
</html>

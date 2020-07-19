<?php
require_once "Includes/DB.php";


function Redirect_to($newLocation)
{
    header("Location:" . $newLocation);
    exit;
}


function check_user_name($userName)
{
    global $db;

    $sql = "SELECT username FROM admin WHERE username = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$userName]);

    $Result = $stmt->rowCount();// rowCount() ile sorgudan etkilenen satır sayısı döndürülür.

    if ($Result > 0) {
        return true;
    } else {
        return false;
    }


}


function checkLogin($userName, $password)
{
    global $db;
    $sql = "SELECT *
           FROM admin
           WHERE username=? AND password=?";

    $stmt = $db->prepare($sql);
    $stmt->execute([$userName, $password]);
    $result = $stmt->rowCount();

    if ($result == 1) {
        return $foundAccount = $stmt->fetch(); //burada $foundAccount verileri tutan bir dizidir.
    } else {
        return null;
    }


}


function confirm_login()
{
    if (isset($_SESSION["username"])) {
        return true;
    } else {
        $_SESSION["errorMessage"] = "Please login to access to this page.";
        Redirect_to("login.php");
    }
}


function total_posts()
{

    global $db;
    $sql = "SELECT COUNT(*) FROM comment ";
    $stmt = $db->query($sql);
    $totalRows = $stmt->fetch();//array yapiyi direk olarak string yapı icerisine atamazsın
    $total = array_shift($totalRows);
    echo $total;
}


function total_category()
{
    global $db;
    $sql = "SELECT COUNT(*) FROM category";
    $stmt = $db->query($sql);
    $totalRows = $stmt->fetch();
    $totalRows = array_shift($totalRows);
    echo $totalRows;
}


function total_admins()
{
    global $db;
    $sql = "SELECT COUNT(*) FROM admin";
    $stmt = $db->query($sql);
    $totalRows = $stmt->fetch();
    $totalRows = array_shift($totalRows);
    echo $totalRows;

}


function total_comments()
{
    global $db;
    $sql = "SELECT COUNT(*) FROM comment";
    $stmt = $db->query($sql);
    $totalRows = $stmt->fetch();
    $totalRows = array_shift($totalRows);
    echo $totalRows;

}

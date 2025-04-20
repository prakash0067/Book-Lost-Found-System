<?php 

session_start();

if (!isset($_SESSION["logged_user_id"])) {
    header("Location: ../../login/index.php");
    die;
}

?>
<?php 

$user_id = $_SESSION["logged_user_id"];

require_once("../../login/common-functions.php");

// database connection

databaseConnect();
$sql = "SELECT * FROM user WHERE user_id = ? LIMIT 1";

if ($stmt = $con->prepare($sql)) {
    $stmt->bind_param("i",$userid);
    $userid = $user_id;
    $stmt->execute();
    $result = $stmt->get_result();
}

$user_information = $result->fetch_assoc();
$result->free();
$stmt->close();

$user_name = $user_information["user_name"];

$user_email = $user_information["email_id"];

databaseClose();

?>
<?php 

if (isset($_GET["rid"]) && isset($_GET["bid"])) {

    $rid = trim($_GET["rid"]);
    $bid = trim($_GET["bid"]);

    require_once("../../login/common-functions.php");

    databaseConnect();

    $sql2 = "SELECT fine_amount,file_name FROM bookrelease WHERE bookrelease_id = ?";

    if ($stmt = $con->prepare($sql2)) {
        $stmt->bind_param("i",$release_id);
        $release_id = $rid;
        $stmt->execute();
        $result = $stmt->get_result();
        $book_data = $result->fetch_assoc();
    }

    $file_remove_name = $book_data["file_name"];
    $fine_amount = $book_data["fine_amount"];

    $result->free();
    $stmt->close();

    // deleting file
    if ($fine_amount == 0) {
        $file_remove_path = "../assets/images/applications/";
    }
    else {
        $file_remove_path = "../assets/images/receipts/";
    }

    $remove_path = $file_remove_path.$file_remove_name;
    unlink($remove_path);

    // deleting record
    $sql = "DELETE FROM bookrelease WHERE bookrelease_id = ?";

    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i",$release_id);
        $release_id = $rid;
        $stmt->execute();
    }

    $stmt->close();

    // updating book status

    $sql3 = "UPDATE bookentry SET release_status = 0 WHERE book_id = ?";

    if ($stmt = $con->prepare($sql3)) {
        $stmt->bind_param("i",$book_id);
        $book_id = $bid;
        $stmt->execute();
    }
    $stmt->close();

    databaseClose();

    header("Location: history.php");
}

?>
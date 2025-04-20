<?php 

if (isset($_POST["submit_release"])) {
    require_once("../../login/common-functions.php");


    // to move file

    $file_name = $_FILES["applicationORreceipt"]["name"];
    $file_tmp = $_FILES["applicationORreceipt"]["tmp_name"];

    // file path ===============================
    if (trim($_POST["fineAmount"]) == 0) {
        $path = "C:/xampp/htdocs/bms/bookmark/assets/images/applications/";
    }
    else {
        $path = "C:/xampp/htdocs/bms/bookmark/assets/images/receipts/";
    }

    $file_saved_name = checkFileExist($file_name,$path);
    move_uploaded_file($file_tmp,$path.$file_saved_name);


    // database related 

    $sql = "INSERT INTO bookrelease(book_id,enrollment_no,release_date,fine_amount,file_name,receipt_no,receipt_date) VALUES(?,?,?,?,?,?,?)";

    
    if (trim($_POST["receiptNo"]) == "") {
        $receiptNum = "NULL";
    }
    else {
        $receiptNum = trim($_POST["receiptNo"]);
    }
    
    if (trim($_POST["receiptDate"]) == "") {
        $receiptDate = "0000-00-00";
    }
    else {
        $receiptDate = trim($_POST["receiptDate"]);
    }

    databaseConnect();

    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("iisdsss",$bookID,$Enroll,$ReleaseDT,$FineAmt,$FileName,$rNo,$rDate);
        $bookID = trim($_POST["bid"]);
        $Enroll = trim($_POST["enrollmentNo"]);

        date_default_timezone_set('Asia/Kolkata');
        $ReleaseDT = date("Y-m-d H:i:s");
        $FineAmt = trim($_POST["fineAmount"]);
        $FileName = $file_saved_name;

        $rNo = $receiptNum;
        $rDate = $receiptDate;
        
        $stmt->execute();
    }

    $stmt->close();

    // updating status
    $sql = "UPDATE bookentry SET release_status = 1 WHERE book_id = ?";

    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i",$bID);
        $bID = trim($_POST["bid"]);
        $stmt->execute();
        setcookie("success-mssg","1",time()+3);
    }


    $stmt->close();
    databaseClose();

    header("Location: book-release.php");
}

?>
<?php

$stud_enroll = trim($_POST["enrollmentNo"]);

// checking the past records

$sql = "SELECT COUNT(*) AS count FROM bookrelease WHERE enrollment_no = ?";

require_once("../../login/common-functions.php");

databaseConnect();

if ($stmt = $con->prepare($sql)) {
    $stmt->bind_param("i",$enroll_no);
    $enroll_no = $stud_enroll;
    $stmt->execute();
    $result = $stmt->get_result();
    $query_data = $result->fetch_assoc();
}

$result->free();
$stmt->close();

// number of time book released 
$no_of_fines = $query_data["count"];

if ($no_of_fines == 0) {
    $upload_mssg = "Upload application";
    $style = "display: none;";
    $fine_amounts = 0;
}
else {
    $upload_mssg = "Upload receipt";
    $style = "display: block;";

    $count = $no_of_fines; 
    if ($count == 1) {
        $fine_amounts = 50;
    } elseif ($count == 2) {
        $fine_amounts = 100;
    } else {
        $fine_amounts = pow(2, $count - 2) * 100;
    }
}

databaseClose();

?>

<div class="mt-4 mb-3">
    <p class="card-text"><b> Number of times happened before: </b> <span class="book-search-result-font"><?php echo $no_of_fines; ?></span></p>

    <p class="card-text"><b> Fine amount (&#8377;): </b> <span class="book-search-result-font"><?php echo $fine_amounts; ?></span></p>
</div>

<div style="<?php echo $style; ?>">
    <div class="form-group">
        <label>Receipt Number <span class="span-compl-msgs">*</span></label>
        <input type="text" class="form-control" id="Receiptnumber"
            placeholder="Receipt number" name="receiptNo">
        <span class="error-mssg-book-entry" id="mssg30"></span>
    </div>


    <div class="form-group">
        <label>Receipt Date <span class="span-compl-msgs">*</span></label>
        <input type="date" class="form-control" id="ReceiptDate"
            placeholder="Receipt date" name="receiptDate" max="<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y-m-d"); ?>">
        <span class="error-mssg-book-entry" id="mssg40"></span>
    </div>
</div>

<div class="form-group">
    <label><?php echo $upload_mssg; ?></label>
    <input type="file" class="form-control" id="applicationORreceipt" name="applicationORreceipt"/>
    <span class="max-ssize-warning">(8MB max size and png, jpg or jpeg only)</span>
    <span class="error-mssg-book-entry" id="mssg2"></span>
</div>

<input type="hidden" name="fineAmount" id="fineAmt" value="<?php echo $fine_amounts; ?>">

<button type="submit" class="btn btn-gradient-primary me-2" name="submit_release" value="release">Release</button>
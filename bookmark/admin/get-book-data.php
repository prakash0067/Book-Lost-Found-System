<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">

<?php 

$monthandyear = trim($_POST["monthANDyear"]);
$category = trim($_POST["searchCategory"]);

require_once("../../login/common-functions.php");

//1----------------
$sql = "SELECT * FROM bookentry WHERE MONTH(entry_date) = ? AND YEAR(entry_date) = ?";
$sql2 = "SELECT COUNT(*) AS count FROM bookentry WHERE MONTH(entry_date) = ? AND YEAR(entry_date) = ?";


//2--------------
$sql3 = "SELECT book_name,bookentry.isbn_no AS isbn_no,bookrelease.enrollment_no AS enrollment_no,release_date,call_no,book_no,receipt_no FROM bookrelease,bookentry WHERE bookrelease.book_id = bookentry.book_id AND MONTH(release_date) = ? AND YEAR(release_date) = ?";

$sql4 = "SELECT COUNT(*) AS count FROM bookrelease WHERE MONTH(release_date) = ? AND YEAR(release_date) = ?";

databaseConnect();

if ($category == "bookentry") {
    if ($stmt = $con->prepare($sql2)) {
        $stmt->bind_param("ss",$month,$year);
        $month = date('m', strtotime($monthandyear));
        $year = date('Y', strtotime($monthandyear));
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
    }

    $num_of_book_entry = $data["count"];
    echo '<h4 class="card-title">Number of book entry: '.$num_of_book_entry.'</h4>';

    $result->free();
    $stmt->close();

    // books list

    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("ss",$month,$year);
        $month = date('m', strtotime($monthandyear));
        $year = date('Y', strtotime($monthandyear));
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;
    }

    if ($num_row > 0) {
        echo '<p class="card-description mt-3"> Books List </p>';

        echo '<div class="table-responsive"><table class="table"><tr><th>S.No.</th><th>Book Name</th><th>ISBN Number</th><th>Call Number</th><th>Book Number</th>';

        $counter = 1;
        while($data = $result->fetch_assoc()) {
            echo '<tr><td>'.$counter.'</td><td>'.$data["book_name"].'</td><td>'.$data["isbn_no"].'</td><td>'.$data["call_no"].'</td><td>'.$data["book_no"].'</td></tr>';

            $counter++;
        }

        echo '</table></div>';
    }

    $result->free();
    $stmt->close();
}
else {
    if ($stmt = $con->prepare($sql4)) {
        $stmt->bind_param("ss",$month,$year);
        $month = date('m', strtotime($monthandyear));
        $year = date('Y', strtotime($monthandyear));
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
    }

    $num_of_book_released = $data["count"];
    echo '<h4 class="card-title">Number of book released: '.$num_of_book_released.'</h4>';

    $result->free();
    $stmt->close();

    // books list

    if ($stmt = $con->prepare($sql3)) {
        $stmt->bind_param("ss",$month,$year);
        $month = date('m', strtotime($monthandyear));
        $year = date('Y', strtotime($monthandyear));
        $stmt->execute();
        $result = $stmt->get_result();
        $num_row = $result->num_rows;
    }

    if ($num_row > 0) {
        echo '<p class="card-description mt-3"> Books List </p>';

        echo '<div class="table-responsive"><table class="table"><tr><th>S.No.</th><th>Book Name</th><th>ISBN Number</th><th>Call Number</th><th>Book Number</th><th>Receipt Number</th><th>Enrollment No</th><th>Release Date</th>';


        $counter = 1;
        while($data = $result->fetch_assoc()) {
            $dateTime = new DateTime($data["release_date"]);
            $formattedDate = $dateTime->format('M d, Y');

            // receipt number
            if ($data["receipt_no"] == "") {
                $receipt_no = '-';
            }
            else {
                $receipt_no = $data["receipt_no"];
            }

            echo '<tr><td>'.$counter.'</td><td>'.$data["book_name"].'</td><td>'.$data["isbn_no"].'</td><td>'.$data["call_no"].'</td><td>'.$data["book_no"].'</td><td>'.$receipt_no.'</td><td>'.$data["enrollment_no"].'</td><td>'.$formattedDate.'</td></tr>';

            $counter++;
        }

        echo '</table></div>';
    }

    $result->free();
    $stmt->close();
}





databaseClose();
?>

        </div>
    </div>
</div>
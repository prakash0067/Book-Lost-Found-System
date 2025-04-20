<?php
require_once('../tcpdf/tcpdf.php');
require_once('../../login/common-functions.php');



// Generate PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('BookMark');
$pdf->SetTitle('Book List');
$pdf->SetSubject('Converting table to PDF');
$pdf->SetKeywords('TCPDF, table, PDF, PHP');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Add a page
$pdf->AddPage();


// category-wise
$category = trim($_GET["ctgy"]);

databaseConnect();

if ($category == 1) {

    $sql = "SELECT book_name,entry_date,isbn_no,call_no,book_no,enrollment_no AS enroll FROM bookentry";
    $result = $con->query($sql);


    // Generate the table
    $html = '<h4> Total Books List (include released and left books) </h4>';
    $html .= '<table border="1">';
    $html .= '<tr><th>S.No.</th><th>Book Name</th><th>Entry Date</th><th>ISBN No</th><th>Call No</th><th>Book No</th></tr>';

    $counter = 1;
    while ($row = $result->fetch_assoc()) {

        // dates
        $dateTime = new DateTime($row["entry_date"], new DateTimeZone('UTC'));
        $formattedDate = $dateTime->format('M j, Y');

        $html .= '<tr><td>'.$counter.'</td><td>' . $row["book_name"] . '</td><td>' . $formattedDate . '</td><td>' . $row["isbn_no"] . '</td><td>' . $row["call_no"] . '</td><td>' . $row["book_no"] . '</td></tr>';
        $counter++;
    }

    $html .= '</table>';

}
elseif ($category == 2) {

    $sql = "SELECT book_name,isbn_no,entry_date,release_date,bookrelease.enrollment_no AS enroll,book_no,call_no FROM bookrelease,bookentry WHERE bookentry.book_id = bookrelease.book_id";

    $result = $con->query($sql);


    // Generate the table
    $html = '<h4> Books Released List </h4>';
    $html .= '<table border="1">';
    $html .= '<tr><th>S.No.</th><th>Book Name</th><th>Entry Date</th><th>Release Date</th><th>ISBN No</th><th>Call No</th><th>Book No</th><th>Enrollment No</th></tr>';

    $counter = 1;
    while ($row = $result->fetch_assoc()) {

        // dates
        $dateTime = new DateTime($row["entry_date"], new DateTimeZone('UTC'));
        $formattedDate = $dateTime->format('M j, Y');

        $dateTime2 = new DateTime($row["release_date"], new DateTimeZone('UTC'));
        $formattedDate2 = $dateTime2->format('M j, Y');

        $html .= '<tr><td>'.$counter.'</td><td>' . $row["book_name"] . '</td><td>' . $formattedDate . '</td><td>' . $formattedDate2 . '</td><td>' . $row["isbn_no"] . '</td><td>' . $row["call_no"] . '</td><td>' . $row["book_no"] . '</td><td>' . $row["enroll"] . '</td></tr>';
        $counter++;
    }

    $html .= '</table>';

}
elseif ($category == 3) {

    $sql = "SELECT book_name,entry_date,isbn_no,call_no,book_no,enrollment_no AS enroll FROM bookentry WHERE release_status = 0";

    $result = $con->query($sql);

    // Generate the table
    $html = '<h4> Books List </h4>';
    $html .= '<table border="1">';
    $html .= '<tr><th>S.No.</th><th>Book Name</th><th>Entry Date</th><th>ISBN No</th><th>Call No</th><th>Book No</th></tr>';

    $counter = 1;
    while ($row = $result->fetch_assoc()) {

        // dates
        $dateTime = new DateTime($row["entry_date"], new DateTimeZone('UTC'));
        $formattedDate = $dateTime->format('M j, Y');

        $html .= '<tr><td>'.$counter.'</td><td>' . $row["book_name"] . '</td><td>' . $formattedDate . '</td><td>' . $row["isbn_no"] . '</td><td>' . $row["call_no"] . '</td><td>' . $row["book_no"] . '</td></tr>';
        $counter++;
    }

    $html .= '</table>';

}
else {
    $sql = "SELECT book_name,entry_date,isbn_no,call_no,book_no,enrollment_no AS enroll FROM bookentry WHERE MONTH(entry_date) = MONTH(CURRENT_DATE()) AND YEAR(entry_date) = YEAR(CURRENT_DATE());";

    $result = $con->query($sql);

    // Generate the table
    $html = '<h4> Books entry in current month </h4>';
    $html .= '<table border="1">';
    $html .= '<tr><th>S.No.</th><th>Book Name</th><th>Entry Date</th><th>ISBN No</th><th>Call No</th><th>Book No</th></tr>';

    $counter = 1;
    while ($row = $result->fetch_assoc()) {

        // dates
        $dateTime = new DateTime($row["entry_date"], new DateTimeZone('UTC'));
        $formattedDate = $dateTime->format('M j, Y');

        $html .= '<tr><td>'.$counter.'</td><td>' . $row["book_name"] . '</td><td>' . $formattedDate . '</td><td>' . $row["isbn_no"] . '</td><td>' . $row["call_no"] . '</td><td>' . $row["book_no"] . '</td></tr>';
        $counter++;
    }

    $html .= '</table>';
}


$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF as a download
$pdf->Output('booklist.pdf', 'D');

databaseClose();
?>

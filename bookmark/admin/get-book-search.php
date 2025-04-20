<?php 

$search_data = trim($_POST["bookData"]);
$search_category = trim($_POST["searchCategory"]);


if ($search_category == "bookName") {
    $sql = "SELECT * FROM bookentry WHERE release_status = 0 AND book_name LIKE ?";
}
elseif ($search_category == "authorName") {
    $sql = "SELECT * FROM bookentry WHERE release_status = 0 AND author_name LIKE ?";
}
elseif ($search_category == "enrollNo") {
    $sql = "SELECT * FROM bookentry WHERE release_status = 0 AND enrollment_no LIKE ?";
}
elseif ($search_category == "isbnNumber") {
    $sql = "SELECT * FROM bookentry WHERE release_status = 0 AND isbn_no LIKE ?";
}
elseif ($search_category == "callNumber") {
    $sql = "SELECT * FROM bookentry WHERE release_status = 0 AND call_no LIKE ?";
}
else {
    $sql = "SELECT * FROM bookentry WHERE release_status = 0 AND book_no LIKE ?";
}

// getting books result from database

require_once("../../login/common-functions.php");

databaseConnect();

if ($stmt = $con->prepare($sql)) {
    $stmt->bind_param("s",$searches_data);
    $searches_data = '%'.$search_data.'%';
    $stmt->execute();
    $result = $stmt->get_result();
    $numRows = $result->num_rows;
}

$stmt->close();

if ($numRows > 0) {
    while ($book_details = $result->fetch_assoc()) {

        // setting up athor and enroll
        if ($book_details["enrollment_no"] == 0) {
            $enroll = '-';
        }
        else {
            $enroll = $book_details["enrollment_no"];
        }

        if ($book_details["author_name"] == 'NULL') {
            $author = '-';
        }
        else {
            $author = $book_details["author_name"];
        }

        echo '<div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div>
        <div class="col-12 stretch-card grid-margin border overflow-auto-book-search" onclick="goToBookRelease('.$book_details["book_id"].')">
        <div class="p-1">
            <img src="../assets/images/books-cover/'.$book_details["cover_pic"].'" alt="Book cover" style="width: 210px; height: 210px;">
        </div>
        <div class="card card-img-holder">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3"><b> Title:</b><span class="book-search-result-font"> '.$book_details["book_name"].' 
                </span></h4>
                <h4 class="font-weight-normal mb-3"><b> Author Name:</b><span class="book-search-result-font"> '.$author.' 
                </span></h4>
                <h6 class="card-text"><b>
                    ISBN Number:</b><span class="book-search-result-font"> '.$book_details["isbn_no"].'
                </span></h6>
                <h6 class="card-text"><b>
                    Enrollment Number:</b><span class="book-search-result-font"> '.$enroll.'
                </span></h6>
                <h6 class="card-text"><b>
                    Call Number:</b><span class="book-search-result-font"> '.$book_details["call_no"].'
                </span></h6>
                <h6 class="card-text"><b>
                    Book Number:</b><span class="book-search-result-font"> '.$book_details["book_no"].'
                </span></h6>
            </div>
        </div>
    </div>
    </div>
								</div>
							</div>
						</div>';

    }
}
else {
    echo "<p class='p-4'>No such book</p>";
}

$result->free();

databaseClose();

?>
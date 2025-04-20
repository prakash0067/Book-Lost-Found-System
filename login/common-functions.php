<?php

$con;
// function to connect to database
function databaseConnect() {

    // connection details
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "bookmark";

    global $con;
    $con = new mysqli($host,$user,$password,$dbname) or die("Could not connect to database");
}

// function to close database connection
function databaseClose() {
    global $con;
    $con->close();
}

// function to change file name
function checkFileExist($file_name, $path) {
    // variable to store new file name
    $newfilename = $file_name;
    $counter = 1;
    while(file_exists($path.$newfilename)) {
        $name = explode('.',$file_name)[0];
        $ext = explode('.',$file_name)[1];
        $newfilename = $name.'('.$counter.").".$ext;
        $counter++;
    }
    return $newfilename;
}

?>
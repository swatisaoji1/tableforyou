<?php

// Connection
$servername = 'sfsuswe.com';
$username = "yyan1";
$password = "group14";
$dbname = "student_yyan1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_errno) {
    die("Connection failed: " . $conn->connect_error);
}

function db_insert($sql) {
    global $conn;
    //TODO lets return something on error so that we can give better messages to user?? 
    if ($conn->query($sql) !== TRUE) {
        echo "ERROR";
        printf($conn->error);
    }

    return $conn->insert_id;
}

function db_query($sql) {
    global $conn;
    return $conn->query($sql);
}

function db_update($sql) {
    global $conn;
    if ($conn->query($sql) !== TRUE) {
        echo "ERROR";
        printf($conn->error);
    }
}

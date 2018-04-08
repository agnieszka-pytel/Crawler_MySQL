<?php
$servername = "localhost";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Create database
$sql = "CREATE DATABASE IF NOT EXISTS Crawler";
if ($conn->query($sql) === TRUE) {
    echo '<p>'."Database created successfully".'</p>';
} else {
    echo '<p>'."Error creating database: " . $conn->error.'</p>';
}
$conn->select_db("Crawler");
// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS SitesViewed (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    site TEXT,
    date TIMESTAMP
)";
if (mysqli_query($conn, $sql)) {
    echo '<p>'."Table SitesViewed created successfully".'</p>';
} else {
    echo '<p>'."Error creating table: " . mysqli_error($conn).'</p>';
}
// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS SitesAwaiting (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    site VARCHAR(200),
    date TIMESTAMP
)";
if (mysqli_query($conn, $sql)) {
    echo '<p>'."Table SitesAwaiting created successfully".'</p>';
} else {
    echo '<p>'."Error creating table: " . mysqli_error($conn).'</p>';
}
$result = mysqli_query($conn, "SHOW COLUMNS FROM `SitesAwaiting` LIKE 'content'");
$exists = (mysqli_num_rows($result)) ? TRUE:FALSE;
if (!$exists) {
    // sql to ALTER table
    $sql = "ALTER TABLE SitesAwaiting ADD links TEXT after site";
    if (mysqli_query($conn, $sql)) {
        echo '<p>'."ALTER TABLE SitesAwaiting successfully".'</p>';
    } else {
        echo '<p>'."Error creating table: " . mysqli_error($conn).'</p>';
    }
    
    // sql to ALTER table
    $sql = "ALTER TABLE SitesAwaiting MODIFY site VARCHAR(2048)";
    if (mysqli_query($conn, $sql)) {
        echo '<p>'."ALTER TABLE SitesAwaiting successfully".'</p>';
    } else {
        echo '<p>'."Error creating table: " . mysqli_error($conn).'</p>';
    }
}
$result = mysqli_query($conn, "SHOW COLUMNS FROM `SitesViewed` LIKE 'content'");
$exists = (mysqli_num_rows($result)) ? TRUE:FALSE;
if (!$exists) {
    // sql to ALTER table
    $sql = "ALTER TABLE SitesViewed ADD links TEXT after site";
    if (mysqli_query($conn, $sql)) {
        echo '<p>'."ALTER TABLE SitesViewed successfully".'</p>';
    } else {
        echo '<p>'."Error creating table: " . mysqli_error($conn).'</p>';
    }
    
    // sql to ALTER table
    $sql = "ALTER TABLE SitesViewed MODIFY site VARCHAR(2048)";
    if (mysqli_query($conn, $sql)) {
        echo '<p>'."ALTER TABLE SitesViewed successfully".'</p>';
    } else {
        echo '<p>'."Error creating table: " . mysqli_error($conn).'</p>';
    }
}
$conn->close();
?>
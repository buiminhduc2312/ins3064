<?php
// config.php

// Thay doi thong tin ket noi neu can (Laragon mac dinh la root, mat khau rong)
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'travel_website');

// Ket noi MySQLi
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Kiem tra ket noi
if ($conn->connect_error) {
    die("Ket noi database that bai: " . $conn->connect_error);
}

// Thiet lap ma hoa ky tu (van nen giu UTF-8 cho du lieu trong DB)
$conn->set_charset("utf8mb4");

// Ham de lay danh sach nguoi dung (dung cho viec gan created_by)
function getUsers($conn) {
    $sql = "SELECT user_id, username FROM users";
    $result = $conn->query($sql);
    $users = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    return $users;
}
?>
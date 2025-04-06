<?php
session_start();
include("../../db/connect.php");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$keyword = $_GET['keyword'];
$sql = "SELECT * FROM tbl_chat WHERE (user_send='{$_SESSION['username']}' OR user_get='{$_SESSION['username']}') AND (user_send LIKE '%$keyword%' OR user_get LIKE '%$keyword%')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    }
}
$conn->close();
?>

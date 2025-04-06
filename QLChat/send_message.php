<?php
session_start();
include("../../db/connect.php");


if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mess_id = intval($_POST['mess_id']);
    $message = $conn->real_escape_string($_POST['message']);
    $user_send = $_SESSION['username'];
    $time = date('Y-m-d H:i:s');

    $sql = "INSERT INTO tbl_messages (mess_id, user_send, messages, time) VALUES ($mess_id, '$user_send', '$message', '$time')";
    if ($conn->query($sql) === TRUE) {
        echo "Tin nhắn đã được gửi.";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

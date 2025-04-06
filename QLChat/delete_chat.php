<?php
include("../../db/connect.php");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mess_id = intval($_POST['mess_id']);
    $sql = "DELETE FROM tbl_chat WHERE mess_id = $mess_id";
    $sql2 = "DELETE FROM tbl_messages WHERE mess_id = $mess_id";

    if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
        echo "Đoạn chát đã được xóa.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
$conn->close();
?>

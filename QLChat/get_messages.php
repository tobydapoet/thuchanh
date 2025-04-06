<?php
session_start();
include("../../db/connect.php");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['mess_id'])) {
    $mess_id = intval($_GET['mess_id']);
    $sql = "SELECT * FROM tbl_messages WHERE mess_id = $mess_id ORDER BY time ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $class = ($row['user_send'] === $_SESSION['username']) ? 'sent' : 'received';
            echo "<div class='message $class'>";
            echo "<p>" . htmlspecialchars($row['messages']) . "</p>";
            echo "<span class='time'>" . htmlspecialchars($row['time']) . "</span>";
            echo "</div>";
        }
    } else {
        echo "Hãy gửi lời chào tới người ấy !";
    }
}
$conn->close();
?>

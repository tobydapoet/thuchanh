<?php
session_start(); 
include("../../db/connect.php");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

function getName($username, $chucvu, $conn) {
    if ($chucvu == 0) {
        $table = "tbl_nhanvien";
        $select_ten = "TenNV";
    } else if ($chucvu == 1) {
        $table = "tbl_sinhvien";
        $select_ten = "TenSV";
    } else {
        return "Không xác định";
    }
    
    $sql = "SELECT $select_ten FROM $table WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row[$select_ten];
    } else {
        return "Không tìm thấy tên";
    }
}

if (isset($_GET['username'])) {
    $user_send = $_SESSION['username'];
    $user_get = $_GET['username'];

    $sql_check = "SELECT * FROM tbl_chat WHERE (user_send='$user_send' AND user_get='$user_get') OR (user_send='$user_get' AND user_get='$user_send')";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {

        echo "<script>alert('Cuộc trò chuyện này đã tồn tại!');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
    } else {

        $sql_insert = "INSERT INTO tbl_chat (user_send, user_get) VALUES ('$user_send', '$user_get')";
        if ($conn->query($sql_insert) === TRUE) {

            header("Location: index.php");
            exit();
        } else {
            echo "Lỗi: " . $sql_insert . "<br>" . $conn->error;
        }
    }
}


$sql = "SELECT username, chucvu, online FROM tbl_account";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tài khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .account-list {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .account-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }
        .account-item:last-child {
            border-bottom: none;
        }
        .account-info {
            flex-grow: 1;
        }
        .status {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-left: 10px;
        }
        .status.online {
            background-color: #4CAF50;
        }
        .status.offline {
            background-color: #e0e0e0;
        }
        .back-link {
            text-decoration: none;
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
        }
        .back-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="account-list">
        <a href="index.php" class="back-link">Back</a>
        <div class="content">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $name = getName($row["username"], $row["chucvu"], $conn);
                    $status = $row["online"] ? "online" : "offline";
                    $chucvu = $row["chucvu"] == 0 ? "Nhân viên" : "Sinh viên";
                    echo "<div class='account-item'>";
                    echo "<div class='account-info'>";
                    echo "<h4>" . htmlspecialchars($name) . "</h4>";
                    echo "<p>" . htmlspecialchars($chucvu) . "</p>";
                    echo "</div>";
                    echo "<div class='status " . htmlspecialchars($status) . "'></div>";
                    echo "<a href='get_accounts.php?username=" . urlencode($row['username']) . "'>Chọn</a>";
                    echo "</div>";
                }
            } else {
                echo "Không có tài khoản nào.";
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>

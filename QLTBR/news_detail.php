<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Thông Báo</title>
    <link rel="stylesheet" href="thongbaosv.css?v=<?php echo time()?>">
</head>
<body>
    <header>
        <div class="container">
            <a href="javascript:history.back()" class="back-button">&#8249; Quay lại</a>
        </div>
    </header>
    <main>
        <div class="container">
            <section id="news-detail">
                <?php
                // Kiểm tra xem có tham số STT truyền từ URL không
                if (isset($_GET['stt'])) {
                    // Lấy STT từ URL
                    $stt = $_GET['stt'];

                    // Kết nối cơ sở dữ liệu
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "ktx";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Kết nối thất bại: " . $conn->connect_error);
                    }

                    $sql = "SELECT tieude, noidung, ngay_tao FROM tbl_thongbao WHERE stt = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $stt);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        $stmt->bind_result($tieude, $noidung, $ngay_tao);
                        $stmt->fetch();

                        echo "<article>";
                        echo "<header><h1 class='title'>" . $tieude . "</h1></header>";
                        echo "<p class='time'>" . getTimeAgo($ngay_tao) . "</p>";
                        echo "<div class='content'>" . $noidung . "</div>";
                        echo "</article>";
                    } else {
                        echo "<p class='error'>Không tìm thấy thông báo.</p>";
                    }

                    $stmt->close();
                    $conn->close();
                } else {
                    echo "<p class='error'>Không có thông báo nào được chọn.</p>";
                }
                function getTimeAgo($datetime) {
                    $now = new DateTime();
                    $ago = new DateTime($datetime);
                    $diff = $now->diff($ago);

                    if ($diff->y > 0) {
                        return $diff->y . " năm trước";
                    } elseif ($diff->m > 0) {
                        return $diff->m . " tháng trước";
                    } elseif ($diff->d > 0) {
                        return $diff->d . " ngày trước";
                    } elseif ($diff->h > 0) {
                        return $diff->h . " giờ trước";
                    } elseif ($diff->i > 0) {
                        return $diff->i . " phút trước";
                    } else {
                        return "Vừa xong";
                    }
                }
                ?>
            </section>
        </div>
    </main>
</body>
</html>

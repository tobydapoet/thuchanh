<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Thông Báo</title>
    <link rel="stylesheet" href="thongbaosv.css?v=<?php echo time()?>">
</head>
<body>
   
        <header>
            <h1>Thông báo</h1>
            <button id="hided" onclick="hided()"><</button>
        </header>
        <section id="news">
            <?php
            // Kết nối cơ sở dữ liệu
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ktx";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // Truy vấn dữ liệu từ bảng tbl_thongbao
            $sql = "SELECT stt, tieude, noidung, ngay_tao FROM tbl_thongbao";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Hiển thị danh sách thông báo
                while($row = $result->fetch_assoc()) {
                    echo "<article>";
                    echo "<h2 class='title'>" . $row["tieude"] . "</h2>";
                    echo "<p class='time'>" . getTimeAgo($row["ngay_tao"]) . "</p>";
                    echo "<div class='content'>" . $row["noidung"] . "</div>";
                    echo "<a href='news_detail.php?stt=" . $row['stt'] . "' class='read-more'>Xem chi tiết</a>";
                    echo "</article>";
                }
            } else {
                echo "Không có thông báo nào.";
            }

            $conn->close();

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
   
</body>
</html>
<script>
    function hided() {
        parent.document.getElementById("iframe_tb").style.display = "none";
    }
</script>
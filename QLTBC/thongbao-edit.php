<?php
    include("../db/connect.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="load.js"></script>
    <link rel="stylesheet" href="thongbao.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="contain">
        <?php
        if (isset($_POST['btnSua'])) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $matb = $_GET['MaTB'];
            $tieude = $_POST['txtTieude'];
            $noidung = $_POST['txtNoidung'];
            $ngaytao = date('Y-m-d');
            $result = mysqli_query($conn, "UPDATE tbl_thongbao SET  TieuDe='$tieude', NoiDung='$noidung', Ngay_tao='$ngaytao' WHERE MaTB='$matb'");
            if ($result) {
                echo '<script>alert("Sửa thành công");
                    window.location.href = "thongbao.php"
                    </script>';
            }
        } else {
            $matb = $_GET['MaTB'];
            $result_print = mysqli_query($conn, "SELECT * FROM tbl_thongbao WHERE MaTB = '$matb'");
            if ($result_print) {
                $row = mysqli_fetch_assoc($result_print);
                $res_matb = $row['MaTB'];
                $res_manv = $row['MaNV'];
                $res_tieude = $row['TieuDe'];
                $res_noidung = $row['NoiDung'];
                $res_ngaytao = $row['Ngay_tao'];
            }
        }
        ?>
        <div class="container-add">
            <h2>SỬA THÔNG BÁO</h2>
            <form method="POST" onsubmit="return check()" class="form_them">

                <div class="form-group">
                    <label for="txtMaVD">Mã thông báo:</label>
                    <input type="text" id="txtMaTB" name="txtMaVD" value = '<?php echo $res_matb ?>' disabled>
                </div>
                <div class="form-group">
                    <input type="text" id="txtTieude" name="txtTieude" value = '<?php echo $res_tieude ?>' required autocomplete="off" placeholder="Nhập tiêu đề">
                </div>
                <div class="form-group">
                <textarea id="txtNoidung" name="txtNoidung" placeholder="Nhập nội dung" required autocomplete="off"><?php echo htmlspecialchars($res_noidung); ?></textarea>
                </div>
                <div class="form-group-btn">
                    <button type="submit" name="btnSua" id="btnThem" value="Ghi dữ liệu" i class='bx bxs-edit-alt'></i> Ghi dữ liệu</button>
                    <button type="button" onclick="goBack()" i class='bx bx-horizontal-left'></i> Quay Lại</button>
                </div>
        </div>
    </div>
    <script>
        function goBack() {
            window.location.href = "thongbao.php";
        }
    </script>


</body>

</html>
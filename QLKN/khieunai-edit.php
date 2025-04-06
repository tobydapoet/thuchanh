<?php
    include("../db/connect.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="load.js"></script>
    <link rel="stylesheet" href=khieunai.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="contain">
        <?php
        $query_nv = "SELECT MaNV,TenNV FROM tbl_nhanvien";
        $result_nv = mysqli_query($conn, $query_nv);
        
        $query_sv = "SELECT MaSV,TenSV FROM tbl_sinhvien";
        $result_sv = mysqli_query($conn, $query_sv);
        if (isset($_POST['btnThem'])) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $mavd = $_GET['MaVD'];
            $tieude = $_POST['txtTieude'];
            $noidung = $_POST['txtNoidung'];
            $ngaytao = date('Y-m-d');
            $manv = $_POST['txtMaNV'];
            $result = mysqli_query($conn, "UPDATE tbl_vande SET MaNV='$manv',  TieuDe='$tieude', NoiDung='$noidung', Ngay_tao='$ngaytao' WHERE MaVD='$mavd' ");
            if ($result) {
                echo '<script>alert("Sửa thành công");
                    window.location.href = "khieunai.php"
                    </script>';
            }
        } else {
            $mavd = $_GET['MaVD'];
            $result_print = mysqli_query($conn, "SELECT * FROM tbl_vande WHERE MaVD = '$mavd'");
            if ($result_print) {
                $row = mysqli_fetch_assoc($result_print);
                $res_mavd = $row['MaVD'];
                $res_masv = $row['MaSV'];
                $res_manv = $row['MaNV'];
                $res_tieude = $row['TieuDe'];
                $res_noidung = $row['NoiDung'];
                $res_ngaytao = $row['Ngay_tao'];
            }
        }
        ?>
        <div class="container-add">
            <h2>SỬA KHIẾU NẠI</h2>
            <form method="POST" onsubmit="return check()" class="form_them">

                <div class="form-group">
                    <label for="txtMaVD">Mã vấn đề:</label>
                    <input type="text" id="txtMaVD" name="txtMaVD" value = <?php echo $res_mavd ?> disabled>
                </div>
                <div class="form-group">
                    <label for="dtpNgaytao">Mã sinh viên:</label>
                    <select name="txtMaSV" id="txtMaSV" disabled >
                        <?php
                        if ($result_nv && mysqli_num_rows($result_nv) > 0) {
                            while ($row_sv = mysqli_fetch_assoc($result_sv)) {
                                $selected = ($row_sv["MaSV"] == $res_masv) ? "selected" : "";
                                echo '<option value="' . $row_sv["MaSV"] . '"' . $selected . '>' . $row_sv["MaSV"] . ' - ' . $row_sv["TenSV"] . '</option>';
                            }
                        } else {
                            echo '<option value="">Không có dữ liệu</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txtMaNV">Chọn nhân viên:</label>
                    <select name="txtMaNV" id="txtMaNV" <?php if($_SESSION['ChucVu'] == 1) echo 'disabled'; ?>>
                        <?php
                        if ($result_nv && mysqli_num_rows($result_nv) > 0) {
                            while ($row_nv = mysqli_fetch_assoc($result_nv)) {
                                $selected = ($row_sv["MaNV"] == $res_manv) ? "selected" : "";
                                echo '<option value="' . $row_nv["MaNV"] . '"' . $selected . '>' . $row_nv["MaNV"] . ' - ' . $row_nv["TenNV"] . '</option>';
                            }
                        } else {
                            echo '<option value="">Không có dữ liệu</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <textarea type="text" id="txtTieude" name="txtTieude" required autocomplete="off" placeholder="Nhập tiêu đề" <?php if($_SESSION['ChucVu'] == 1) echo 'readonly'; ?>><?php echo htmlspecialchars($res_tieude); ?></textarea>
                </div>
                <div class="form-group">
                <textarea id="txtNoidung" name="txtNoidung" placeholder="Nhập nội dung" required autocomplete="off" <?php if($_SESSION['ChucVu'] == 1) echo 'readonly'; ?>><?php echo htmlspecialchars($res_noidung); ?></textarea>
                </div>
                <div class="form-group-btn">
                    <?php
                        if($_SESSION['ChucVu'] != 1){
                            echo'
                              <button type="submit" name="btnThem" id="btnThem" value="Ghi dữ liệu" i class="bx bxs-edit-alt"></i> Ghi dữ liệu</button>
                            ';
                        }
                    ?>
                   
                    <button type="button" onclick="goBack()" i class='bx bx-horizontal-left'></i> Quay Lại</button>
                </div>
        </div>
    </div>
    <script>
        function goBack() {
            window.location.href = "khieunai.php";
        }
    </script>


</body>

</html>
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
            $ngaytao = date('Y-m-d');
            $mavd = $_POST['txtMaVD'];
            $tieude = $_POST['txtTieude'];
            $noidung = $_POST['txtNoidung'];
            $manv = $_POST['txtMaNV'];
            $masv = $_SESSION['masv'];
            $check=mysqli_query($conn, "SELECT * FROM tbl_thongbao WHERE MaTB='$MaTB'");
            if(mysqli_num_rows($check)> 0){
                echo '<script>alert("Khiếu nại này đã tồn tại")</script>';
            }
            else{
                $result = mysqli_query($conn, "INSERT INTO tbl_vande (MaVD, Tieude, NoiDung, MaSV, MaNV, Ngay_tao) VALUES ('$mavd', '$tieude', '$noidung', '$masv', '$manv', '$ngaytao')");
                if ($result) {
                    echo '<script>alert("Thêm thành công");
                    window.location.href = "khieunai.php"
                    </script>';
                }
            }
        }
        ?>
        <div class="container-add">
            <h2>THÊM KHIẾU NẠI</h2>
            <form method="POST" onsubmit="return check()" class="form_them">

                <div class="form-group">
                    <label for="txtMaVD">Mã vấn đề:</label>
                    <input type="text" id="txtMaVD" name="txtMaVD" required autocomplete="off" placeholder="Nhập mã khiếu nại (VD:KN00)" pattern="^KN\d{2,3}$" title="Hãy nhập đúng định dạng mã khiếu nại">
                </div>
                <div class="form-group">
                    <label for="txtMaNV">Chọn nhân viên:</label>
                    <select name="txtMaNV" id="txtMaNV" required>
                        <?php
                        if ($result_nv && mysqli_num_rows($result_nv) > 0) {
                            while ($row_nv = mysqli_fetch_assoc($result_nv)) {
                                echo '<option value="' . $row_nv["MaNV"] . '">' . $row_nv["MaNV"] . ' - ' . $row_nv["TenNV"] . '</option>';
                            }
                        } else {
                            echo '<option value="">Không có dữ liệu</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" id="txtTieude" name="txtTieude" required autocomplete="off" placeholder="Nhập tiêu đề">
                </div>
                <div class="form-group">
                    <textarea id="txtNoidung" name="txtNoidung" placeholder="Nhập nội dung" required autocomplete="off"></textarea>
                </div>
                <div class="form-group-btn">
                    <button type="submit" name="btnThem" id="btnThem" value="Ghi dữ liệu" i class='bx bxs-edit-alt'></i> Ghi dữ liệu</button>
                    <button type="button" onclick="goBack()" i class='bx bx-horizontal-left'></i> Quay Lại</button>
                </div>
        </div>
    </div>
    <script>
        function goBack() {
            window.location.href = "khieunai.php";
        }
    </script>
    <script>
        function goBack() {
            window.location.href = "khieunai.php";
        }
    </script>


</body>

</html>
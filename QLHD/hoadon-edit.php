<?php
require("../db/connect.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href=hoadon.css?v=<?php echo time() ?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="../QLKTX/load.js"></script>
</head>

<body>
        <form method="post" class="container">
                <?php
                if (isset($_POST['btn-edit'])) {
                        date_default_timezone_set('Asia/Ho_Chi_Minh');

                        $mahd = $_GET['MaHD'];

                        $numberE = $_POST['numberEcost'];
                        $perE = $_POST['perEcost'];

                        $numberW = $_POST['numberWcost'];
                        $perW = $_POST['perWcost'];
                        $sumO = $_POST['Ocost'];

                        $room = $_POST['room'];

                        $ngayLapHoaDon = date('Y-m-d');

                        $manv = $_POST['staff'];
                        $result_check = mysqli_query($conn, "SELECT * FROM tbl_phong WHERE MaPhong = '$room'");
                        if ($result_check) {
                                $row = mysqli_fetch_assoc($result_check);
                                $costroom = $row['GiaPhong'];
                                $result = mysqli_query($conn, "UPDATE tbl_hoadon SET MaNV='$manv', GiaDien='$perE',SoDien='$numberE',SoNuoc='$numberW' ,GiaNuoc='$perW', MaPhong='$room', ChiPhiKhac='$sumO', NgayLapHD='$ngayLapHoaDon', GiaPhong='$costroom' WHERE MaHD='$mahd' ");
                                if ($result) {
                                        echo '<script>alert("Sửa thành công");
                                            window.location.href = "hoadon.php"
                                            </script>';
                                }
                        }
                } else {
                        $mahd = $_GET['MaHD'];
                        $result_print = mysqli_query($conn, "SELECT * FROM tbl_hoadon WHERE MaHD = '$mahd'");
                        if ($result_print) {
                                $row = mysqli_fetch_assoc($result_print);
                                $res_mahd = $row['MaHD'];
                                $res_MaNV = $row['MaNV'];
                                $res_maphong = $row['MaPhong'];
                                $res_giadien = $row['GiaDien'];
                                $res_gianuoc = $row['GiaNuoc'];
                                $res_sodien = $row['SoDien'];
                                $res_sonuoc = $row['SoNuoc'];
                                $res_chiphikhac = $row['ChiPhiKhac'];
                        }
                }
                ?>
                <h3>Sửa hóa đơn</h3>
                <div class="row">
                        <div class="col">
                                <div class="box">
                                        <label>Mã hóa đơn</label>
                                        <input name='MaHD' type="text" value=<?php echo $res_mahd ?> disabled>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col">
                                <div class="box">
                                        <label>Mã nhân viên</label>
                                        <select name="staff" id="staff" required>
                                                <?php
                                                $result = mysqli_query($conn, "SELECT * FROM tbl_nhanvien");
                                                if ($result && mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                                $selected = ($row["MaNV"] == $res_MaNV) ? "selected" : "";
                                                                echo '<option value="' . $row["MaNV"] . '"' . $selected . '>' . $row["MaNV"] . ' - ' . $row["TenNV"] . ' </option>';
                                                        }
                                                }
                                                ?>
                                        </select>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col">
                                <div class="box">
                                        <label>Mã phòng</label>
                                        <select name="room" id="room" required>
                                                <?php
                                                $result = mysqli_query($conn, "SELECT * FROM tbl_phong");
                                                if ($result && mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                                $selected = ($row["MaPhong"] == $res_maphong) ? "selected" : "";
                                                                $giaPhongFormatted = number_format($row['GiaPhong'], 0, ',', '.') . 'đ';
                                                                echo '<option value="' . $row["MaPhong"] . '"' . $selected . '>' . $row["TenPhong"] . ' - ' . $giaPhongFormatted . ' </option>';
                                                        }
                                                }
                                                ?>
                                        </select>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col">
                                <div class="box">
                                        <label>Số điện</label>
                                        <input name='numberEcost' type="text" required autocomplete="off" value='<?php echo $res_sodien?>'>
                                </div>
                        </div>
                        <div class="col">
                                <div class="box">
                                        <label>Giá 1 số điện</label>
                                        <input name='perEcost' type="text" required autocomplete="off" value='<?php echo $res_giadien?>'>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col">
                                <div class="box">                        
                                        <label>Số nước</label>
                                        <input name='numberWcost' type="text" required autocomplete="off" value='<?php echo $res_sonuoc?>'>
                                </div>
                        </div>
                        <div class="col">
                                <div class="box">
                                        <label>Giá 1 số nước</label>
                                        <input name='perWcost' type="text" required autocomplete="off" value='<?php echo $res_gianuoc?>'>
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col">
                                <div class="box">                               
                                        <label>Chi phí khác</label>
                                        <input name='Ocost' type="text" required autocomplete="off" value='<?php echo $res_chiphikhac?>'>
                                </div>
                        </div>
                </div>
                <div class="btn-function">
                        <?php if ($_SESSION['ChucVu'] == 0 || $_SESSION['ChucVu'] == 2) {
                                echo '  <input type="submit" value="Sửa" name="btn-edit">';
                        } else {
                                echo '<script>
                                document.getElementById("Wcost").disabled = true;
                                document.getElementById("Ecost").disabled = true;
                                document.getElementById("Ocost").disabled = true;
                                document.getElementById("staff").disabled = true;
                                document.getElementById("room").disabled = true;
                                </script>';
                        }
                        ?>
                        <button type="button" onclick="goBack()"></i> Quay Lại</button>
                        <script>
                                function goBack() {
                                        window.location.href = "hoadon.php";
                                }
                        </script>

                </div>
        </form>
</body>

</html>
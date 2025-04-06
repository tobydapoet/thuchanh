<?php
    require("../db/connect.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=hoadon.css?v=<?php echo time()?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="../QLKTX/load.js"></script>
</head> 
<body>
        <form method="post" class="container">
                <?php
                        $manv = $_SESSION['manv'];
                        $tennv = $_SESSION['hoten'];
                        if(isset($_POST['btn-add']))
                        {
                                date_default_timezone_set('Asia/Ho_Chi_Minh');

                                $mahd = $_POST['MaHD'];
                                
                                $numberE = $_POST['numberEcost'];
                                $perE = $_POST['perEcost'];

                                $numberW = $_POST['numberWcost'];
                                $perW = $_POST['perWcost'];

                                $sumO = $_POST['Ocost'];

                                $room = $_POST['room'];


                                $ngayLapHoaDon = date('Y-m-d');

                                $result_check = mysqli_query($conn,"SELECT * FROM tbl_phong WHERE MaPhong = '$room'");
                                if($result_check)
                                {
                                        $row = mysqli_fetch_assoc($result_check);
                                        $costroom = $row['GiaPhong'];
                                        $check = mysqli_query($conn,"SELECT * FROM tbl_hoadon WHERE MaHD = '$mahd'");
                                        if(mysqli_num_rows($check)> 0){
                                                echo '<script>alert("Hóa đơn này đã tồn tại")</script>';
                                        }
                                        else
                                        {
                                                $result = mysqli_query($conn,"INSERT INTO tbl_hoadon (MaNV, MaHD, SoDien ,SoNuoc , GiaDien, GiaNuoc, MaPhong, ChiPhiKhac, NgayLapHD, GiaPhong) VALUES ('$manv','$mahd','$numberE','$numberW','$perE ','$perW ','$room','$sumO','$ngayLapHoaDon','$costroom')");
                                                if($result)
                                                {
                                                echo '<script>alert("Thêm thành công");
                                                window.location.href = "hoadon.php"
                                                </script>';
                                                }
                                        }
                                }

                        }
                ?>
                <h3>Thêm hóa đơn</h3>
                <div class="row">
                    <div class="col">
                        <div class="box">
                            <label>Mã hóa đơn</label>
                            <input type="MaHD" name="MaHD" id="MaHD" autocomplete="off" placeholder="Nhập mã hóa đơn(VD:HD00)" pattern="^HD\d{2,3}$" title="Hãy nhập đúng định dạng mã hóa đơn"required>
                        </div>        
                    </div>
                </div>
                <div class="row">
                        <div class="col"> 
                                <div class="box">
                                        <label>Mã phòng</label>
                                        <select name="room" required>
                                                <?php
                                                $result=mysqli_query($conn,"SELECT * FROM tbl_phong");
                                                if ($result && mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result) ) {
                                                                $giaPhongFormatted = number_format($row['GiaPhong'], 0, ',', '.') . 'đ';
                                                                echo '<option value="' . $row["MaPhong"] . '">'.$row["TenPhong"].' - '.$giaPhongFormatted.' </option>';
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
                                        <input name='numberEcost' type="text" required autocomplete="off">
                                </div>
                        </div>
                        <div class="col">
                                <div class="box">
                                        <label>Giá 1 số điện</label>
                                        <input name='perEcost' type="text" required autocomplete="off">
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col">
                                <div class="box">                        
                                        <label>Số nước</label>
                                        <input name='numberWcost' type="text" required autocomplete="off">
                                </div>
                        </div>
                        <div class="col">
                                <div class="box">
                                        <label>Giá 1 số nước</label>
                                        <input name='perWcost' type="text" required autocomplete="off">
                                </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col">
                                <div class="box">                               
                                        <label>Chi phí khác</label>
                                        <input name='Ocost' type="text" required autocomplete="off">
                                </div>
                        </div>
                </div>
                <div class="btn-function">
                        <input type="submit" value="Thêm" name="btn-add" required autocomplete="off">
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
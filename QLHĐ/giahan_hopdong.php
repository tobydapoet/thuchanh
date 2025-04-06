<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gia hạn hợp đồng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="them_hopdong.css?v=<?php echo time()?>">
</head>
<body>
        <?php
        include ("../db/connect.php");
            // Truy vấn dữ liệu từ bảng tbl_nhanvien
            $query_nv = "SELECT MaNV, TenNV FROM tbl_nhanvien";
            $result_nv = mysqli_query($conn, $query_nv);

            // Truy vấn dữ liệu từ bảng tbl_sinhvien
            $query_sv = "SELECT MaSV, TenSV FROM tbl_sinhvien";
            $result_sv = mysqli_query($conn, $query_sv);

            // Truy vấn dữ liệu từ bảng tbl_phong
            $query_p = "SELECT MaPhong, TenPhong FROM tbl_phong";
            $result_p = mysqli_query($conn, $query_p);
        ?>

        <?php
            $MaHD = $_GET['MaHD'];
            $MaPhong="";
            $NgayBD ="";
            $NgayKT ="";
            $MaSV="";
            $MaNV="";
            include ("../db/connect.php");
                $query = "SELECT * FROM tbl_hopdong WHERE MaHD = '$MaHD';";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $MaHD = $row["MaHD"];
                        $MaPhong = $row["MaPhong"];
                        $NgayBD =$row["NgayBD"];
                        $NgayKT =$row["NgayKT"];
                        $MaSV = $row["MaSV"];
                        $MaNV = $row["MaNV"];
                    }
            
                }
        ?>


     
        <form method="POST" onsubmit="return check()" class="form_them">
            <div class = "container_hd">
            <div class = "title_hd">GIA HẠN HỢP ĐỒNG</div>
                <div class = "them_hd">
                    <div class = "label_hd">Mã hợp đồng</div>
                    <input type="text" name="txtMaHD" id="txtMaHD" value = "<?php echo $MaHD?>" disabled placeholder="Nhập mã hợp đồng (VD:HD00)" pattern="^HD\d{2,3}$" title="Hãy nhập đúng định dạng mã hợp đồng">
                </div>
        
                <div class="them_hd">
                    <div class="label_hd">Mã phòng</div>
                    <select name="txtMaP" id="txtMaP" disabled >
                        <option value="">Chọn phòng</option>
                        <?php
                        if ($result_p && mysqli_num_rows($result_p) > 0) {
                            while ($row_p = mysqli_fetch_assoc($result_p)) {
                                $selected = ($row_p["MaPhong"] == $MaPhong) ? 'selected' : '';
                                echo '<option value="' . $row_p["MaPhong"] . '" ' . $selected . '>' . $row_p["MaPhong"] . ' - ' . $row_p["TenPhong"] . '</option>';
                            }
                        } else {
                            echo '<option value="">Không có dữ liệu</option>';
                        }
                        ?>
                    </select>
            </div>
                
                <div class = "them_hd">
                    <div class ="label_hd">Ngày bắt đầu</div>
                    <input type="date" name="dtpNgayBD" id="dtpNgayBD" value = "<?php echo $NgayBD?>"  disabled>
                </div>
                
                <div class = "them_hd">
                    <div class ="label_hd">Ngày kết thúc</div>
                    <input type="date" name="dtpNgayKT" id="dtpNgayKT" value = "<?php echo $NgayKT?>" required autocomplete="off" >
                </div>
                
                <div class="them_hd">
                    <div class="label_hd">Mã sinh viên</div>
                    <select name="txtMaSV" id="txtMaSV" disabled >
                        <option value="">Chọn sinh viên</option>
                        <?php
                        if ($result_sv && mysqli_num_rows($result_sv) > 0) {
                            while ($row_sv = mysqli_fetch_assoc($result_sv)) {
                                $selected = ($row_sv["MaSV"] == $MaSV) ? 'selected' : '';
                                echo '<option value="' . $row_sv["MaSV"] . '" ' . $selected . '>' . $row_sv["MaSV"] . ' - ' . $row_sv["TenSV"] . '</option>';
                            }
                        } else {
                            echo '<option value="">Không có dữ liệu</option>';
                        }
                        ?>
                    </select>
            </div>
                
                <div class="them_hd">
                    <div class="label_hd">Mã nhân viên</div>
                    <select name="txtMaNV" id="txtMaNV" disabled >
                        <option value="">Chọn nhân viên</option>
                        <?php
                        if ($result_nv && mysqli_num_rows($result_nv) > 0) {
                            while ($row_nv = mysqli_fetch_assoc($result_nv)) {
                                $selected = ($row_nv["MaNV"] == $MaNV) ? 'selected' : '';
                                echo '<option value="' . $row_nv["MaNV"] . '" ' . $selected . '>' . $row_nv["MaNV"] . ' - ' . $row_nv["TenNV"] . '</option>';
                            }
                        } else {
                            echo '<option value="">Không có dữ liệu</option>';
                        }
                        ?>
                    </select>
            </div>
                
                <div class = "chucnang_hd">
                        <button class = "luu_hd" name="btnGiaHan" id="btnGiaHan" style="display: flex; flex-direction: row-reverse;"> Gia hạn
                              <i class="bi bi-calendar4-week"></i>
                        </button>

                 
                        <button class = "link_quaylai">
                            <i class="bi bi-x-circle"></i>
                            <a href="ql_hopdong.php" id="quaylai">Hủy bỏ </a>
                        </button>
                  
                    
                </div>

            </div>
           
    </form>

                        
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnGiaHan'])){
        $NgayKT = $_POST['dtpNgayKT'];
        include("../db/connect.php");
        if ($NgayBD > $NgayKT) {
            echo '<script>alert("Ngày bắt đầu không được lớn hơn ngày kết thúc")</script>';
        } else {
            $query = "UPDATE tbl_hopdong SET NgayKT = '" . $NgayKT . "' WHERE MaHD = '" . $MaHD . "'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo '<script>
                            alert("Gia hạn hợp đồng thành công");
                            window.location.href = "ql_hopdong.php";
                        </script>';
            } else {
                echo "Gia hạn thất bại";
            }
        }
    }
?>



</body>
</html>
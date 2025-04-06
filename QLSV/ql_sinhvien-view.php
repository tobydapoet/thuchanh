<?php
    session_start();
    require("../db/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <script src="load.js"></script>
    <link rel="stylesheet" href=ql_sinhvien-view.css?v=<?php echo time();?>">
</head>
<body style="background-color: transparent;">
    <form method="post" class="view-form"> 
    <?php
         $masv = $_GET["MaSV"];
         $result = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE MaSV = '$masv'");
         $row=mysqli_fetch_assoc($result);
     
         if(isset($_POST['btn-browse']) && $row){
            if (
                empty($row['MaSV']) || 
                empty($row['MaPhong']) || 
                empty($row['TenSV']) || 
                empty($row['Phone']) || 
                empty($row['CCCD']) || 
                empty($row['DiaChi']) || 
                !isset($row['GioiTinh']) || 
                empty($row['Image']) || 
                empty($row['ImageCCCDFront']) || 
                empty($row['ImageCCCDBack'])
            ) {
                echo "<script>alert('Thông tin chưa đầy đủ để được duyệt');</script>";
            }
            else{
                $roomtag = $row['MaPhong'];
                $result_check = mysqli_query($conn,"SELECT * FROM tbl_phong WHERE MaPhong = '$roomtag'");
                if($result_check)
                {
                    $row_check = mysqli_fetch_assoc($result_check);
                    if($row_check['SoSV']>=$row_check['SoLuong'])
                    {
                        echo "<script>alert('Phòng này đã đầy sinh viên')</script>";
                    }
                    else{
                        $browse1 = mysqli_query($conn,"UPDATE tbl_sinhvien SET TrangThai = '1'  WHERE MaSV='$masv'");
                        if($browse1)
                        {
                            $browse2 = mysqli_query($conn,"UPDATE tbl_phong SET SoSV= SoSV + 1 WHERE MaPhong = '$roomtag'");
                            if($browse2){
                                echo '<script>alert("Duyệt thành công");
                                window.location.href = "ql_sinhvien.php"
                                </script>';
                            }
        
                        }
                        else
                        {
                            echo '<script>alert("Lỗi khi duyệt");
                            window.location.href = "ql_sinhvien.php"
                            </script>';
                        } 
                    }
                }
            }
         }
    ?>
        <div class="header">
            <div style="font-size: 30px;font-weight: 500;"><?php echo $row['TenSV'] ?> / <?php echo $row['MaSV'] ?></div>
            <div class="btn-function">
                <div><a onclick="return confirm('Bạn có muốn xóa không?')" href="ql_sinhvien-delete.php?MaSV=<?php echo $row['MaSV']; ?>">Xóa
                </a></div>
                <div><button name="btn-browse">Duyệt</button></div>
            </div>
        </div>
        <div class = "container-all">
            <div class="info-container">
                <div class="left-info">
                    <div>
                        <img src="../image/<?php echo !empty($row['Image']) ? $row['Image'] : 'images.png';  ?>">
                    </div>
                    <div>
                        <label>Họ tên:</label>
                        <div><?php echo $row['TenSV'] ?></div>
                    </div>
                    <div>
                        <label>Mã sinh viên:</label>
                        <div><?php echo $row['MaSV'] ?></div>
                    </div>
                    <div>
                        <label>Phòng:</label>
                        <div><?php echo $row['MaPhong'] ?></div>
                    </div>
                </div>
                <div class="right-info">
                    <h3>Thông tin cá nhân</h3>
                    <div class="content">
                        <div class="info">
                            <div>Giới tính</div>
                            <h5><?php echo $row['GioiTinh']==0?"Nam":"Nữ" ?></h5>
                        </div>
                        <div class="info">
                            <div>Lớp</div>
                            <h5><?php echo $row['Class'] ?></h5>
                        </div>
                        <div class="info">
                            <div>Số CCCD/CMND</div>
                            <h5><?php echo $row['CCCD'] ?></h5>
                        </div>
                        <div class="info">
                            <div>Địa chỉ</div>
                            <h5><?php echo $row['DiaChi'] ?></h5>
                        </div>
                    </div>
                    <div>
                        <h3 style="margin-top: 30px;">Liên hệ</h3>
                        <div class="info">
                            <div>Số điện thoại</div>
                            <h5><?php echo $row['Phone'] ?></h5>
                        </div>
                    </div>
                    <h3 style="margin-top: 30px;">Ảnh CCCD,CMND</h3>
                    <div class="CCCDImage">
                    <div class="info">
                        <div>Mặt trước</div>
                        <img src="../image/<?php echo !empty($row['ImageCCCDFront']) ? $row['ImageCCCDFront'] : 'images2.jpg';  ?>">
                    </div>
                    <div class="info">
                        <div>Mặt sau</div>
                        <img src="../image/<?php echo !empty($row['ImageCCCDBack']) ? $row['ImageCCCDBack'] : 'images2.jpg';  ?>">
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
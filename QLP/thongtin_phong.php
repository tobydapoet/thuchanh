<?php 
   include ("../db/connect.php");
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="thongtin_phong.css?v=<?php echo time()?>">
</head>
<body>

    <div class="style_thongtin" >
        <div class="style_trai">
            <div class="thongtin_phong">
                <form method="post" class="form_phong">
                    <?php
                        $MaPhong = isset($_GET['Phong']) ? $_GET['Phong'] : '';
                        $list_phong['MaPhong'] = '';
                        $list_phong['TenPhong'] = '';
                        $list_phong['LoaiPhong'] = '';
                        $list_phong['GiaPhong'] = '';
                        $list_phong['MoTa'] = '';
                        $list_phong['SoLuong'] = '';
                        $list_phong['SoSV'] = '';
                    if ($MaPhong) {
                        $query = "SELECT * FROM tbl_phong WHERE MaPhong = '$MaPhong'";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            $list_phong = mysqli_fetch_assoc($result);
                        }
                    }
                    ?>
                    <div class="content">
                        <div class="hienthi_thongtin">
                            <label for="txtMaP" class="label_phong">Mã phòng</label>
                            <input type="text" name="txtMaP" id="txtMaP" class="form-control" value="<?php echo $list_phong['MaPhong'] ?>" readonly>
                            
                        </div>

                        <div class="hienthi_thongtin">
                            <label for="txtTenP" class="label_phong">Tên phòng</label>
                            <input type="text" name="txtTenP" id="txtTenP" class="form-control" value="<?php echo $list_phong['TenPhong']?>" >
                        </div>

                        <div class="hienthi_thongtin">
                            <label for="txtLoaiP" class="label_phong">Loại phòng</label>
                            <div class="form-check">
                                <input type="radio" name="rdoLoaiP" id="rdoNam" class="form-check-input" value="0" <?php echo ($list_phong['LoaiPhong'] == '0') ? 'checked' : ''; ?>>
                                <label for="rdoNam" class="form-check-label">Nam</label>
                                                </div>
                            <div class="form-check">
                                <input type="radio" name="rdoLoaiP" id="rdoNu" class="form-check-input" value="1" <?php echo ($list_phong['LoaiPhong'] == '1') ? 'checked' : ''; ?>>
                                <label for="rdoNu" class="form-check-label">Nữ</label>
                            </div>
                        </div>

                        <div class="hienthi_thongtin">
                            <label for="txtGiaP" class="label_phong">Giá phòng</label>
                            <input type="number" name="txtGiaP" id="txtGiaP" class="form-control" value="<?php echo $list_phong['GiaPhong'] ?>">
                        </div>

                        <div class="hienthi_thongtin">
                            <label for="txtMoTa" class="label_phong">Mô tả</label>
                            <input type="text" name="txtMoTa" id="txtMoTa" class="form-control" value="<?php echo $list_phong['MoTa'] ?>">
                        </div>

                        <div class="hienthi_thongtin">
                            <label for="txtSoLuong" class="label_phong">Số lượng giường</label>
                            <input type="number" name="txtSoLuong" id="txtSoLuong" class="form-control" value="<?php echo $list_phong['SoLuong']?>">
                        </div>

                        <div class="hienthi_thongtin">
                            <label for="txtSoNguoi" class="label_phong">Số người đang ở</label>
                            <input type="number" name="txtSoNguoi" id="txtSoNguoi" class="form-control" value="<?php echo $list_phong['SoSV'] ?>" readonly>
                        </div>
                    </div>
                    <?php 
                    if($_SESSION['ChucVu']=="0" || $_SESSION['ChucVu']=="2")
                    {
                        echo '<div class="chucnang_thongtin">
                            <button type="submit" class="edit_phong" name="sua_phong" id="sua_phong">
                                <i class="bi bi-pencil-square"></i> Sửa phòng
                            </button>
                            <button type="submit" class="delete_phong" name="xoa_phong" id="xoa_phong">
                                <i class="bi bi-trash"></i> Xóa phòng
                            </button>
                        </div> ';
                    }
                    ?>
                </form>

                    <script>
                    document.getElementById('xoa_phong').addEventListener('click', function() {
                        if (confirm("Bạn có chắc chắn muốn xóa phòng này?")) {
                            document.getElementById('xoa_phong').submit();
                        }
                    });
                    </script>

                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sua_phong'])) {
                        $MaPhong = $_POST['txtMaP'];
                        $TenPhong = $_POST['txtTenP'];
                        $LoaiPhong = $_POST['rdoLoaiP'];
                        $GiaPhong = $_POST['txtGiaP'];
                        $MoTa = $_POST['txtMoTa'];
                        $SoLuong = $_POST['txtSoLuong'];
                        $SoSV = $_POST['txtSoNguoi'];

                        $query = "UPDATE tbl_phong SET 
                            TenPhong='$TenPhong', 
                            LoaiPhong='$LoaiPhong', 
                            GiaPhong='$GiaPhong', 
                            MoTa='$MoTa', 
                            SoLuong='$SoLuong', 
                            SoSV='$SoSV' 
                            WHERE MaPhong='$MaPhong'";

                        if (mysqli_query($conn, $query)) {
                            echo '<script>
                            alert("Cập nhật thành công");
                        window.location.href = "thongtin_phong.php?Phong=' . $MaPhong . '";
                        </script>';
                        } else {
                            echo "Lỗi: " . $query . "<br>" . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                    }
                    else if(($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['xoa_phong']))){
                        $MaPhong = $_POST['txtMaP'];
                        $check = mysqli_query($conn,"SELECT * FROM tbl_phong WHERE MaPhong = '$MaPhong'");
                        $check1 =  mysqli_query($conn,"SELECT * FROM tbl_hopdong WHERE MaPhong = '$MaPhong'");
                        $check2 =  mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE MaPhong = '$MaPhong'");
                        if($check)
                        {
                            $row_check = mysqli_fetch_assoc($check);
                            if($row_check['SoSV']!=0)
                            {
                                echo '<script>
                                alert("Phòng còn sinh viên, không thể xóa");
                                window.location.href = "thongtin_phong.php?Phong=' . $MaPhong . '";
                                </script>';
                            }
                            else if($check1 && mysqli_num_rows($check1) > 0){
                                $row_check1 = mysqli_fetch_assoc($check1);
                                if($row_check1['MaHD']!=0)
                                {
                                    echo '<script>
                                    alert("Sinh viên đã có hợp đồng, không thể xóa");
                                    window.location.href = "thongtin_phong.php?Phong=' . $MaPhong . '";
                                    </script>';
                                }
                            }
                            else if($check2 && mysqli_num_rows($check2) > 0){
                                $row_check2 = mysqli_fetch_assoc($check2);
                                if($row_check2['MaSV']!=0)
                                {
                                    echo '<script>
                                    alert("Sinh viên đang ở trong phòng, không thể xóa");
                                    window.location.href = "thongtin_phong.php?Phong=' . $MaPhong . '";
                                    </script>';
                                }
                            }
                            else{
                                $delete = mysqli_query($conn,"DELETE FROM tbl_phong WHERE MaPhong = '$MaPhong'");
                                if ($delete) {
                                    echo '<script>
                                        alert("Xóa thành công");
                                        window.location.href = "thongtin_phong.php?Phong=' . $MaPhong . '";
                                    </script>';
                                   
                                } else {
                                    echo '<script>
                                        alert("Lỗi: Xóa không thành công");
                                        window.location.href = "thongtin_phong.php?Phong=' . $MaPhong . '";
                                    </script>';
                                }
                            }
                            
                        }
                    }
                ?>
            </div>
        </div>
        <div class="style_phai">
            <?php
                $MaPhong = isset($_GET['Phong']) ? $_GET['Phong'] : '';
                $result_sv = mysqli_query($conn, "SELECT * FROM tbl_sinhvien WHERE MaPhong='$MaPhong' AND TrangThai = 1");
                while($row = mysqli_fetch_assoc($result_sv))
                    {
                        echo ' <div class = "container_anh">
                                <img src="../image/'.$row['Image'].' ">
                                    <div class = "info_anhSV">
                                        <div class = "ten_sv">
                                            '.$row['TenSV'].'
                                        </div>
                                        <div class = "sdt_sv">
                                            Tel: '.$row['Phone'].'
                                        </div>
                                    </div>
                                </div>
                        ';
                        
                      
                    }
            ?>
        </div>

       
    </div>


</body>
</html>

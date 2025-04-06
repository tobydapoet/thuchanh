<?php
    include("../db/connect.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="load.js"></script>
    <title>Thêm hợp đồng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="them_hopdong.css?php echo time(); ?>">
</head>
<body>
       
        <?php
        include ("../db/connect.php");
        if (!$conn) {
            echo "Kết nối thất bại, lỗi: " . mysqli_connect_error();
        } else {
            $query_sv = "SELECT * FROM tbl_sinhvien WHERE TrangThai='1'";
            $result_sv = mysqli_query($conn, $query_sv);

        }
?>

        <form method="POST" onsubmit="return check()" class="form_them">
            <div class = "container_hd">
                <div class = "title_hd">THÊM HỢP ĐỒNG</div>
                <div class = "them_hd">
                    <div class = "label_hd">Mã hợp đồng</div>
                    <input type="text" name="txtMaHD" id="txtMaHD"  required autocomplete="off" placeholder="Nhập mã hợp đồng(VD:HD00)" pattern="^HD\d{2,3}$" title="Hãy nhập đúng định dạng mã hợp đồng">
                </div>
                
                <div class = "them_hd">
                    <div class ="label_hd">Ngày bắt đầu</div>
                    <input type="date" name="dtpNgayBD" id="dtpNgayBD" required autocomplete="off">
                </div>
                
                <div class = "them_hd">
                    <div class ="label_hd">Ngày kết thúc</div>
                    <input type="date" name="dtpNgayKT" id="dtpNgayKT" required autocomplete="off">
                </div>
                
                <div class = "them_hd">
                    <div class ="label_hd"> Mã sinh viên</div>
                    <select name="txtMaSV" id="txtMaSV" required autocomplete="off">
                            <option value="" >Chọn sinh viên</option>
                            <?php
                            if ($result_sv && mysqli_num_rows($result_sv) > 0) {
                                while ($row_sv = mysqli_fetch_assoc($result_sv)) {
                                    echo '<option value="' . $row_sv["MaSV"] . '">' . $row_sv["MaSV"] . ' - ' . $row_sv["TenSV"] . ' - ' . $row_sv["MaPhong"] .'</option>';
                                }
                            } else {
                                echo '<option value="">Không có dữ liệu</option>';
                            }
                            ?>
                        </select>
                </div>
                
                <div class = "chucnang_hd">
                        <button class = "luu_hd" name="btnThem">
                            <i class="bi bi-floppy"></i> 
                            <div  id="btnThem"> Ghi dữ liệu </div>
                        </button>

                 
                        <button class = "link_quaylai">
                            <i class="bi bi-x-circle"></i>
                            <a href="ql_hopdong.php" id="quaylai">Hủy bỏ </a>
                        </button>
                  
                    
                </div>

            </div>
           
    </form>

      
    <?php
        if(isset($_POST['btnThem'])){
            $MaNV =  $_SESSION['manv'];
            $MaHD = $_POST['txtMaHD'];
            $NgayBD = $_POST['dtpNgayBD'];
            $NgayKT = $_POST['dtpNgayKT'];
            $MaSV = $_POST['txtMaSV'];
            if ($NgayBD > $NgayKT) {
                echo '<script>alert("Ngày bắt đầu không được lớn hơn ngày kết thúc")</script>';
            } else {
                $get_room = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE MaSV = '$MaSV' AND TrangThai = '1'");
                if($get_room)
                {
                    $row_get_room = mysqli_fetch_assoc($get_room);
                    $room = $row_get_room['MaPhong'];
                }
                    $check = mysqli_query($conn, "SELECT * FROM tbl_hopdong WHERE MaSV='$MaSV'");
                    if(mysqli_num_rows($check)> 0){
                            echo '<script>alert("Sinh viên này đã tồn tại")</script>';
                    }
                    else{
                        $query = "INSERT INTO tbl_hopdong (MaHD, MaPhong, NgayBD, NgayKT, MaSV, MaNV) 
                            VALUES ('".$MaHD."', '".$room."','".$NgayBD."','".$NgayKT."',
                                    '".$MaSV."','".$MaNV."')";
                        $result = mysqli_query($conn, $query);

                        if($result > 0){
                            echo '<script>
                                alert("Ghi thành công");
                                window.location.href = "ql_hopdong.php";
                            </script';
                        }else{
                            echo 'Ghi that bai';
                        }
                    }
                mysqli_close($conn);
            }
        }



    ?>


</body>
</html>
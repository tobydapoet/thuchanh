<?php
    include("../db/connect.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm thông báo</title>
    <link rel="stylesheet" href="thongbao.css?v=<?php echo time();?>">
    <script src="load.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="contain">
    <?php
        include ("../db/connect.php");

        if (!$conn) {
            echo "Kết nối không thành công, lỗi: " . mysqli_connect_error();
        } else {
            // Truy vấn dữ liệu từ bảng tbl_nhanvien
            $query_nv = "SELECT MaNV,TenNV FROM tbl_nhanvien";
            $result_nv = mysqli_query($conn, $query_nv);
        }
    ?>

    <div class="container-add">
        <h2 >THÊM THÔNG BÁO</h2>
        <form method="POST" onsubmit="return check()" class="form_them">
        
            <div class="form-group">
                <label for="txtMaTB">Mã thông báo:</label>
                <input type="text" id="txtMaTB" name="txtMaTB" required autocomplete="off"  placeholder="Nhập mã thông báo (VD:TB00)" pattern="^TB\d{2,3}$" title="Hãy nhập đúng định dạng mã thông báo">
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
            window.location.href = "thongbao.php";
        }
    </script>
    <?php
       if ($_SERVER['REQUEST_METHOD'] == "POST") {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $MaNV=$_SESSION['manv'] ;
        $MaTB=$_POST['txtMaTB'];
        $tieude = $_POST['txtTieude'];
        $noidung = $_POST['txtNoidung'];
        $ngaytao = date('Y-m-d');
            $check=mysqli_query($conn, "SELECT * FROM tbl_thongbao WHERE MaTB='$MaTB'");
            if(mysqli_num_rows($check)> 0){
                echo '<script>alert("Thông báo này đã tồn tại")</script>';
            }
            else{
                $query1 = "INSERT INTO tbl_thongbao (MaTB, TieuDe, NoiDung, Ngay_tao, MaNV) 
                VALUES ('$MaTB','$tieude', '$noidung', '$ngaytao', '$MaNV')";

                $result = mysqli_query($conn, $query1);

                if ($result) {
                    echo '<script>alert("Thêm thành công");
                    window.location.href = "thongbao.php"
                    </script>';
                } else {
                    echo 'Lỗi khi ghi vào cơ sở dữ liệu: ' . mysqli_error($conn);
                }
                mysqli_close($conn);
            }
        }
    ?>
</body>
</html>
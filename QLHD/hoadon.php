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
    <link rel="stylesheet" type="text/css" href=trangchu.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <script src="../QLKTX/load.js"></script>
    <title> Hóa Đơn </title>
</head>
<body >
    <form method="POST">
        <div class="Search">
            <select name="searchby" >
                <option value="MaHD">Mã hóa đơn</option>
                <option value="MaPhong">Mã phòng</option>
                <option value="MaNguoiLap">Mã người lập</option>
            </select>
            <input type="text" id="txtsearch" name="txtsearch" >
            <input type="submit" value="Tìm kiếm" id="search-click" name="search-click">
            <a href="hoadon-insert.php" id="dis"> Thêm </a>
        </div>
    </form>
    <?php
        if($_SESSION['ChucVu']==1)
        {   echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('dis').style.display = 'none';
            });
        </script>";
            $maphong = $_SESSION['phong'];
            if(isset($_POST["search-click"]) && !empty($_POST['txtsearch'])){        
                $getsearch = $_POST['txtsearch'];
                $searchby = $_POST['searchby'];
                if($searchby == 'MaHD'){
                    $view=mysqli_query($conn,"SELECT * FROM tbl_hoadon WHERE MaHD LIKE N'%$getsearch%' AND MaPhong = '$maphong'");
                }
                else if($searchby == 'MaPhong'){
                    $view=mysqli_query($conn,"SELECT * FROM tbl_hoadon WHERE MaPhong LIKE N'%$getsearch%' AND MaPhong = '$maphong'");
                }
                else if($searchby == 'MaNguoiLap'){
                    $view=mysqli_query($conn,"SELECT * FROM tbl_hoadon WHERE WHERE MaSV LIKE N'%$getsearch%' AND MaPhong = '$maphong'");
                }
            }
            else{
                $view = mysqli_query($conn,"SELECT * FROM tbl_hoadon WHERE MaPhong = '$maphong' ORDER BY STT ASC"); 
            }
            if (mysqli_num_rows($view) > 0) {

                echo '<table class = "table table table-hover">
                    <thead>
                        <tr>
                        <th>STT</th>
                        <th>Mã hóa đơn</th> 
                        <th>Giá điện</th>
                        <th>Gia nước</th>
                        <th>Giá phòng</th>
                        <th>Chi phí khác</th>
                        <th>Ngày lập</th>
                        <th>Mã phòng</th>
                        <th>Tổng</th>
                        <th>Mã người lập</th>
                        <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>';
                
                while ($row = mysqli_fetch_assoc($view)) {
                    $giaDienFormatted = number_format($row['GiaDien'], 0, ',', '.') . 'đ';
                    $giaNuocFormatted = number_format($row['GiaNuoc'], 0, ',', '.') . 'đ';
                    $giaPhongFormatted = number_format($row['GiaPhong'], 0, ',', '.') . 'đ';
                    $giaKhacFormatted = number_format($row['ChiPhiKhac'], 0, ',', '.') . 'đ';
                    $giaTongFormatted = number_format($row["GiaDien"]+ $row["GiaNuoc"]+$row["ChiPhiKhac"]+$row["GiaPhong"], 0, ',', '.') . 'đ';
                    echo '<tr>
                        <td>'.$row['STT'].'</td>
                        <td>' . $row["MaHD"] . '</td>
                        <td>' . $giaDienFormatted . '</td>
                        <td>' . $giaNuocFormatted . '</td>
                        <td>' . $giaPhongFormatted . '</td>
                        <td>' . $giaKhacFormatted . '</td>
                        <td>' . $row["NgayLapHD"] . '</td>
                        <td>' . $row["MaPhong"] . '</td>
                        <td>' .$giaTongFormatted . '</td>
                        <td>' . $row["MaNV"] . '</td>
                        <td class="function">
                            <a href="hoadon-edit.php?MaHD='.$row["MaHD"].'"> Xem </a>
                        </td>
                    </tr>';
                }
                
                echo '</tbody>
                    </table>';
            }
        }else {
            if(isset($_POST["search-click"]) && !empty($_POST['txtsearch'])){        
                $getsearch = $_POST['txtsearch'];
                $searchby = $_POST['searchby'];
                if($searchby == 'MaHD'){
                    $view=mysqli_query($conn,"SELECT * FROM tbl_hoadon WHERE MaHD LIKE N'%$getsearch%'");
                }
                else if($searchby == 'MaPhong'){
                    $view=mysqli_query($conn,"SELECT * FROM tbl_hoadon WHERE MaPhong LIKE N'%$getsearch%'");
                }
                else if($searchby == 'MaNguoiLap'){
                    $view=mysqli_query($conn,"SELECT * FROM tbl_hoadon WHERE MaNV LIKE N'%$getsearch%'");
                }
            }
            else{
                $view = mysqli_query($conn,"SELECT * FROM tbl_hoadon ORDER BY STT ASC"); 
            }
            if (mysqli_num_rows($view) > 0) {

                echo '<table class = "table table table-striped table-hover">
                    <thead>
                        <tr>
                        <th>STT</th>
                        <th>Mã hóa đơn</th> 
                        <th>Giá điện</th>
                        <th>Giá nước</th>
                        <th>Giá phòng</th>
                        <th>Chi phí khác</th>
                        <th>Ngày lập</th>
                        <th>Mã phòng</th>
                        <th>Tổng</th>
                        <th>Mã người lập</th>
                        <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>';
                
                while ($row = mysqli_fetch_assoc($view)) {
                    $tongdien = $row['GiaDien']*$row['SoDien'];
                    $tongnuoc = $row['GiaNuoc']*$row['SoNuoc'];
                    $tongDienFormatted = number_format($tongdien, 0, ',', '.') . 'đ';
                    $tongNuocFormatted = number_format($tongnuoc, 0, ',', '.') . 'đ';
                    $giaPhongFormatted = number_format($row['GiaPhong'], 0, ',', '.') . 'đ';
                    $giaKhacFormatted = number_format($row['ChiPhiKhac'], 0, ',', '.') . 'đ';
                    $giaTongFormatted = number_format($row['GiaDien']*$row['SoDien']+ $row['GiaNuoc']*$row['SoNuoc']+$row["ChiPhiKhac"]+$row["GiaPhong"], 0, ',', '.') . 'đ';
                    echo '<tr>
                        <td>'.$row['STT'].'</td>
                        <td>' . $row["MaHD"] . '</td>
                        <td>' . $tongDienFormatted . '</td>
                        <td>' . $tongNuocFormatted . '</td>
                        <td>' . $giaPhongFormatted . '</td>
                        <td>' . $giaKhacFormatted . '</td>
                        <td>' . $row["NgayLapHD"] . '</td>
                        <td>' . $row["MaPhong"] . '</td>
                        <td>' .$giaTongFormatted . '</td>
                        <td>' . $row["MaNV"] . '</td>
                        <td class="function">
                            <a href="hoadon-edit.php?MaHD='.$row["MaHD"].'"> Sửa </a>
                            <a onclick="return confirm(\'Bạn có muốn xóa hóa đơn này?\');" href="hoadon-delete.php?MaHD='.$row["MaHD"].'">Xóa</a>
                        </td>
                    </tr>';
                }
                
                echo '</tbody>
                    </table>';
            }
        }
    ?>
</body>
</html>

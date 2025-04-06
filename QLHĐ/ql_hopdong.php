
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý hợp đồng </title>
    <link rel="stylesheet" href="ql_hopdong.css?v=<?php echo time()?>">
    <link rel="stylesheet" type="text/css" href=trangchu.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <script src="load.js"></script>
</head>
<body>
    <div class="container_ex">
<!-- nut tim kiem -->
 <form action="" method="post">
    <div class="header">
            <input type="text" class="txtsearch" name = "txtsearch" placeholder="Nhập thông tin cần tìm">
            <input type="submit" class="search-btn" name = "search-btn"value="Tìm kiếm" >
            <!-- nút thêm hợp đồng  -->
            <a href="them_hopdong.php" class = "add_hopdong" id="add_hopdong"><i class="bi bi-person-fill-add"></i>Thêm HD</a>  
        </div>

 </form>
     



<!-- hiển thị dữ liệu từ mysql -->
        <?php
            include ("../db/connect.php");
                $query = "SELECT * FROM tbl_hopdong ORDER BY STT ASC" ;
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0){
                    echo'<table id = "tblMain" class = "table table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã hợp đồng</th>
                                    <th>Mã phòng</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Mã sinh viên</th>
                                    <th>Tên sinh viên</th>
                                    <th>Mã nhân viên</th>
                                    <th>Tên nhân viên</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>';
                        while ($row = mysqli_fetch_assoc($result)){
                            echo '<tr>
                                    <td>'.$row["STT"].'</td>
                                    <td>'.$row["MaHD"].'</td>
                                    <td>'.$row["MaPhong"].'</td>
                                    <td>'.$row["NgayBD"].'</td>
                                    <td>'.$row["NgayKT"].'</td>
                                    <td>'.$row["MaSV"].'</td>
                                    ';
                                    $masv= $row["MaSV"];
                                    $query_masv = "SELECT * FROM tbl_sinhvien WHERE MaSV = '$masv'  ";
                                    $result1 = mysqli_query($conn, $query_masv);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    $Tensv= $row1["TenSV"];
                                    echo "<td> $Tensv </td>";
                                    

                                    echo '<td>'.$row["MaSV"].'</td>';
                                    $manv= $row["MaNV"];
                                    $query_masv = "SELECT * FROM tbl_nhanvien WHERE MaNV = '$manv'  ";
                                    $result1 = mysqli_query($conn, $query_masv);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    $Tennv= $row1["TenNV"];
                                    echo "<td> $Tennv </td>";
                            echo '
                                 <td>
                                    
                                        <div class = "thao_tac">
                                            <a class = "Sua" href = "giahan_hopdong.php?MaHD='.$row["MaHD"].'">Gia hạn</a>
                                 
                                           <a onclick = "return confirm(\'Bạn có chắc chắn muốn xóa hợp đồng không?\');"
                                             href = "xoa_hopdong.php?MaHD='.$row["MaHD"].'" class = "Xoa">Xóa</a>
                                        
                                        </div>
                                           

                                   

                                </td>
                            </tr>';
                        }
                        echo '</tbody></table>';
                        
                } 
                else{
                        echo 'Khong co du lieu';
                    }

        ?>


<!-- Tìm kiếm hợp đồng  -->

<?php
         if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['search-btn'])){
            include ("../db/connect.php");
            $key = $_POST['txtsearch'];
                echo '<script>
                        var table = document.getElementById("tblMain");
                        table.style.display = "none";
                    </script>';
                $query = "SELECT hd.*, sv.TenSV, nv.TenNV 
                    FROM tbl_hopdong hd
                    LEFT JOIN tbl_SinhVien sv ON hd.MaSV = sv.MaSV
                    LEFT JOIN tbl_NhanVien nv ON hd.MaNV = nv.MaNV
                    WHERE hd.MaHD LIKE '%$key%' 
                    OR hd.MaSV LIKE '%$key%' 
                    OR hd.MaNV LIKE '%$key%'
                    OR sv.TenSV LIKE '%$key%'
                    OR nv.TenNV LIKE '%$key%'
                    OR hd.MaPhong LIKE '%$key%'
                ORDER BY hd.STT ASC";
              
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0){
                    echo'<table id = "tblMain" class = "table table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã hợp đồng</th>
                                    <th>Mã phòng</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Mã sinh viên</th>
                                    <th>Tên sinh viên</th>
                                    <th>Mã nhân viên</th>
                                    <th>Tên nhân viên</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>';
                        while ($row = mysqli_fetch_assoc($result)){
                            echo '<tr>
                                    <td>'.$row["STT"].'</td>
                                    <td>'.$row["MaHD"].'</td>
                                    <td>'.$row["MaPhong"].'</td>
                                    <td>'.$row["NgayBD"].'</td>
                                    <td>'.$row["NgayKT"].'</td>
                                    <td>'.$row["MaSV"].'</td>
                                    ';
                                    $masv= $row["MaSV"];
                                    $query_masv = "SELECT * FROM tbl_SinhVien WHERE MaSV = '$masv'  ";
                                    $result1 = mysqli_query($conn, $query_masv);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    $Tensv= $row1["TenSV"];
                                    echo "<td> $Tensv </td>";
                                    

                                    echo '<td>'.$row["MaSV"].'</td>';
                                    $manv= $row["MaNV"];
                                    $query_masv = "SELECT * FROM tbl_NhanVien WHERE MaNV = '$manv'  ";
                                    $result1 = mysqli_query($conn, $query_masv);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    $Tennv= $row1["TenNV"];
                                    echo "<td> $Tennv </td>";
                            echo '
                                 <td>
                                    
                                        <div class = "thao_tac">
                                            <a class = "Sua" href = "giahan_hopdong.php?MaHD='.$row["MaHD"].'">Gia hạn</a>
                                 
                                           <a onclick = "return confirm(\'Bạn có chắc chắn muốn xóa hợp đồng không?\');"
                                             href = "xoa_hopdong.php?MaHD='.$row["MaHD"].'" class = "Xoa">Xóa</a>
                                        
                                        </div>
                                           

                                   

                                </td>
                            </tr>';
                        }
                        echo '</tbody></table>';
                        
                } 
                else{
                        echo 'Khong co du lieu';
                    }
                }
        ?>
       
    </div>
</body>
</html>

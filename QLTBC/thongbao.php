<?php
    include("../db/connect.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo</title>
    <link rel="stylesheet" href="thongbao.css?v=<?php echo time()?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <script src="load.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
        <form method="POST" class="post">
            <div class="header">
                <div>
                    <select name="searchby" >
                        <option value="MaTB">Mã thông báo</option>
                        <option value="TieuDe">Tiêu đề</option>
                        <option value="MaNV">Mã nhân viên</option>
                    </select>
             </div>
                <input type="text" placeholder="Nhập từ khóa tìm kiếm" name ="txtsearch" class="txtsearch">
                <input type="submit" name ="search-btn" value="Tìm kiếm" class="search-btn">
                <a href="thongbao-insert.php" class ="add_thongbao"> <i class='bx bx-add-to-queue'></i>Thêm mới</a>

                
            
            </div>

        </form>
    <?php
         
         if(isset($_POST["search-btn"]) && !empty($_POST['txtsearch'])){        
             $getsearch = $_POST['txtsearch'];
            
             $searchby = $_POST['searchby'];
             if($searchby == 'TieuDe'){
                 $view=mysqli_query($conn,"SELECT * FROM tbl_thongbao WHERE TieuDe LIKE N'%".$getsearch."%'");
             }
             else if($searchby == 'MaTB'){
                 $view=mysqli_query($conn,"SELECT * FROM tbl_thongbao WHERE  MaTB LIKE N'%".$getsearch."%'");
             }
             else if($searchby == 'MaNV'){
                 $view=mysqli_query($conn,"SELECT * FROM tbl_thongbao WHERE MaNV LIKE N'%".$getsearch."%'");
             }
         }
         else{
         $view = mysqli_query($conn,"SELECT * FROM tbl_thongbao ORDER BY STT ASC"); 
         }
         if(mysqli_num_rows($view)>0)
         {
             echo '<table class="table table table-hover">
             <thead>
                 <th> STT </th>
                 <th> Mã Thông báo</th>
                 <th> Tiêu đề </th>
                 <th> Nội dung </th>
                 <th> Ngày tạo</th>
                 <th> Mã nhân viên </th>
                 <th> Tên nhân viên </th>
                 <th style="text-align: center;"> Chức Năng </th>
             </thead>
         <tbody>';
     while($row = mysqli_fetch_assoc($view)){
        echo '<tr>
                 <td>'.$row["STT"].'</td>
                 <td>'.$row["MaTB"].'</td>
                 <td class="text-ellipsis">'.$row["TieuDe"].'</td>
                 <td class="text-ellipsis">'.$row["NoiDung"].'</td>
                 <td>'.$row["Ngay_tao"].'</td>
                 <td>'.$row["MaNV"].'</td>';

                 $manv= $row["MaNV"];
                 $query_manv = "SELECT * FROM tbl_nhanvien WHERE MaNV = '$manv' ";
                 $result1 = mysqli_query($conn, $query_manv);
                 $row1 = mysqli_fetch_assoc($result1);
                 $Tennv= $row1["TenNV"];
                 echo "<td> $Tennv </td>";
                  
                echo'<td class="thaotac">
                    <a href = "thongbao-edit.php?MaTB='.$row["MaTB"].'" class="edit">Sửa</a>
                    <a onclick="return confirm(\'Bạn có muốn xóa không?\');" href = "thongbao-delete.php?MaTB='.$row["MaTB"].'" class="delete">Xóa</a>
                </td>
        </tr>';
        
    }
    
    echo '</body></table>';
}
else{
    echo 'Không có dữ liệu';
}
         
    
?>
    

</body>
</html>
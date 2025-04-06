<?php
    session_start();  
    require("../db/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="qlsv.css?v=<?php echo time()?>">
    <link rel="stylesheet" type="text/css" href="../TrangChu/trangchu.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <script src="load.js"></script>
</head>
<body style="background-color: #efefef;">
    <form method="post" class="container-ex">
        <div class="row-container">
                <button class="box" name="wait-approve">
                    <label>Tài khoản chờ duyệt</label>
                    <div>
                        <?php
                            $choduyet = '';
                            $reuslt = mysqli_query($conn,"SELECT COUNT(*) as so_sinh_vien FROM tbl_sinhvien WHERE TrangThai = 0;");
                            $row=mysqli_fetch_assoc($reuslt);
                            $choduyet=$row['so_sinh_vien'];
                            echo $choduyet;
                        ?>
                    </div>
                </button>
                <button class="box" name="approved">
                    <label>Số sinh viên hiện tại</label>
                    <div>
                        <?php
                            $daduyet = '';
                            $reuslt = mysqli_query($conn,"SELECT COUNT(*) as so_sinh_vien FROM tbl_sinhvien WHERE TrangThai = 1;");
                            $row=mysqli_fetch_assoc($reuslt);
                            $daduyet=$row['so_sinh_vien'];
                            echo $daduyet;
                        ?>
                    </div>
                </button>
                <button class="box" name="all">
                    <label>Tất cả tài khoản</label>
                    <div>
                        <?php
                            $all = '';
                            $reuslt = mysqli_query($conn,"SELECT COUNT(*) as so_sinh_vien FROM tbl_sinhvien");
                            $row=mysqli_fetch_assoc($reuslt);
                            $all=$row['so_sinh_vien'];
                            echo $all;
                        ?>
                    </div>
                </button>
                
        </div>
        <div id="all-account">
            <div class="heading">
                <div>
                    <input name="txtsearch" id='txtsearch' type="search" placeholder="Nhập thông tin sinh viên cần tìm">
                    <input name="search-click" type="submit" id="search-click" value="Tìm kiếm">
                </div>
                <a href = "ql_sinhvien-insert.php" class="add"><i class="bi bi-plus-lg"></i> Thêm sinh viên</a>
            </div>
            <table class = "table table table-hover">
                <?php 
                if(isset($_POST['wait-approve']))
                {
                    $view = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE TrangThai = 0 ORDER BY STT ASC"); 
                }
                else if(isset($_POST['approved']))
                {
                    $view = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE TrangThai = 1 ORDER BY STT ASC"); 
                }
                else if(isset($_POST['search-click']))
                {
                    $search = $_POST['txtsearch'];
                    $view = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE MaSV LIKE N'%$search%' OR TenSV LIKE N'%$search%'");
                }
                else
                {
                    $view = mysqli_query($conn,"SELECT * FROM tbl_sinhvien ORDER BY STT ASC"); 
                }
                    if(mysqli_num_rows($view)>0)
                    {
                        echo "<thead>
                            <th  style='width:10px;color: #f57234' class='id'>STT</th>
                            <th style='color: #f57234;' class='name'>Ảnh</th>
                            <th style='color: #f57234;'>Mã nhân viên</th>
                            <th style='color: #f57234;'>Họ và tên</th>
                            <th style='color: #f57234;'>Số điện thoại</th>
                            <th style='color: #f57234;'>Mã phòng</th>
                            <th style='color: #f57234;'>Trạng thái</th>
                            <th style='width: 120px;color: #f57234'>Chức năng</th>           
                        </thead>";
                    }
                    else{
                        echo "<div>Không có kết quả cần tìm</div>";
                    }
                    while($row = mysqli_fetch_assoc($view))
                    {
                        $imagePath = '../image/'.$row['Image'];
                        if (file_exists($imagePath) && !empty($row['Image'])) {
                           $imagePath = $row['Image'];
                        } else {
                            $imagePath = 'images.png';
                        }
                        echo "
                        <tbody>
                            <tr>
                                <td class='id'>".$row['STT']."</td>
                                <td><img src='../image/".$imagePath."' style='width: 40px;height: 40px;object-fit:contain'></td>
                                <td >".$row['MaSV']."</td>
                                <td>".$row['TenSV']."</td>
                                <td>".$row['Phone']."</td>
                                <td>".$row['MaPhong']."</td>
                                <td ><div id='status_".$row['STT']."'>";
                                  if ($row['TrangThai'] == 0) {
                                        echo "chưa được duyệt";
                                        echo "<script>document.getElementById('status_".$row['STT']."').style.backgroundColor = '#f73f3f' ;</script>";
                                    } else if ($row['TrangThai'] == 1) {
                                        echo "đã được duyệt";
                                        echo "<script>document.getElementById('status_".$row['STT']."').style.backgroundColor = 'rgb(6, 204, 6)' ;</script>";
                                    }
                        echo "</div>
                                <td>";
                            if ($row["TrangThai"] == 0) {
                                echo "<a href='ql_sinhvien-view.php?MaSV=".$row['MaSV']."'><i class='bi bi-person-lines-fill'></i></a>";
                            } else {
                                echo "<a href='ql_sinhvien-edit.php?MaSV=".$row['MaSV']."'><i class='bi bi-pencil-square'></i></a>";
                            }
                            echo "<a onclick='return confirm(\"Bạn có muốn xóa không ?\")' href='ql_sinhvien-delete.php?userSV=".$row['Username']."''><i class='bi bi-trash'></i></a>
                                </td>
                            </tr>
                        </tbody>";
                    }
                ?>
            </table>    
        </div>
    </form>
</body>
</html>
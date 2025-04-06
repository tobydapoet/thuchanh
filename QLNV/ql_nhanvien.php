<?php
    session_start();  
    require("../db/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="ql_nv.css?v=<?php echo time()?>">
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
                            $reuslt = mysqli_query($conn,"SELECT COUNT(*) as so_nhan_vien FROM tbl_nhanvien WHERE TrangThai = 0;");
                            $row=mysqli_fetch_assoc($reuslt);
                            $choduyet=$row['so_nhan_vien'];
                            echo $choduyet;
                        ?>
                    </div>
                </button>
                <button class="box" name="approved">
                    <label>Số nhân viên hiện tại</label>
                    <div>
                        <?php
                            $daduyet = '';
                            $reuslt = mysqli_query($conn,"SELECT COUNT(*) as so_nhan_vien FROM tbl_nhanvien WHERE TrangThai = 1;");
                            $row=mysqli_fetch_assoc($reuslt);
                            $daduyet=$row['so_nhan_vien'];
                            echo $daduyet;
                        ?>
                    </div>
                </button>
                <button class="box" name="all">
                    <label>Tất cả tài khoản</label>
                    <div>
                        <?php
                            $all = '';
                            $reuslt = mysqli_query($conn,"SELECT COUNT(*) as so_nhan_vien FROM tbl_nhanvien");
                            $row=mysqli_fetch_assoc($reuslt);
                            $all=$row['so_nhan_vien'];
                            echo $all;
                        ?>
                    </div>
                </button>
                
        </div>
        <div id="all-account">
            <div class="heading">
                <div>
                    <input name="txtsearch" id='txtsearch' type="search"  placeholder="Nhập thông tin nhân viên cần tìm">
                    <input name="search-click" type="submit" id="search-click" value="Tìm kiếm">
                </div>
                <a href = "ql_nhanvien-insert.php" class="add"><i class="bi bi-plus-lg"></i> Thêm nhân viên</a>
            </div>
            <table class = "table table table-hover">
                <?php 
                if(isset($_POST['wait-approve']))
                {
                    $view = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE TrangThai = 0 ORDER BY STT ASC"); 
                }
                else if(isset($_POST['approved']))
                {
                    $view = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE TrangThai = 1 ORDER BY STT ASC"); 
                }
                else if(isset($_POST['search-click']))
                {
                    $search = $_POST['txtsearch'];
                    $view = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE MaNV LIKE N'%$search%' OR TenNV LIKE N'%$search%'");
                }
                else
                {
                    $view = mysqli_query($conn,"SELECT * FROM tbl_nhanvien ORDER BY STT ASC"); 
                }
                    if(mysqli_num_rows($view)>0)
                    {
                        echo "<thead>
                            <th  style='width:10px;color: #f57234' class='id'>STT</th>
                            <th style='color: #f57234;' class='name'>Ảnh</th>
                            <th style='color: #f57234;'>Mã nhân viên</th>
                            <th style='color: #f57234;'>Họ và tên</th>
                            <th style='color: #f57234;'>Số điện thoại</th>
                            <th style='color: #f57234;'>Trạng thái</th>
                            <th style='width: 100px;color: #f57234'>Chức năng</th>           
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
                           $get_user = $row['Username'];
                           $admin = mysqli_query($conn,"SELECT * FROM tbl_account WHERE username = '$get_user'");
                           {
                                if($admin)
                                {
                                    $row_admin = mysqli_fetch_assoc($admin);
                                    $chucvu = $row_admin["ChucVu"];
                                }
                                if($chucvu==2)
                                {
                                    echo "<script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            document.getElementById('delete-btn').style.display = 'none';
                                        });
                                    </script>";
                                }
                           }
                        } else {
                            $imagePath = 'images.png';
                        }
                        echo "
                        <tbody>
                            <tr>
                                <td class='id'>".$row['STT']."</td>
                                <td><img src='../image/".$imagePath."' style='width: 40px;height: 40px;object-fit:contain'></td>
                                <td >".$row['MaNV']."</td>
                                <td>".$row['TenNV']."</td>
                                <td>".$row['Phone']."</td>
                                <td ><div id='status_".$row['STT']."'>";
                                  if ($row['TrangThai'] == 0) {
                                        echo "chưa được duyệt";
                                        echo "<script>document.getElementById('status_".$row['STT']."').style.backgroundColor = '#f73f3f' ;</script>";
                                    } else if ($row['TrangThai'] == 1) {
                                        echo "đã được duyệt";
                                        echo "<script>document.getElementById('status_".$row['STT']."').style.backgroundColor = 'rgb(6, 204, 6)' ;</script>";
                                    }
                        echo " </div>
                                <td>
                                   <a href = 'ql_nhanvien-edit.php?MaNV=".$row['MaNV']."'><i class='bi bi-pencil-square'></i></a>
                                    <a id = 'delete-btn' onclick='return confirm(\"Bạn có muốn xóa không ?\")' href='ql_nhanvien-delete.php?userNV=".$row['Username']."'><i class='bi bi-trash'></i></a></a>
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
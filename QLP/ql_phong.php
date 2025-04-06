<?php
    session_start();
    require("../db/connect.php");
?>


<!--Them phong-->
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_themP'])) {
        $MaPhong = $_POST['txtMaP'];
        $TenPhong = $_POST['txtTenP'];
        $LoaiPhong = $_POST['rdoLoaiP'];
        $GiaPhong = $_POST['txtGiaP'];
        $MoTa = $_POST['txtMoTa'];
        $SoLuong = $_POST['txtSoLuong'];
        $check = mysqli_query($conn,"SELECT * FROM tbl_phong WHERE MaPhong='$MaPhong'");
        {
            if(mysqli_num_rows($check)> 0){
                echo '<script>alert("Phòng này đã tồn tại")</script>';
            }
            else{
                $query = "INSERT INTO tbl_phong (MaPhong, TenPhong, LoaiPhong, GiaPhong, MoTa, SoLuong) VALUES ('$MaPhong', '$TenPhong', '$LoaiPhong', '$GiaPhong', '$MoTa', '$SoLuong')";

                if (mysqli_query($conn, $query)) {
                    echo "<script>
                        alert('Thêm phòng thành công!');
                        window.location.href='ql_phong.php';
                    </script>";
                } else {
                    echo "<script>
                        alert('Lỗi khi thêm phòng!');
                    </script>";
                }
            }
        }

}
?>

<!--Tim kiem phong-->

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_searchP'])) {
            $key = $_POST['search_phong'];
            if($key == ""){
                echo 'Vui lòng nhập thông tin cần tìm';
            }
            else{
                $query = "SELECT * FROM tbl_phong WHERE MaPhong LIKE '%" . $key . "%'";
                $result = mysqli_query($conn, $query);
                echo '<div class="search_results">';
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="ql_phong">
                                <a href="#" onclick="loadRoomInfo(\'' . $row['MaPhong'] . '\')">';
                        if ($row['LoaiPhong'] == 0) {
                            echo '<div class="img_trangchu"><i class="bi bi-person-standing" id="icon_phongNam" ></i></div>';
                        } else {
                            echo '<div class="img_trangchu"><i class="bi bi-person-standing-dress" id="icon_phongNu" ></i></div>';
                        }
                        echo '<div class="title_sophong">' . $row['MaPhong'] . '</div>
                            </a>
                            </div>';

                    }
                } else {
                    echo '<div class="no_results">Không tìm thấy phòng phù hợp.</div>';
                }
                echo '</div>';
            }
           
        }
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phòng </title>
    <link rel="stylesheet" href="ql_phong.css?v=<?php echo time()?>">
    <link rel="stylesheet" type="text/css" href="../TrangChu/trangchu.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <script src="load.js"></script>
</head>
<body>
    <div class="container_phong">
        <div class="style_phong">
            <div class="menu_phong">
                <div class="container_trai">
                    <form class="menu_list" method="post">
                        <div class ="them_phong">
                            
                                <div class="title_phong">SƠ ĐỒ PHÒNG</div>
                                <?php
                                if($_SESSION['ChucVu']=="0" || $_SESSION['ChucVu']=="2")
                                {
                                    echo'<button type="button" class = "add_phong" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                                        <i class="bi bi-house-add-fill" id="icon_themphong"></i>
                                    </button>';
                                }
                                else 
                                {
                                    echo '<i class="bi bi-house-fill"></i>';

                                }
                                ?>
                        </div>

                        <div class="list">
                        <?php
                            $result = mysqli_query($conn,"SELECT * FROM tbl_phong");
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo '<div class="ql_phong">
                                        <a href="#" onclick="loadRoomInfo(\'' .$row['MaPhong'] . '\')">';
                                if($row['LoaiPhong']==0){
                                    echo '<div class="img_trangchu"><i class="bi bi-person-standing" id="icon_phongNam" ></i></div>';
                                }
                                else
                                {
                                    echo '<div class="img_trangchu"><i class="bi bi-person-standing-dress" id="icon_phongNu" ></i></div>';     
                                }   
                                echo '<div class="title_sophong">' . $row['MaPhong'] . '</div>
                                        </a>
                                    </div>';
                            }
                        ?>
                        </div>
                    </form>
                </div>
            </div>

            <div class="danh_sach">
                <div class="timkiem_phong">
                    <form action="" method="post" class="header">
                        <div>
                            <input type="text" class="search_phong" name="search_phong" placeholder="Nhập thông tin cần tìm">
                            <input type="submit" class="btn_searchP" name="btn_searchP" value="Tìm kiếm">
                            <button name = "reload" class = "re_load">
                                <i class="bi bi-arrow-clockwise" id = "load"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="content_area">
                    <iframe id="contentFrame" src="thongtin_phong.php" frameborder="0" width="100%" height="100%"></iframe>
                </div>
            </div>
        </div>
    </div>

   

    <!-- Modal Thêm Phòng -->

    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoomModalLabel">Thêm phòng mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="ql_phong.php" class = "form_themP">
                        <div class="hienthi_thongtin">
                            <label for="txtMaP" class="label_phong">Mã phòng</label>
                            <input type="text" name="txtMaP" id="txtMaP" class="form-control" placeholder="Nhập mã phòng (VD:P000)" pattern="^P\d{3}$" title="Hãy nhập đúng định dạng mã phòng">
                        </div>

                        <div class="hienthi_thongtin">
                            <label for="txtTenP" class="label_phong">Tên phòng</label>
                            <input type="text" name="txtTenP" id="txtTenP" class="form-control" >
                        </div>

                        <div class="hienthi_thongtin">
                            <label for="txtLoaiP" class="label_phong">Loại phòng</label>
                            <div class="form-check">
                                <input type="radio" name="rdoLoaiP" id="rdoNam" class="form-check-input" value="0" required>
                                <label for="rdoNam" class="form-check-label">Phòng nam</label>
                                <br>
                                <input type="radio" name="rdoLoaiP" id="rdoNu" class="form-check-input" value="1" required>
                                <label for="rdoNu" class="form-check-label">Phòng nữ</label>
                        </div>
                    </div>

                                      

                        <div class="hienthi_thongtin">
                            <label for="txtGiaP" class="label_phong">Giá phòng</label>
                            <input type="number" name="txtGiaP" id="txtGiaP" class="form-control" autocomplete="off">
                        </div>

                        <div class="hienthi_thongtin">
                            <label for="txtMoTa" class="label_phong">Mô tả</label>
                            <input type="text" name="txtMoTa" id="txtMoTa" class="form-control" autocomplete="off">
                        </div>

                        <div class="hienthi_thongtin">
                            <label for="txtSoLuong" class="label_phong">Số lượng giường</label>
                            <input type="number" name="txtSoLuong" id="txtSoLuong" class="form-control" autocomplete="off">
                        </div>

                        <div class = "save_themPhong">
                            <button type="submit" class="save_themP" name="btn_themP">
                                 <i class="bi bi-floppy"></i>
                                 Lưu
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <script>
        function loadRoomInfo(IDPhong) {
            document.getElementById('contentFrame').src = 'thongtin_phong.php?Phong=' + IDPhong;
        }
    </script>
</body>
</html>

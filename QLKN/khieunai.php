<?php
    include("../db/connect.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khiếu nại</title>
    <link rel="stylesheet" href=khieunai.css?v=<?php echo time() ?>">
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
                    <select name="searchby">
                        <option value="MaVD">Mã vấn đề</option>
                        <option value="MaNV">Mã nhân viên</option>
                        <option value="MaSV" id='dis'>Mã sinh viên</option>
                    </select>
                </div>
                <input type="text" name="txtsearch" class="txtsearch" placeholder="Nhập từ khóa tìm kiếm">
                <input type="submit" class="search-btn" value="Tìm kiếm" name="search-btn">

                <a href="khieunai-insert.php" class="add_khieunai" id="add_khieunai"> <i class='bx bx-add-to-queue'></i> Thêm mới</a>
            </div>

            <?php
                if( $_SESSION['ChucVu']== 1){
                    if (isset($_POST["search-btn"]) && !empty($_POST['txtsearch'])) {
                        $getsearch = $_POST['txtsearch'];
                        $searchby = $_POST['searchby'];
                        if ($searchby == 'MaVD') {
                            $view = mysqli_query($conn, "SELECT * FROM tbl_vande WHERE MaVD LIKE N'%$getsearch%'");
                        }
                        else if ($searchby == 'MaNV') {
                            $view = mysqli_query($conn, "SELECT * FROM tbl_vande WHERE MaNV LIKE N'%$getsearch%'");
                        }
                        else if ($searchby == 'MaSV') {
                            $view = mysqli_query($conn, "SELECT * FROM tbl_vande WHERE  MaSV LIKE N'%$getsearch%'");
                        }
                    } else {
                        $view = mysqli_query($conn, "SELECT * FROM tbl_vande ORDER BY STT ASC");
                    }
                    if (mysqli_num_rows($view) > 0) {
                        echo '<table id= "tblmain" class="table table table-striped table-hover" >
                <thead style="font-size:15px;font-weight:bold" >
                    <th> STT </th>
                    <th> Mã vấn đề</th>
                    <th> Tiêu đề </th>
                    <th> Nội dung </th>
                    <th> Ngày tạo</th>
                    <th> Mã sinh viên </th>
                    <th> Mã nhân viên</th>
                   <th style="text-align: center;"> Chức Năng </th>
                </thead>
            <tbody>';
                        while ($row = mysqli_fetch_assoc($view)) {
                        echo '<tr style="font-size:15px">
                        <td>' . $row["STT"] . '</td>
                        <td>' . $row["MaVD"] . '</td>
                        <td class="text-ellipsis">' . $row["TieuDe"] . '</td>
                        <td class="text-ellipsis">' . $row["NoiDung"] . '</td>
                        <td>' . $row["Ngay_tao"] . '</td>
                        <td>' . $row["MaSV"] . '</td>
                        <td>' . $row["MaNV"] . '</td>
                        <td class="thaotac">
                            <a href = "khieunai-edit.php ?MaVD=' . $row["MaVD"] . '" class="edit">Xem</a>
                    </td>
            </tr>';
                        }
                        echo '</body></table>';
                    }   
                }
                if ($_SESSION['ChucVu']== 0 || $_SESSION['ChucVu']== 2){
                    echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('add_khieunai').style.display = 'none';
                    });
                </script>";
                    if (isset($_POST["search-btn"]) && !empty($_POST['txtsearch'])) {
                        $getsearch = $_POST['txtsearch'];
                        $searchby = $_POST['searchby'];
                        if ($searchby == 'MaVD') {
                            $view = mysqli_query($conn, "SELECT * FROM tbl_vande WHERE MaVD LIKE N'%$getsearch%'");
                        }
                        else if ($searchby == 'MaNV') {
                            $view = mysqli_query($conn, "SELECT * FROM tbl_vande WHERE MaNV LIKE N'%$getsearch%'");
                        }
                        else if ($searchby == 'MaSV') {
                            $view = mysqli_query($conn, "SELECT * FROM tbl_vande WHERE  MaSV LIKE N'%$getsearch%'");
                        }
                    } else {
                        $view = mysqli_query($conn, "SELECT * FROM tbl_vande ORDER BY STT ASC");
                    }
                    if (mysqli_num_rows($view) > 0) {
                        echo '<table id= "tblmain" class="table table table-striped table-hover" >
                <thead style="font-size:15px;font-weight:bold" >
                    <th> STT </th>
                    <th> Mã vấn đề</th>
                    <th> Tiêu đề </th>
                    <th> Nội dung </th>
                    <th> Ngày tạo</th>
                    <th> Mã sinh viên </th>
                    <th>Mã nhân viên</th>
                    <th> Chức Năng </th>
                </thead>
            <tbody>';
                        while ($row = mysqli_fetch_assoc($view)) {
                        echo '<tr style="font-size:15px">
                        <td>' . $row["STT"] . '</td>
                        <td>' . $row["MaVD"] . '</td>
                        <td class="text-ellipsis">' . $row["TieuDe"] . '</td>
                        <td class="text-ellipsis">' . $row["NoiDung"] . '</td>
                        <td>' . $row["Ngay_tao"] . '</td>
                        <td>' . $row["MaSV"] . '</td>
                        <td>' . $row["MaNV"] . '</td>
                        <td class="thaotac">
                            <a href = "khieunai-edit.php?MaVD=' . $row["MaVD"] . '" class="edit">Sửa</a>
                        <a onclick="return confirm(\'Bạn có muốn xóa không?\');" href = "khieunai-delete.php?MaVD=' . $row["MaVD"] . '" class="delete">Xóa</a>
                    </td>
            </tr>';
                        }
                        echo '</body></table>';
                    }
                }
            ?>
        </form>
</body>

</html>
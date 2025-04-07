<?php
    require("../db/connect.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <script src="load.js"></script>
    <link rel="stylesheet" type="text/css" href=ql_nhanvien_sinhvien-function.css?v=<?php echo time(); ?>">
</head>
<body>
    <form enctype="multipart/form-data" method="post">
        <?php
            if(isset($_POST['btn-cancel']))
            {
                $masinhvien = $_GET['MaSV'];
                $maphong=$_POST['room'];
                $result1 = mysqli_query($conn,"UPDATE tbl_sinhvien SET TrangThai = '0'  WHERE MaSV='$masinhvien'");
                if($result1)
                {
                    $result2 = mysqli_query($conn,"UPDATE tbl_phong SET SoSV = SoSV - 1 WHERE MaPhong = '$maphong'");
                    if($result2){
                        echo '<script>alert("Vô hiệu hóa thành công");
                        window.location.href = "ql_sinhvien.php"
                        </script>';
                    }

                }
                else
                {
                    echo '<script>alert("Lỗi khi vô hiệu hóa");
                    window.location.href = "ql_sinhvien.php"
                    </script>';
                } 
            }
            else if(isset($_POST['btn-edit'])){
                $masinhvien = $_GET['MaSV'];
                $tensinhvien=$_POST['name'];
                $gioitinh=$_POST['sex'];
                $sdt=$_POST['phone'];
                $cccd=$_POST['cccd'];
                $diachi=$_POST['address'];
                $maphong=$_POST['room'];
                $lop = $_POST['class'];
                $password = $_POST['password'];

                $current_image_query = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE MaSV = '$masinhvien'");
                $current_image_row = mysqli_fetch_assoc($current_image_query);
                $current_image  = $current_image_row['Image'];
                $current_imagecccdfront  = $current_image_row['ImageCCCDFront'];
                $current_imagecccdback  = $current_image_row['ImageCCCDBack'];
                $username = $current_image_row["Username"];

                $filename1 = $_FILES['imgcccdfront']['name'];
                $tmpname1 = $_FILES['imgcccdfront']['tmp_name'];
                $imagePath1 = '../image/' . $filename1;
                move_uploaded_file($tmpname1, $imagePath1);
                if($filename1)
                {
                    move_uploaded_file($tmpname1, $imagePath1);
                    $image_save1 = $filename1;
                }
                else{
                    $image_save1 = $current_imagecccdfront;
                }
                
                $filename2 = $_FILES['imgcccdback']['name'];
                $tmpname2 = $_FILES['imgcccdback']['tmp_name'];
                $imagePath2 = '../image/' . $filename2;
                move_uploaded_file($tmpname2, $imagePath2);
                if($filename2)
                {
                    move_uploaded_file($tmpname2, $imagePath2);
                    $image_save2 = $filename2;
                }
                else{
                    $image_save2 = $current_imagecccdback;
                }

                $filename3 = $_FILES['img']['name'];
                $tmpname3= $_FILES['img']['tmp_name'];
                $imagePath3 = '../image/' . $filename3;
                move_uploaded_file($tmpname3,$imagePath3);
                if($filename3)
                {
                    move_uploaded_file($tmpname3, $imagePath3);
                    $image_save3 = $filename3;
                }
                else{
                    $image_save3 = $current_image;
                }
                    $currentStudentQuery = mysqli_query($conn, "SELECT * FROM tbl_sinhvien WHERE Username = '$username'");
                    $currentStudent = mysqli_fetch_assoc($currentStudentQuery);
                    $currentMaPhong = $currentStudent['MaPhong'];
                    $view_check_room = mysqli_query($conn,"SELECT * FROM tbl_phong WHERE MaPhong = '$maphong'");
                    $row_check_room = mysqli_fetch_assoc($view_check_room);
                    $view_check_phone = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE Phone= '$sdt'");
                    $view_check_cccd = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE CCCD= '$cccd'");
                    if(mysqli_num_rows($view_check_phone)>1)
                    {
                        echo '<script>alert("Số điện thoại đã được sử dụng")
                        window.location.href = "ql_sinhvien-edit.php?MaSV='.$masinhvien.'"</script>';
                    }
                    else if(mysqli_num_rows($view_check_cccd)>1)
                    {
                        echo '<script>alert("Số CCCD đã được sử dụng")
                        window.location.href = "ql_sinhvien-edit.php?MaSV='.$masinhvien.'"</script>';
                    }
                    else if($row_check_room['LoaiPhong']!= $gioitinh)
                    {
                        echo '<script>alert("Giới tính không trùng với loại phòng")
                        window.location.href = "ql_sinhvien-edit.php?MaSV='.$masinhvien.'"</script>';
                    }
                    else if ($currentMaPhong != $maphong && $row_check_room['SoSV'] >= $row_check_room['SoLuong']) 
                    {
                        echo '<script>alert("Phòng đã đầy"); 
                        window.location.href ="ql_sinhvien-edit.php?MaSV='.$masinhvien.'";</script>';
                    }

                    else
                    {
                        $result1 = mysqli_query($conn,"UPDATE tbl_sinhvien SET TenSV='$tensinhvien',GioiTinh='$gioitinh',Phone='$sdt',CCCD='$cccd',Image='$image_save3',DiaChi='$diachi',ImageCCCDFront='$image_save1',ImageCCCDBack='$image_save2',MaPhong='$maphong',Class='$lop' WHERE Username='$username'");
                        $result2 = mysqli_query($conn,"UPDATE tbl_account SET password = '$password' WHERE username = '$username'");
                        if($result1 && $result2)
                        {
                            mysqli_query($conn, "UPDATE tbl_phong SET SoSV = SoSV - 1 WHERE MaPhong = '$currentMaPhong'");
                            mysqli_query($conn, "UPDATE tbl_phong SET SoSV = SoSV + 1 WHERE MaPhong = '$maphong'");
                    
                            echo '<script>alert("Sửa thành công"); window.location.href = "ql_sinhvien-edit.php?MaSV='.$masinhvien.'";</script>';
                        } else {
                            echo '<script>alert("Cập nhật thất bại"); window.location.href = "ql_sinhvien-edit.php?MaNV='.$masinhvien.'";</script>';
                        }   
                    }            
            }
            else{
                $masinhvien = $_GET['MaSV'];
                $res_tag = $res_name = $res_phone = $res_cccd= $res_sex = $res_img = $res_address = "";
                $res_img  = "images.png";
                $res_imgcccdback=$res_imgcccdfront = "images2.jpg";
                $result = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE MaSV = '$masinhvien'");
                if($result && mysqli_num_rows($result) > 0)
                {
                    $row = mysqli_fetch_assoc($result);
                    $res_username = $row['Username'];
                    $res_tag = $row['MaSV'];
                    $res_name = $row['TenSV'];
                    $res_sex = $row['GioiTinh'];
                    $res_phone = $row['Phone'];
                    $res_cccd = $row['CCCD'];
                    $res_imgcccdfront = !empty($row['ImageCCCDFront']) ? $row['ImageCCCDFront'] : 'images2.jpg';
                    $res_imgcccdback = !empty($row['ImageCCCDBack']) ? $row['ImageCCCDBack'] : 'images2.jpg';
                    $res_address = $row['DiaChi'];
                    $res_img = !empty($row['Image']) ? $row['Image'] : 'images.png';   
                    $res_class= $row['Class'];
                    $res_room = $row['MaPhong'];
                    $account = mysqli_query($conn,"SELECT * FROM tbl_account WHERE username = '$res_username'");
                    $row_account = mysqli_fetch_assoc($account);
                    $res_password = $row_account['password'];
                }
            }
        
        ?>
        <div class="heading">
            <a href="ql_sinhvien.php" id="goback"><i class="bi bi-arrow-left"></i></a>
            <div><img class ="avatar" src="../image/<?php echo $res_img ?>"> 
            <input type="file" name="img" id="img" accept=".jpg, .jpeg, .png" autocomplete="off">      
            </div>
        </div>
        <div class="container">
            <div class="row">
            <div class="row">
                <div class="title-info">Tài khoản, mật khẩu</div>
                    <div class="col">
                        <div class="box">
                            <label>Tài khoản</label>
                            <input type="text" name="username" value='<?php echo $res_username ?>' id="phone" autocomplete="off" required placeholder="Nhập tài khoản"> 
                        </div>
                    </div>
                    <div class="col">
                        <div class="box">
                            <label>Mật khẩu</label>
                            <input type="password" name="password" value='<?php echo $res_password ?>' autocomplete="off" required placeholder="Nhập mật khẩu" pattern=".{8,16}" placeholder="Tài khoản (8-16 ký tự)">
                        </div>
                    </div>
                </div>
                <div class="title-info">Thông tin cá nhân</div>
                    <div class="col">
                        <div class="box">
                            <label>Họ và tên</label>
                            <input type="text" name="name" value='<?php echo $res_name ?>' id="name" autocomplete="off" required placeholder="Nhập họ tên">
                        </div>        
                    </div>
                    <div class="col">
                        <div class="box">
                            <label>Mã người dùng</label>
                            <input type="text" name="tag" value='<?php echo $res_tag ?>' id="tag" autocomplete="off" disabled  placeholder="Nhập mã sinh viên (VD:73DCTT00000)" pattern="\d{2}[A-Z]{4}\d{5}" title="Hãy nhập đúng định dạng mã sinh viên" >
                        </div>
                    </div>
                    <div class="col">
                        <div class="box">
                            <label>Giới tính</label>
                            <select name="sex"  id="sex">
                                <option value='0' <?php if($res_sex=="0") echo  "selected"?>>Nam</option>
                                <option value='1' <?php if($res_sex=="1") echo  "selected"?>>Nữ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="box">
                            <label>Số điện thoại</label>
                            <input type="text" name="phone" id="phone" value='<?php echo $res_phone ?>' autocomplete="off" required placeholder="Nhập số điện thoại cá nhân" pattern="0[0-9]{9}" title="Sai định dạng"> 
                        </div>
                    </div>
                    <div class="col">
                        <div class="box">
                            <label>Số CCCD</label>
                            <input type="text" name="cccd" id="cccd" value='<?php echo $res_cccd ?>' autocomplete="off" required placeholder="Nhập số CCCD" pattern="[0-9]{12}" title="Sai định dạng">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="box">
                            <label>Địa chỉ thường trú</label>
                            <input type="text" name="address" id="address" value='<?php echo $res_address ?>' autocomplete="off" required  placeholder="Nhập địa chỉ">
                        </div>
                    </div>
                </div>
                <div class="row" id="image-box">
                    <div class="title-info">Ảnh 4x6, Ảnh CCCD/CMND</div>
                    <div class="col">
                        <div class="box">
                            <label>Ảnh cccd mặt trước</label>
                            <input type="file" name="imgcccdfront" id="imgcccdfront" accept=".jpg, .jpeg, .png" autocomplete="off">
                            <img class ="cccdfront" src="../image/<?php echo $res_imgcccdfront ?>">
                        </div>
                    </div>
                    <div class="col">
                        <div class="box">
                            <label>Ảnh căn cước công dân mặt sau</label>
                            <input type="file" name="imgcccdback" id="imgcccdback" accept=".jpg, .jpeg, .png" autocomplete="off">
                            <img class ="cccdback" src="../image/<?php echo $res_imgcccdback ?>">
                        </div>
                    </div>
                </div>
                <div class="row" id ="for-student">
                        <div class="title-info">Phòng, Lớp</div>
                        <div class="col">
                            <div class="box">
                                <label>Phòng</label>
                                <select name="room" >
                                <?php
                                    $result=mysqli_query($conn,"SELECT * FROM tbl_phong");
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result) ) {
                                                    $selected = ($row["MaPhong"] == $res_room) ? "selected" : "";
                                                    $RoomType = ($row["LoaiPhong"] == 0) ? "Phòng nam" : "Phòng nữ";
                                                    echo '<option value="' . $row["MaPhong"] . '"'.$selected.'>'.$row["TenPhong"].' - '.$RoomType.' - '.$row["SoSV"].'/'.$row["SoLuong"].'</option>';
                                                
                                            }
                                         }
                                    
                                    else{
                                        echo '<option>Không còn phòng trống</option>';
                                    }
                                ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="col">
                            <div class="box">
                                <label>Lớp</label>
                                <input type="text" name="class"  value='<?php echo $res_class ?>' autocomplete="off" placeholder="Nhập lớp"> 
                            </div>
                        </div>
                    </div>
                    <div class="btn-div">
                        <div class="btn-edit-div"><input type="submit" name="btn-edit" class="btn-function" value="Sửa"></div>
                        <div class="btn-cancel-div"><input type="submit" name="btn-cancel" class="btn-function" value="Vô hiệu"></div>
                    </div>
        </div>
    </form>
</body>
</html>
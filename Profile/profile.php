<?php
    require("../db/connect.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="profile.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="container">
        <?php
            require('../db/connect.php');
            if($_SESSION['ChucVu']=="0" ||$_SESSION['ChucVu']=="2")
            {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('for-student').style.display = 'none';
                    });
                </script>";
                if(isset($_POST['btn-add']))
                {
                    $username = $_SESSION['username'];
                    $password=$_POST['password'];
                    $manhanvien = $_POST['tag'];
                    $tennhanvien=$_POST['name'];
                    $gioitinh=$_POST['sex'];
                    $sdt=$_POST['phone'];
                    $cccd=$_POST['cccd'];
                    $diachi=$_POST['address'];

                    $filename1 = $_FILES['imgcccdfront']['name'];
                    $tmpname1 = $_FILES['imgcccdfront']['tmp_name'];
                    $imagePath1 = '../image/' . $filename1;
                    move_uploaded_file($tmpname1,$imagePath1);

                    $filename2 = $_FILES['imgcccdback']['name'];
                    $tmpname2 = $_FILES['imgcccdback']['tmp_name'];
                    $imagePath2 = '../image/' . $filename2;
                    move_uploaded_file($tmpname2,$imagePath2);

                    $filename3 = $_FILES['img']['name'];
                    $tmpname3 = $_FILES['img']['tmp_name'];
                    $imagePath3 = '../image/' . $filename3;
                    move_uploaded_file($tmpname3,$imagePath3);
    
                    $view = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE MaNV='$manhanvien'");
                    if(mysqli_num_rows($view)>0 )
                    {
                        echo '<script>alert("Nhân viên này đã tồn tại")</script>';
                    }
                    else
                    {
                        $view_check_phone = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE Phone= '$sdt'");
                        $view_check_cccd = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE CCCD= '$cccd'");
                        if(mysqli_num_rows($view_check_phone)>0)
                        {
                            echo '<script>alert("Số điện thoại đã được sử dụng")
                            window.location.href = "profile.php"</script>';
                        }
                        else if(mysqli_num_rows($view_check_cccd)>0)
                        {
                            echo '<script>alert("Số CCCD đã được sử dụng")
                            window.location.href = "profile.php"</script>';
                        }
                        else{
                            $result1 = mysqli_query($conn,"INSERT INTO tbl_nhanvien(MaNV,TenNV,Username,GioiTinh,Phone,CCCD,ImageCCCDFront,ImageCCCDBack,Diachi,Image)VALUES ('$manhanvien','$tennhanvien','$username','$gioitinh','$sdt','$cccd','$filename1','$filename2','$diachi','$filename3')");
                            $result2 = mysqli_query($conn,"UPDATE tbl_account SET password = '$password' WHERE username = '$username'");
                            if($result1 && $result2)
                            {
                                echo '<script>alert("Thêm thành công");
                                window.location.href = "profile.php"
                                </script>';
                            }
                        }
                    }
                }
                else if(isset($_POST['btn-edit'])){
                    $username = $_SESSION['username'];
                    $tennhanvien=$_POST['name'];
                    $gioitinh=$_POST['sex'];
                    $sdt=$_POST['phone'];
                    $cccd=$_POST['cccd'];
                    $diachi=$_POST['address'];
                    $password=$_POST['password'];
                    
                    $current_image_query = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE Username= '$username'");
                    $current_image_row = mysqli_fetch_assoc($current_image_query);
                    $current_image  = $current_image_row['Image'];
                    $current_imagecccdfront  = $current_image_row['ImageCCCDFront'];
                    $current_imagecccdback  = $current_image_row['ImageCCCDBack'];

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
                    $view_check_phone = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE Phone= '$sdt'");
                    $view_check_cccd = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE CCCD= '$cccd'");
                    if(mysqli_num_rows($view_check_phone)>1)
                    {
                        echo '<script>alert("Số điện thoại đã được sử dụng")
                        window.location.href = "profile.php"</script>';
                    }
                    else if(mysqli_num_rows($view_check_cccd)>1)
                    {
                        echo '<script>alert("Số CCCD đã được sử dụng")
                        window.location.href = "profile.php"</script>';
                    }
                    else{
                        $result1 = mysqli_query($conn,"UPDATE tbl_nhanvien SET TenNV='$tennhanvien',GioiTinh='$gioitinh',Phone='$sdt',CCCD='$cccd',Image='$image_save3',DiaChi='$diachi',ImageCCCDFront='$image_save1',ImageCCCDBack='$image_save2'  WHERE Username='$username'");
                        $result2 = mysqli_query($conn,"UPDATE tbl_account SET password = '$password' WHERE username = '$username'");
                            if($result1 && $result2)
                            {
                                echo '<script>alert("Sửa thành công");
                                window.location.href = "profile.php"
                            </script>';
                            }   
                    }           
                }
                else{
                    $username = $_SESSION['username'];
                    $res_tag = $res_name = $res_phone = $res_cccd= $res_sex = $res_img = $res_address = "";
                    $res_img  = "../images.png";
                    $res_imgcccdback=$res_imgcccdfront = "images2.jpg";
                    $result = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE Username='$username'");
                    if($result && mysqli_num_rows($result) > 0)
                    {
                        $row = mysqli_fetch_assoc($result);
                        $res_tag = $row['MaNV'];
                        $res_name = $row['TenNV'];
                        $res_sex = $row['GioiTinh'];
                        $res_phone = $row['Phone'];
                        $res_cccd = $row['CCCD'];
                        $res_imgcccdfront = !empty($row['ImageCCCDFront']) ? $row['ImageCCCDFront'] : 'images2.jpg';
                    $res_imgcccdback = !empty($row['ImageCCCDBack']) ? $row['ImageCCCDBack'] : 'images2.jpg';
                        $res_address = $row['DiaChi'];
                        $res_img =! empty($row['Image']) ? $row['Image'] : 'images.png';      
                        
                    }
                }
            }
            else if($_SESSION['ChucVu']=="1")
            {
                if(isset($_POST['btn-add']))
                {
                    $username = $_SESSION['username'];
                    $password=$_POST['password'];
                    $masinhvien = $_POST['tag'];
                    $tensinhvien=$_POST['name'];
                    $gioitinh=$_POST['sex'];
                    $sdt=$_POST['phone'];
                    $cccd=$_POST['cccd'];
                    $diachi=$_POST['address'];
                    $maphong=$_POST['room'];
                    $lop = $_POST['class'];

                    $filename1 = $_FILES['imgcccdfront']['name'];
                    $tmpname1 = $_FILES['imgcccdfront']['tmp_name'];
                    $imagePath1 = '../image/' . $filename1;
                    move_uploaded_file($tmpname1,$imagePath1);

                    $filename2 = $_FILES['imgcccdback']['name'];
                    $tmpname2 = $_FILES['imgcccdback']['tmp_name'];
                    $imagePath2 = '../image/' . $filename2;
                    move_uploaded_file($tmpname2,$imagePath2);

                    $filename3 = $_FILES['img']['name'];
                    $tmpname3 = $_FILES['img']['tmp_name'];
                    $imagePath3 = '../image/' . $filename3;
                    move_uploaded_file($tmpname3,$imagePath3);
    
                    $view = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE MaSV='$masinhvien'");
                    $view_check_room = mysqli_query($conn,"SELECT * FROM tbl_phong WHERE MaPhong = '$maphong'");
                    $row_check_room = mysqli_fetch_assoc($view_check_room);
                    $view_check_phone = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE Phone= '$sdt'");
                    $view_check_cccd = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE CCCD= '$cccd'");
                    if(mysqli_num_rows($view_check_phone)>0)
                    {
                        echo '<script>alert("Số điện thoại đã được sử dụng")
                        window.location.href = "profile.php"</script>';
                    }
                    else if(mysqli_num_rows($view_check_cccd)>0)
                    {
                        echo '<script>alert("Số CCCD đã được sử dụng")
                        window.location.href = "profile.php"</script>';
                    }
                    if(mysqli_num_rows($view)>0 )
                    {
                        echo '<script>alert("Sinh viên này đã tồn tại")
                        window.location.href = "profile.php"</script>';
                    }
                    else if($row_check_room['LoaiPhong']!= $gioitinh)
                    {
                        echo '<script>alert("Giới tính không trùng với loại phòng")
                        window.location.href = "profile.php"</script>';
                    }
                    else
                    {
                        $result1 = mysqli_query($conn,"INSERT INTO tbl_sinhvien(MaSV,TenSV,Username,GioiTinh,Phone,CCCD,ImageCCCDFront,ImageCCCDBack,Diachi,Image,MaPhong,Class)VALUES ('$masinhvien','$tensinhvien','$username','$gioitinh','$sdt','$cccd','$filename1','$filename2','$diachi','$filename3','$maphong','$lop')");
                        $result2 = mysqli_query($conn,"UPDATE tbl_account SET password = '$password' WHERE username = '$username'");
                        if($result1 && $result2)
                        {
                            echo '<script>alert("Thêm thành công");
                            window.location.href = "profile.php"
                            </script>';

                        }
                    }
                }
                else if(isset($_POST['btn-edit'])){
                    $username = $_SESSION['username'];
                    $tensinhvien=$_POST['name'];
                    $gioitinh=$_POST['sex'];
                    $sdt=$_POST['phone'];
                    $cccd=$_POST['cccd'];
                    $diachi=$_POST['address'];
                    $maphong='';
                    $maphong=$_POST['room'];
                    $lop = $_POST['class'];
                    $password=$_POST['password'];
                    
                    $current_image_query = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE Username= '$username'");
                    $current_image_row = mysqli_fetch_assoc($current_image_query);
                    $current_image  = $current_image_row['Image'];
                    $current_imagecccdfront  = $current_image_row['ImageCCCDFront'];
                    $current_imagecccdback  = $current_image_row['ImageCCCDBack'];

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
                    $view_check_room = mysqli_query($conn,"SELECT * FROM tbl_phong WHERE MaPhong = '$maphong'");
                    $row_check_room = mysqli_fetch_assoc($view_check_room);
                    $view_check_phone = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE Phone= '$sdt'");
                    $view_check_cccd = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE CCCD= '$cccd'");
                    if(mysqli_num_rows($view_check_phone)>1)
                    {
                        echo '<script>alert("Số điện thoại đã được sử dụng")
                        window.location.href = "profile.php"</script>';
                    }
                    else if(mysqli_num_rows($view_check_cccd)>1)
                    {
                        echo '<script>alert("Số CCCD đã được sử dụng")
                        window.location.href = "profile.php"</script>';
                    }
                    if($row_check_room['LoaiPhong']!= $gioitinh)
                    {
                        echo '<script>alert("Giới tính không trùng với loại phòng")
                        </script>';
                    }
                    else
                    {
                        $result1 = mysqli_query($conn,"UPDATE tbl_sinhvien SET TenSV='$tensinhvien',GioiTinh='$gioitinh',Phone='$sdt',CCCD='$cccd',Image='$image_save3',DiaChi='$diachi',ImageCCCDFront='$image_save1',ImageCCCDBack='$image_save2',MaPhong='$maphong',Class='$lop' WHERE Username='$username'");
                        $result2 = mysqli_query($conn,"UPDATE tbl_account SET password = '$password' WHERE username = '$username'");
                        if($result1&& $result2)
                        {
                            echo '<script>alert("Sửa thành công");
                                window.location.href = "profile.php"
                            </script>';
                        } 
                    }                 
                }
                else{
                    $username = $_SESSION['username'];
                    $res_tag = $res_name = $res_phone = $res_cccd = $res_sex = $res_img = $res_address = $res_class="";
                    $res_img  = "images.png";
                    $res_imgcccdback=$res_imgcccdfront = "images2.jpg";
                    $result = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE Username='$username'");
                    if($result && mysqli_num_rows($result) > 0)
                    {
                        $row = mysqli_fetch_assoc($result);
                        $res_tag = $row['MaSV'];
                        $res_name = $row['TenSV'];
                        $res_sex = $row['GioiTinh'];
                        $res_phone = $row['Phone'];
                        $res_cccd = $row['CCCD'];  
                        $res_address = $row['DiaChi'];
                        $res_img =! empty($row['Image']) ? $row['Image'] : 'images.png';      
                        $res_room =$row['MaPhong'] ; 
                        $res_class = $row['Class'];     
                        $res_imgcccdfront = !empty($row['ImageCCCDFront']) ? $row['ImageCCCDFront'] : 'images2.jpg';
                        $res_imgcccdback = !empty($row['ImageCCCDBack']) ? $row['ImageCCCDBack'] : 'images2.jpg';    
                    }
                }
            }
            $username = $_SESSION['username'];
            $getaccount = mysqli_query($conn,"SELECT * FROM tbl_account WHERE username = '$username'");
            $rowaccount = mysqli_fetch_assoc($getaccount);
            $res_username = $rowaccount['username'];
            $res_password = $rowaccount['password'];
        ?>
            <form class="info" method="post" enctype="multipart/form-data" onsubmit="enableSelect()">
                <div class="info-container">
                <div class="row">
                <div class="title-info">Tài khoản, mật khẩu</div>
                    <div class="col">
                        <div class="box">
                            <label>Tài khoản</label>
                            <input type="text" name="username" value='<?php echo $res_username ?>' id="username" autocomplete="off" required placeholder="Nhập tài khoản" disabled> 
                        </div>
                    </div>
                    <div class="col">
                        <div class="box">
                            <label>Mật khẩu</label>
                            <input type="password" name="password" value='<?php echo $res_password ?>' autocomplete="off" required placeholder="Nhập mật khẩu" pattern=".{8,16}" title="Tài khoản phải có từ 8 đến 16 ký tự.">
                        </div>
                    </div>
                </div>
                    <div class="row">
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
                                <?php 
                                    if($_SESSION['ChucVu']==0 || $_SESSION['ChucVu']==2)
                                    {
                                        echo '<input type="text" name="tag" value="' .$res_tag.'" id="tag" autocomplete="off" placeholder="Nhập mã nhân viên (VD:NV00)" pattern="^NV\d{2}$" title="Hãy nhập đúng định dạng mã nhân viên">';
                                    }
                                    else {
                                        echo '<input type="text" name="tag" value="' .$res_tag.'" id="tag" autocomplete="off" required placeholder="Nhập mã sinh viên"  placeholder="Nhập mã sinh viên (VD:73DCTT00000)" pattern="\d{2}[A-Z]{4}\d{5}" title="Hãy nhập đúng định dạng mã sinh viên">';
                                    }
                                ?>
                                
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <label>Giới tính</label>
                                <select name="sex">
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
                        <div class="col-3">
                            <div class="box">
                                <label>Ảnh 4x6</label>
                                <?php if(empty($res_tag)) { ?>
                                    <input type="file" name="img" id="img" accept=".jpg, .jpeg, .png" autocomplete="off" required>
                                <?php } else { ?>
                                    <input type="file" name="img" id="img" accept=".jpg, .jpeg, .png" autocomplete="off">
                                <?php } ?> 
                                <img class ="avatar" src="../image/<?php echo $res_img ?>">
                            </div>
                            
                        </div>
                        <div class="col">
                            <div class="box">
                                <label>Ảnh cccd mặt trước</label>
                                <?php if(empty($res_tag)) { ?>
                                    <input type="file" name="imgcccdfront" id="imgcccd" accept=".jpg, .jpeg, .png" autocomplete="off" required>
                                <?php } else { ?>
                                    <input type="file" name="imgcccdfront" id="imgcccd" accept=".jpg, .jpeg, .png" autocomplete="off">
                                <?php } ?>  
                                <img class ="cccdfront" src="../image/<?php echo $res_imgcccdfront ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <label>Ảnh căn cước công dân mặt sau</label>
                                <?php if(empty($res_tag)) { ?>
                                    <input type="file" name="imgcccdback" id="imgcccd" accept=".jpg, .jpeg, .png" autocomplete="off" required>
                                <?php } else { ?>
                                    <input type="file" name="imgcccdback" id="imgcccd" accept=".jpg, .jpeg, .png" autocomplete="off" >
                                <?php } ?> 
                                <img class ="cccdback" src="../image/<?php echo $res_imgcccdback ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id ="for-student">
                        <div class="title-info">Phòng, Lớp</div>
                        <div class="col">
                            <div class="box">
                                <label>Phòng</label>
                                <?php
                                    if($_SESSION['trangthai']=="1")            
                                    {
                                        echo "<script>
                                            function enableSelect() {
                                                document.getElementById('room').disabled = false;
                                            }
                                            document.addEventListener('DOMContentLoaded', function() {
                                                document.getElementById('room').disabled = true;
                                            });
                                            </script>";
                                            
                                    }
                                        
                                ?>
                                <select id="room" name='room' required>
                                <?php
                                    $result=mysqli_query($conn,"SELECT * FROM tbl_phong");
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result) ) {
                                            if ($row["SoSV"] != $row["SoLuong"]){
                                                {
                                                    $selected = ($row["MaPhong"] == $res_room) ? "selected" : "";
                                                    $RoomType = ($row["LoaiPhong"] == 0) ? "Phòng nam" : "Phòng nữ";
                                                    echo '<option value="' . $row["MaPhong"] . '"'.$selected.'>'.$row["TenPhong"].' - '.$RoomType.' - '.$row["SoSV"].'/'.$row["SoLuong"].'</option>';
                                                }
                                            }
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
                <?php if(empty($res_tag)) { ?>
                    <div class="btn-add-div"><input type="submit" name="btn-add" class="btn-function" value="Thêm"></div>
                    
                <?php } else { ?>
                    <div class="btn-edit-div"><input type="submit" name="btn-edit" class="btn-function" value="Sửa"></div>
                    <script>document.getElementById("tag").disabled = true;</script>
                <?php } ?>  
            </form>
    </div>
</body>
</html>
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
    <link rel="stylesheet" type="text/css" href="qlnhanvien.css?v=<?php echo time(); ?>">
</head>
<body>
    <form enctype="multipart/form-data" method="post">
        <?php
            if(isset($_POST['btn-add']))
                {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
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
    
                    $view_check1 = mysqli_query($conn,"SELECT * FROM tbl_account WHERE username='$username'");
                    $view_check2 = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE MaNV='$manhanvien'");
                    $view_check_phone = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE Phone= '$sdt'");
                    $view_check_cccd = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE CCCD= '$cccd'");
                    if(mysqli_num_rows($view_check_phone)>0)
                    {
                        echo '<script>alert("Số điện thoại đã được sử dụng")
                        window.location.href = "ql_nhanvien.php"</script>';
                    }
                    else if(mysqli_num_rows($view_check_cccd)>0)
                    {
                        echo '<script>alert("Số CCCD đã được sử dụng")
                        window.location.href = "ql_nhanvien.php"</script>';
                    }
                     else if(mysqli_num_rows($view_check1)>0 )
                    {
                        echo '<script>alert("Tài khoản này đã tồn tại")</script>';     
                    }
                    else if(mysqli_num_rows($view_check2)>0)
                    {
                        echo '<script>alert("Nhân viên này đã tồn tại")</script>';
                    }
                    else
                    {
                        $result1 = mysqli_query($conn,"INSERT INTO tbl_account(username,password,ChucVu)VALUES ('$username','$password','0')");
                        $result2 = mysqli_query($conn,"INSERT INTO tbl_nhanvien(MaNV,TenNV,Username,GioiTinh,Phone,CCCD,ImageCCCDFront,ImageCCCDBack,Diachi,Image)VALUES ('$manhanvien','$tennhanvien','$username','$gioitinh','$sdt','$cccd','$filename1','$filename2','$diachi','$filename3')");
                        if($result1 & $result2)
                        {
                            echo '<script>alert("Thêm thành công");
                            window.location.href =  "ql_nhanvien-edit.php?MaNV='.$manhanvien.'"
                            </script>';

                        }
                    }
                }
        ?>
        <div class="heading">
            <a href="ql_nhanvien.php" id="goback"><i class="bi bi-arrow-left"></i></a>
            <div><img class ="avatar" src="../image/images.png"> 
            <input type="file" name="img" id="img" accept=".jpg, .jpeg, .png" autocomplete="off" required>      
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="title-info">Tài khoản, mật khẩu</div>
                    <div class="col">
                        <div class="box">
                            <label>Tài khoản</label>
                            <input type="text" name="username" id="phone" autocomplete="off" required placeholder="Nhập tài khoản" pattern=".{6,16}" placeholder="Tài khoản (6-16 ký tự)" title="Tài khoản phải có từ 6 đến 16 ký tự."> 
                        </div>
                    </div>
                    <div class="col">
                        <div class="box">
                            <label>Mật khẩu</label>
                            <input type="password" name="password" autocomplete="off" required placeholder="Nhập mật khẩu" pattern=".{8,16}" title="Mật khẩu phải có từ 8 đến 16 ký tự.">
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="title-info">Thông tin cá nhân</div>
                    <div class="col">
                        <div class="box">
                            <label>Họ và tên</label>
                            <input type="text" name="name" id="name" autocomplete="off" required placeholder="Nhập họ tên">
                        </div>        
                    </div>
                    <div class="col">
                        <div class="box">
                            <label>Mã người dùng</label>
                            <input type="text" name="tag" id="tag" autocomplete="off" placeholder="Nhập mã nhân viên (VD:NV00)" pattern="^NV\d{2}$" title="Hãy nhập đúng định dạng mã nhân viên">
                        </div>
                    </div>
                    <div class="col">
                        <div class="box">
                            <label>Giới tính</label>
                            <select name="sex"  id="sex">
                                <option value='0'>Nam</option>
                                <option value='1'>Nữ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="box">
                            <label>Số điện thoại</label>
                            <input type="text" name="phone" id="phone" autocomplete="off" required placeholder="Nhập số điện thoại cá nhân" pattern="0[0-9]{9}" title="Sđt phải có đủ 10 số bắt đầu từ số 0"> 
                        </div>
                    </div>
                    <div class="col">
                        <div class="box">
                            <label>Số CCCD</label>
                            <input type="text" name="cccd" id="cccd" autocomplete="off" required placeholder="Nhập số CCCD" pattern="[0-9]{12}" title="CCCD phải đủ 12 số">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="box">
                            <label>Địa chỉ thường trú</label>
                            <input type="text" name="address" id="address" autocomplete="off" required  placeholder="Nhập địa chỉ">
                        </div>
                    </div>
                </div>
                <div class="row" id="image-box">
                    <div class="title-info">Ảnh 4x6, Ảnh CCCD/CMND</div>
                    <div class="col">
                        <div class="box">
                            <label>Ảnh cccd mặt trước</label>
                            <input type="file" name="imgcccdfront" id="imgcccdfront" accept=".jpg, .jpeg, .png" autocomplete="off" required>
                            <img class ="cccdfront" src="../image/images2.jpg">
                        </div>
                    </div>
                    <div class="col">
                        <div class="box">
                            <label>Ảnh căn cước công dân mặt sau</label>
                            <input type="file" name="imgcccdback" id="imgcccdback" accept=".jpg, .jpeg, .png" autocomplete="off" required>
                            <img class ="cccdback" src="../image/images2.jpg">
                        </div>
                    </div>
                </div>
                <div class="btn-add-div"><input type="submit" name="btn-add" class="btn-function" value="Thêm">
        </div>
    </form>
</body>
</html>
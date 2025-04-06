<?php
    session_start();
    require("../db/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="contact-media">
    <ul class="contact">
        <li>
            <a href="tel:02435526713"><i class="bi bi-telephone"></i> 02435526713</a>
        </li>
        <li>
            <a href="mailto:ktxutt@gmail.com"><i class="bi bi-envelope"></i> ktx.utt@gmail.com</a>
        </li>
    </ul>
    <ul class="media">
        <li><a href="https://www.facebook.com/utt.vn"><i class="bi bi-facebook"></i></a></li>
        <li><a href="https://youtube.com/uttchannel"><i class="bi bi-youtube"></i></a></li>
        <li><a href="https://www.instagram.com/utt.university/"><i class="bi bi-instagram"></i></a></li>
        <li style="margin-left: 20px;"><button class="profile-open" id="profile-open"><?php  ?><i class="bi bi-person-fill"></i></button></li>
    </ul>
   
</div>
<div class="header">
        <div class="header-menu">
            <button class="menu-active" id="menu-active"><i class="bi bi-list"></i></button>
        </div>
        <div class="header-logo">
            <a href="index.php"><img style="width: 250px;" src="../image/1447346709LOGO_GTVT.png"></a>
        </div>
        <div class="header-links">
            <a href="#login">Trang chủ</a>
            <a href="#notify">Thông báo</a>
            <a href="#room">Tra cứu</a>
            <a href="#location">Liên hệ</a>
        </div>
</div>
    <div class="overlay-menu" id="overlay-menu">
        <div class="drop-menu" id="drop-menu">
            <div class="menu-heading">
                <a href=""><img style="width:250px;" src="../image/1447346709LOGO_GTVT.png"></a>
                <button style="background-color: transparent;border:none"><i id="xmark" class="bi bi-x"></i></button>
            </div>
            <div class="menu-links">
                <a href="#login">Trang chủ</a>
                <a href="#notify">Thông báo</a>
                <a href="#room">Tra cứu</a>
                <a href="#location">Liên hệ</a>
                <script>
                var links = document.querySelectorAll('.menu-links a');
                var menuLinks = document.querySelector('.overlay-menu');

                // Thêm sự kiện lắng nghe cho mỗi liên kết
                links.forEach(function(link) {
                    link.addEventListener('click', function() {
                        // Ẩn menu-links khi một liên kết được nhấp
                        menuLinks.style.display = 'none';
                    });
                });
            </script>
            </div>

        </div>
    </div>
    <div class="overlay-user" id="overlay-user">
        <div class="user-interface" id="user-interface">
            <div class="user-heading">
                <div><img style="width:300px" src="../image/1447346709LOGO_GTVT.png"></div>
                <button style="background-color: transparent;border:none"><i style = "font-size: 30px;" id="xmark2" class="bi bi-x"></i></button>
            </div>
            <div class="choice">
                <button class="login-btn">Đăng nhập</button>
                <button  class="signup-btn">Đăng ký</button>
            </div>
            <?php
                     require("../db/connect.php");
                     if(isset($_POST['login-btn'])){
                        $username = $_POST['username-login'];
                        $password = $_POST['password-login'];
                        $result = mysqli_query($conn,"SELECT * FROM tbl_account WHERE username='$username' AND password='$password' ");
                        if(mysqli_num_rows($result)>0)
                        {
                            $row=mysqli_fetch_assoc($result);
                            echo "<script>alert('Đăng nhập thành công')</script>";
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['ChucVu'] = $row['ChucVu'];
                        }
                        else{
                            echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác')</script>";
                        }
                    }
                    ?>
                <form class="user-login" id="user-login" method="post">
                    <div class="main-info">
                        <div class="username">
                            <label>Tài khoản</label>
                            <input type="text" class="username-box" name = "username-login" autocomplete="off" required  >
                        </div>
                        <div class="password">
                            <label>Mật khẩu</label>
                            <input type="password" class="password-box" name="password-login" autocomplete="off" required  >
                        </div>
                        <div class="login-click">
                            <div><input type="submit" class="login-btn" value="Đăng nhập" name="login-btn"></div>
                        </div>
                    </div>
                </form>
                <?php
                     require("../db/connect.php");
                     if(isset($_POST['signup-btn'])){
                        $username = $_POST['username-register'];
                        $password = $_POST['password-register'];
                        $repassword= $_POST['re-password-register'];
                        $position = $_POST['position-register'];
                        $check_query = mysqli_query($conn,"SELECT * FROM tbl_account WHERE username='$username'") or die("Select Error");
                        if(mysqli_num_rows($check_query)>0)
                        {
                            echo "<script>alert('Tài khoản này đã tồn tại')</script>";
                        }
                        else if($repassword != $password){
                            echo "<script>alert('Mật khẩu nhập lại không đúng')</script>";
                        }
                        else{
                            $query=mysqli_query($conn,"INSERT INTO tbl_account(username,password,ChucVu) VALUES ('$username','$password','$position')") or die("Select Error");
                            if($query){
                                echo "<script>alert('Đăng ký thành công')</script>";
                            }
                        }
                    }
                    ?>
                <form class="user-signup" id="user-signup" method="post">
                    <div class="main-info">               
                        <div>
                            <label>Tài khoản</label>
                            <input type="text" class="email-box" name="username-register" autocomplete="off" required pattern=".{6,16}" placeholder="Tài khoản (6-16 ký tự)" title="Tài khoản phải có từ 6 đến 16 ký tự." >
                        </div>
                        <div>
                            <label>Mật khẩu</label>
                            <input type="password" class="password-box" name="password-register" autocomplete="off" required  pattern=".{8,16}" placeholder="Tài khoản (8-16 ký tự)" title="Tài khoản phải có từ 8 đến 16 ký tự."  >
                        </div>
                        <div>
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" class="password-box" name="re-password-register" autocomplete="off" required >
                        </div>
                        <div>
                            <label>Chức vụ</label>
                            <select name="position-register">
                                <option value="0">Quản lý</option>
                                <option value="1">Sinh viên</option>
                            </select>
                        </div>
                        <div class="signup-click">
                            <div><input type="submit" class="signup-btn" value="Sign up" name="signup-btn" ></div>
                        </div>
                    </div>               
                </form>
        </div>
    </div>

        <section  id="login" class="main-login" style="background-image: url(image/646c15d1be5aea73d04b9dfbabb244ea.jpg);">
            <div class="container">
                <h1 style="font-weight: bold;">KÍ TÚC XÁ UTT</h1>
                <button class="login-lobby">Đăng nhập</button>
            </div>
        </section>
        <section id="notify" class="notify">
            <h1 style="font-weight: bold;"> Thông báo</h1>
            <div class="card-container">
            <?php
                $view = mysqli_query($conn,"SELECT * FROM tbl_thongbao");
                    while($row = mysqli_fetch_assoc($view)){
                        $getname = $row["MaNV"];
                        $view_getname = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE MaNV = '$getname'");
                        $row_getname = mysqli_fetch_assoc($view_getname);
                        $name = $row_getname["TenNV"];
                        $formattedDate = date("d/m/Y",strtotime($row["Ngay_tao"]));
                        echo '<div class="card">
                            <div class="" style="font-weight: 600;font-size: 15px;">'.$name.'</div>
                            <div class="" style="font-weight: 600;font-size: 15px;">'.$formattedDate.'</div>
                            <div class="content">
                                <div class="topic" style="font-weight: 600;font-size: 15px;">'.$row["TieuDe"].'</div>
                                <div class="main-content">'.$row["NoiDung"].'</div>
                            </div>
                        </div>';
                    }
            ?>
            </div>
        </section>
        <section id="room" class="room-info">
            <h1 style="font-weight: bold;">Các loại phòng</h1>
            <div class="card-container">
                <div class="card">
                    <img src="../image/phong82.jpg" class="card-img">
                    <div class="card-body">
                         <h5 style="font-size: 16px;font-weight: 600;">Phòng 8 người</h5>
                        <div style="font-size: 14px;">250.000đ/người</div>
                    </div>
                </div>
                <div class="card">
                    <img src="../image/phong6.jpg" class="card-img">
                    <div class="card-body">
                         <h5 style="font-size: 16px;font-weight: 600;">Phòng 6 người</h5>
                        <div style="font-size: 14px;">500.000đ/người</div>
                    </div>
                </div>
                <div class="card">
                    <img src="../image/4 khong ml.jpg" class="card-img">
                    <div class="card-body">
                         <h5 style="font-size: 16px;font-weight: 600;">Phòng 4 người</h5>
                        <div style="font-size: 14px;">700.000đ/người</div>
                    </div>
                </div>
            </div>
        </section>
        <script>
        const isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;
        const menu = document.querySelector('.menu-active')
        const overlay1 = document.getElementById('overlay-menu')
        const overlay2 = document.getElementById('overlay-user')
        const xmark = document.getElementById('xmark')
        const xmark2 = document.getElementById('xmark2')
        const menu_interface = document.getElementById('drop-menu')
        const profile_click = document.querySelector('.profile-open')
        const main_interface = document.getElementById('user-interface')
        const signup_interface = document.getElementById('user-signup')
        const login_interface = document.getElementById('user-login')
        const login_btn= document.querySelector('.login-btn')
        const signup_btn = document.querySelector('.signup-btn')
        const login_lobby = document.querySelector('.login-lobby')
        menu.onclick = function()
        {
            overlay1.style.display = 'block';
            menu_interface.style.display = 'block';
        }
        xmark.onclick = function()
        {
            overlay1.style.display = 'none';
            menu_interface.display = 'none';
        }
        xmark2.onclick = function()
        {
            overlay2.style.display = 'none';
            main_interface.style.display = 'none';
        }
        profile_click.onclick = login_lobby.onclick = function()
        {
            if(isLoggedIn)
            {
                window.location.href = 'TrangChu/trangchu.php';
            }
            else{
                overlay2.style.display = 'block';
                main_interface.style.display = 'block';
                login_interface.style.display = 'block';
                signup_interface.style.display = 'none';
            }          
        }
        login_btn.onclick=function()
        {
            login_interface.style.display = 'block';
            signup_interface.style.display = 'none';
        }
        signup_btn.onclick=function()
        {
            signup_interface.style.display = 'block';
            login_interface.style.display = 'none';
        }
    </script>
    <iframe id="location" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.2181269697307!2d105.79546117488806!3d20.983891680654235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acc698df035d%3A0xa0fc506cdab4e1e3!2zS8OtIFTDumMgWMOhIMSQ4bqhaSBI4buNYyBDw7RuZyBOZ2jhu4cgR2lhbyBUaMO0bmcgVuG6rW4gVOG6o2k!5e0!3m2!1svi!2s!4v1718890688216!5m2!1svi!2s" width="100%" height="450" style="border:0;margin-top: 60px;margin-bottom: -37px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <footer>
        <footer class="bg-dark footer_dark">
    <div class="top_footer">
                <div class="column">
                    <h6>Cơ sở Hà Nội</h6>
                    <ul class="contact_info">
                        <li>
                            
                            <div><i class="bi bi-geo-alt-fill"></i> Số 54 Phố Triều Khúc, Phường Thanh Xuân Nam, Quận Thanh Xuân, Hà Nội</div>
                        </li>
                        <li>
                            <a href="mailto:info@sitename.com"><i class="bi bi-envelope-fill"></i> infohn@utt.edu.vn</a>
                        </li>
                        <li>
                           
                            <p> <i class="bi bi-telephone-fill"></i> Điện thoại: 0243.552.6713 - 0243.552.6714</p>
                        </li>
                    </ul>
                </div>
                <div class="column">
                    <h6 class="widget_title">Cơ sở Vĩnh Phúc</h6>
                    <ul class="contact_info">
                        <li>
                            <div><i class="bi bi-geo-alt-fill"></i> Khu đô thị Sông Hồng Thủ đô, Phường Đồng Tâm, Thành phố Vĩnh Yên, Vĩnh Phúc</div>
                        </li>
                        <li>

                            <a href="mailto:info@sitename.com"><i class="bi bi-envelope-fill"></i> infovp@utt.edu.vn</a>
                        </li>
                        <li>
                            <p> <i class="bi bi-telephone-fill"></i> Điện thoại: 0211.386.7404 - 0211.371.7229</p>
                        </li>
                    </ul>
                </div>
                <div class="column">
                    <h6 class="widget_title">Cơ sở Thái Nguyên</h6>
                    <ul class="contact_info ">
                        <li>
                            <div><i class="bi bi-geo-alt-fill"></i> Phường Tân Thịnh, Thành phố Thái Nguyên, Thái Nguyên</div>
                        </li>
                        <li>
                            <a href="mailto:info@sitename.com"><i class="bi bi-envelope-fill"></i> infotn@utt.edu.vn</a>
                        </li>
                        <li>
                            <p> <i class="bi bi-telephone-fill"></i> Điện thoại: 0208.385.6545 - 0208.385.5681</p>
                        </li>
                    </ul>
                </div>
    </div>
</footer>
</body>

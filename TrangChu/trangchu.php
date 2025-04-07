<?php
    ob_start();
    session_start();  
    require("../db/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chu</title>
    <link rel="stylesheet" type="text/css" href="trangchu.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <script src="load.js"></script>
</head>

<body>
    
    <div class = "container_page">
        <div class = "style_page">
             <!--Menu doc-->
            <div class = "menu_doc">
                <div class = "container_doc">
                    <a class="lobby" href="../index.php"><img src="../image/1447346709LOGO_GTVT.png"></a>
                    <div class = "title_doc" >KÝ TÚC XÁ UTT</div>
                    <form class = "menu_list" method="post">
                        <div class = "ql_trangchu" onclick="make_color()" id="thongtin" >
                            <a href="#" onclick="load_page('../Profile/profile.php','Thông tin cá nhân')">
                                <div class = "img_trangchu"><i class="bi bi-person-fill" id = "icon_trangchu"></i></i></div>
                                <div class = "title_trangchu">Thông tin cá nhân</div>
                            </a>
                            
                        </div> 
                        <div class = "ql_trangchu" onclick="make_color()" id="ql_hopdong">
                            <a href="#" onclick="load_page('../QLHĐ/ql_hopdong.php','Quản lý hợp đồng')">
                                <div class = "img_trangchu"><i class="bi bi-house-door-fill" id = "icon_trangchu"></i></div>
                                <div class = "title_trangchu">Quản lý hợp đồng</div>
                            </a>
                            
                        </div>

                        <div class = "ql_trangchu" onclick="make_color()" id="ql_nhanvien">
                            <a href="#" id="ql_nhanvien" onclick="load_page('../QLNV/ql_nhanvien.php','Quản lý nhân viên')">
                                <div class = "img_trangchu"><i class="bi bi-people-fill" id = "icon_trangchu"></i></div>
                                <div class = "title_trangchu">Quản lý nhân viên</div>
                            </a>
                        </div>

                        <div class = "ql_trangchu" onclick="make_color()" id="ql_sinhvien">
                        <a href="#"  onclick="load_page('../QLSV/ql_sinhvien.php','Quản lý sinh viên' )">
                                <div class = "img_trangchu"><i class="bi bi-person-bounding-box" id = "icon_trangchu"></i></div>
                                <div class = "title_trangchu">Quản lý sinh viên</div>
                            </a>
                            
                        </div>

                        <div class = "ql_trangchu" onclick="make_color()" id="ql_phong">
                                <a href="#"  onclick="load_page('../QLP/ql_phong.php','Quản lý phòng')">
                                <div class = "img_trangchu"><i class="bi bi-building" id = "icon_trangchu"></i></div>
                                <div class = "title_trangchu">Quản lý phòng</div>
                            </a>
                            
                        </div>

                        <div class = "ql_trangchu" onclick="make_color()" id="ql_hoadon">
                            <a href="#"  onclick="load_page('../QLHD/hoadon.php','Quản lý hóa đơn'  )">
                                <div class = "img_trangchu"><i class="bi bi-receipt"  id = "icon_trangchu"></i></div>
                                <div class = "title_trangchu">Quản lý hóa đơn</div>
                            </a>
                            
                        </div>

                        <div class = "ql_trangchu" onclick="make_color()" id="ql_thongbao">
                            <a href="#" onclick="load_page('../QLTBC/thongbao.php','Thông báo')">
                                <div class = "img_trangchu"><i class="bi bi-chat-right-text-fill" id = "icon_trangchu"></i></div>
                                <div class = "title_trangchu">Thông báo</div>
                            </a>
                            
                        </div>

                        <div class = "ql_trangchu" onclick="make_color()" id="ql_khieunai">
                        <a href="#" onclick="load_page('../QLKN/khieunai.php','Khiếu nại')">
                                <div class = "img_trangchu"><i class="bi bi-exclamation-square" id = "icon_trangchu"></i></div>
                                <div class = "title_trangchu">Khiếu nại</div>
                            </a>
                            
                        </div>

                        <div class = "ql_trangchu" onclick="make_color()" id="ql_thongke">
                            <a href="#" onclick="load_page('../TK/thongke.php','Thống kê')">
                                <div class = "img_trangchu"><i class="bi bi-database" id = "icon_trangchu"></i></div>
                                <div class = "title_trangchu">Thống kê</div>
                            </a>
                            
                        </div>

                        <div class = "ql_trangchu">
                        <button name="logout">
                                <div class = "img_trangchu"><i class="bi bi-box-arrow-right" id = "icon_trangchu"></i></div>
                                <div class = "title_trangchu">Đăng xuất</div>
                            </button>
                            
                        </div>
                        <?php
                            if(isset($_POST['logout'])) {
                                session_unset();
                                session_destroy();
                                header("Location: index.php"); 
                                exit();
                            }
                        ?>
                    </form>
                    <?php
                        if($_SESSION['ChucVu']=="0")
                        {
                            $username = $_SESSION['username'];
                            $status = 0;
                            $result_menu = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE Username='$username'");
                            if(mysqli_num_rows($result_menu)>0)
                            {
                                $row = mysqli_fetch_assoc($result_menu);
                                $status = isset($row['TrangThai']) ? $row['TrangThai'] : null;
                                $_SESSION['hoten'] = $row['TenNV'];
                                $_SESSION['manv'] = $row['MaNV'];
                            }
                            if($status == 0 || mysqli_num_rows($result_menu)==0) 
                                {
                                    echo "<script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                        document.getElementById('ql_nhanvien').style.display = 'none';
                                        document.getElementById('ql_sinhvien').style.display = 'none';
                                        document.getElementById('ql_hopdong').style.display = 'none';
                                        document.getElementById('ql_thongke').style.display = 'none';
                                        document.getElementById('ql_phong').style.display = 'none';
                                        document.getElementById('ql_khieunai').style.display = 'none';
                                        document.getElementById('ql_thongbao').style.display = 'none';
                                        document.getElementById('ql_hoadon').style.display = 'none';
                                    });
                                    </script>";
                                } 
                                else 
                                {
                                    echo "<script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('ql_nhanvien').style.display = 'none';
                                });
                                </script>";
                                }
                        }
                        else if($_SESSION['ChucVu']=="1" )
                        {
                            $username = $_SESSION['username'];
                            $status = 0;
                            $result_menu = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE Username='$username'");
                            if( mysqli_num_rows($result_menu) > 0)
                            {
                                $row = mysqli_fetch_assoc($result_menu);
                                $_SESSION['hoten'] = $row['TenSV'];
                                $_SESSION['masv'] = $row['MaSV'];
                                $_SESSION['phong'] = $row['MaPhong'];
                                $_SESSION['trangthai'] = $row['TrangThai'];
                                $status = isset($row['TrangThai']) ? $row['TrangThai'] : null;
                            }
                                if($status == 0 || mysqli_num_rows($result_menu)==0)
                                {
                                    echo "<script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                        document.getElementById('ql_nhanvien').style.display = 'none';
                                        document.getElementById('ql_sinhvien').style.display = 'none';
                                        document.getElementById('ql_hopdong').style.display = 'none';
                                        document.getElementById('ql_thongke').style.display = 'none';
                                        document.getElementById('ql_phong').style.display = 'none';
                                        document.getElementById('ql_khieunai').style.display = 'none';
                                        document.getElementById('ql_thongbao').style.display = 'none';
                                        document.getElementById('ql_hoadon').style.display = 'none';
                                    });
                                    </script>";
                                } 
                                else 
                                {
                                    echo "<script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                        document.getElementById('ql_nhanvien').style.display = 'none';
                                        document.getElementById('ql_sinhvien').style.display = 'none';
                                        document.getElementById('ql_hopdong').style.display = 'none';
                                        document.getElementById('ql_thongke').style.display = 'none';
                                        document.getElementById('ql_thongbao').style.display = 'none';
                                    });
                                    </script>";
                                }
                        }
                        else if ($_SESSION['ChucVu'] == "2") {
                            $username = $_SESSION['username'];
                            $status = 0;
                            $result_menu = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE Username='$username'");
                            if(mysqli_num_rows($result_menu)>0)
                            {
                                $row = mysqli_fetch_assoc($result_menu);
                                $_SESSION['hoten'] = $row['TenNV'];
                                $_SESSION['manv'] = $row['MaNV'];
                                $status = isset($row['TrangThai']) ? $row['TrangThai'] : null;
                            }
                                if($status == 0 || mysqli_num_rows($result_menu)==0) 
                                {
                                    echo "<script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                        document.getElementById('ql_nhanvien').style.display = 'none';
                                        document.getElementById('ql_sinhvien').style.display = 'none';
                                        document.getElementById('ql_hopdong').style.display = 'none';
                                        document.getElementById('ql_thongke').style.display = 'none';
                                        document.getElementById('ql_phong').style.display = 'none';
                                        document.getElementById('ql_khieunai').style.display = 'none';
                                        document.getElementById('ql_thongbao').style.display = 'none';
                                        document.getElementById('ql_hoadon').style.display = 'none';
                                    });
                                    </script>";
                                } 
                        }
                        
                    
                    ?>
                </div>
            </div>
            
        
            <!--Menu ngang-->
            <div class = "container_ngang">
                <div class = "style_banner">
                    <div class = "style_container">
                        <div class = "style_trai">
                            <div class = "title_trai" id="title_trai" style="white-space:nowrap"></div>
                        </div>
                        <script>
                            function load_page(url, title) {
                            document.getElementById('title_trai').innerText = title;
                            document.getElementById('contentFrame').src = url;
                            }
                        </script>      
                        <form class = "style_phai" method="post">
                            <?php 
                                $username = $_SESSION['username'];
                                $result=mysqli_query($conn,"SELECT * FROM tbl_account WHERE username='$username'");
                                $row_account = mysqli_fetch_assoc($result);
                                if($row_account['ChucVu']==0 || $row_account['ChucVu']==2) 
                                {
                                    $view = mysqli_query($conn,"SELECT * FROM tbl_nhanvien WHERE Username='$username'");
                                    $name="";
                                    $img = 'images.png';
                                    if($view && mysqli_num_rows($view) > 0){
                                        $row = mysqli_fetch_assoc($view);
                                        $name = $row['TenNV'];
                                        $img = !empty($row['Image']) ? $row['Image'] : 'images.png';
                                    }
                                
                                }
                                else if($row_account['ChucVu']==1)
                                {
                                    $img = 'images.png';
                                    $name = '';
                                    $view = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE Username='$username'");
                                    $name="";
                                    if($view && mysqli_num_rows($view) > 0){
                                        $row = mysqli_fetch_assoc($view);
                                        $name = $row['TenSV'];
                                        $img = !empty($row['Image']) ? $row['Image'] : 'images.png';
                                    }
                                }
                                
                            ?>
                            <a href="#" id="click-chat" style="color: black;" onclick="chat_show()"><div class="icon"><i class="bi bi-chat-dots-fill"></i></div></a>
                            <div class="icon" onclick="tb_show()"><i class="bi bi-bell-fill"></i></div>
                            <div class = "info_acc"><img src="../image/<?php echo $img ?>" id = "avt_acc">
                                <div class="main-info">
                                    <div class = "name_acc"><?php echo $name?> </div>
                                    <div style="font-size:10px" class="position_acc">
                                        <?php if($row_account['ChucVu']==0) {echo "Quản lý";}
                                                else if($row_account['ChucVu']==1) {echo "Sinh viên";}
                                                else if($row_account['ChucVu']==2){echo "Admin";}
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                
                <div class="content_area">
                    <iframe id = "contentFrame" src="../Profile/profile.php" frameborder="0" width="100% " height="100%" id="iframe_home"></iframe>
                </div>
            </div>
            
         </div>
         
    </div>
    <div class="iframe_chat" id="iframe_chat" style="display: none;">
        <iframe src="./page/chat/index.php" frameborder="0" style="position: fixed; background-color: black; right: 250px;
    top: 65px;
    width: 20%;
    height: 600px; display: block;"></iframe>
    </div>
    <div class="iframe_chat" id="iframe_tb" style="display: none; border-radius: 20px;">
        <iframe src="./page/thongbao/thongbao_icon.php" frameborder="1" style="position: fixed; background-color: black; right: 211px;
    top: 65px;
    width: 20%;
    height: 600px; display: block;"></iframe>
    </div>
       
</body>
<Script>
        function chat_show(){
            var if_chat = document.getElementById("iframe_chat");
            if(if_chat.style.display == "block") {
                if_chat.style.display = "none";
                return;
            }
            else{
            document.getElementById("iframe_chat").style.display = "block";
            }
        }
        function tb_show(){
            var if_tb = document.getElementById("iframe_tb");
            if(if_tb.style.display=="block"){
                if_tb.style.display = "none";
                return;
            }
            else{
                document.getElementById("iframe_tb").style.display = "block";
            }
        }
 

        
        
</Script>
</html>
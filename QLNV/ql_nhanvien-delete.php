<?php
    require('../db/connect.php');
    $user= $_GET['userNV'];
    $delete_user = mysqli_query($conn,"DELETE FROM tbl_account WHERE username ='$user'");
    $delete_staff = mysqli_query($conn,"DELETE FROM tbl_nhanvien WHERE Username='$user'");
    if($delete_staff && $delete_user)
    {
        echo '<script>
        alert("Xóa thành công");
        window.location.href = "ql_nhanvien.php";
    </script>';
    }
?>

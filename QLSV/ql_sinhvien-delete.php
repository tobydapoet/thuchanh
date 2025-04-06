<?php
    require('db/connect.php');
    $user= $_GET['userSV'];
    $decrese = mysqli_query($conn,"SELECT * FROM tbl_sinhvien WHERE Username='$user'");
    {
        if($decrese)
        {
            $row= mysqli_fetch_assoc($decrese);
            $room = $row['MaPhong'];
        }
    }
    $delete_user = mysqli_query($conn,"DELETE FROM tbl_account WHERE username = '$user'");
    $delete_student= mysqli_query($conn,"DELETE FROM tbl_sinhvien WHERE Username='$user'");
    $decrease_student = mysqli_query($conn, "UPDATE tbl_phong SET SoSV = SoSV - 1 WHERE MaPhong = '$room'");
    if($delete_student && $delete_user && $decrease_student)
    {
        echo '<script>
        alert("Xóa thành công");
        window.location.href = "ql_sinhvien.php";
    </script>';
    }
?>

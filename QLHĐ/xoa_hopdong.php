<?php
    $MaHD = $_GET['MaHD'];
    include ("../db/connect.php");
        $query = "DELETE FROM tbl_hopdong WHERE MaHD = '".$MaHD."'";
        $result = mysqli_query($conn, $query);
            if($result > 0 ){
                echo '<script>
                            alert("Xóa hợp đồng thành công");
                            window.location.href = "ql_hopdong.php";
                    </script>';
            }
            else {
                echo 'Xóa thất bại';
            }
    
?>
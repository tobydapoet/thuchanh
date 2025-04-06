<?php
    require("../db/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href=hoadon.css?v=<?php echo time();?>">
        <title> Xóa hóa đơn </title>
        <script src="../QLKTX/load.js"></script>
    </head>
    <body>
    <?php
    $MaHD = $_GET['MaHD'];
    $query = "DELETE FROM tbl_hoadon WHERE MaHD='$MaHD'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo '<script>
        alert("Xóa dữ liệu thành công");
        window.location.href = "hoadon.php";
        </script>';
    }
    ?>

    </body>

</html>
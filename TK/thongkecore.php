<?php
header('Content-Type: application/json');
include('../db/connect.php');
//$conn = mysqli_connect("localhost","root","","qlktx1") or die("Error occured");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
function getData($conn, $sql) {
    $result = $conn->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

$sql_rooms = "SELECT COUNT(*) AS total_rooms FROM tbl_phong";
$rooms_data = getData($conn, $sql_rooms);
$total_rooms = $rooms_data[0]['total_rooms'];

// Lấy dữ liệu tổng số nhân viên
$sql_staff = "SELECT COUNT(*) AS total_staff FROM tbl_nhanvien";
$staff_data = getData($conn, $sql_staff);
$total_staff = $staff_data[0]['total_staff'];

// Lấy dữ liệu tổng số điện
$sql_electric = "SELECT SUM(SoDien) AS total_electric FROM tbl_hoadon";
$electric_data = getData($conn, $sql_electric);
$total_electric = $electric_data[0]['total_electric'];

// Lấy dữ liệu tổng số nước
$sql_water = "SELECT SUM(SoNuoc) AS total_water FROM tbl_hoadon";
$water_data = getData($conn, $sql_water);
$total_water = $water_data[0]['total_water'];

// Lấy dữ liệu tổng số sinh viên
$sql_students = "SELECT COUNT(*) AS total_students FROM tbl_sinhvien";
$students_data = getData($conn, $sql_students);
$total_students = $students_data[0]['total_students'];

// Lấy dữ liệu tổng số sinh viên nam
$sql_boys = "SELECT COUNT(*) AS total_boys FROM tbl_sinhvien WHERE gioitinh = '0'";
$boys_data = getData($conn, $sql_boys);
$total_boys = $boys_data[0]['total_boys'];

// Lấy dữ liệu tổng số sinh viên nữ
$sql_girls = "SELECT COUNT(*) AS total_girls FROM tbl_sinhvien WHERE gioitinh = '1'";
$girls_data = getData($conn, $sql_girls);
$total_girls = $girls_data[0]['total_girls'];

// Lấy dữ liệu tổng số hóa đơn
$sql_bills = "SELECT COUNT(*) AS total_bills FROM tbl_hoadon";
$bills_data = getData($conn, $sql_bills);
$total_bills = $bills_data[0]['total_bills'];

// Lấy dữ liệu tổng số hợp đồng
$sql_contracts = "SELECT COUNT(*) AS total_contracts FROM tbl_hopdong";
$contracts_data = getData($conn, $sql_contracts);
$total_contracts = $contracts_data[0]['total_contracts'];

// Lấy dữ liệu tổng số tiền trong 6 tháng trở lại
$data = array();
for ($i = 0; $i < 6; $i++) {
    $month = date('m', strtotime("-$i months"));
    $year = date('Y', strtotime("-$i months")); 
    $sql = "SELECT
                MONTH(hd.NgayLapHD) AS Thang,
                YEAR(hd.NgayLapHD) AS Nam,
                SUM(hd.SoDien * hd.giadien + hd.SoNuoc * hd.gianuoc + IFNULL(hd.ChiPhiKhac, 0) + ph.GiaPhong) AS TongTien
            FROM
                tbl_hoadon hd
            JOIN
                tbl_phong ph ON hd.MaPhong = ph.MaPhong
            WHERE
                MONTH(hd.NgayLapHD) = $month AND YEAR(hd.NgayLapHD) = $year
            GROUP BY
                Thang, Nam";$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                'Thang' => $row['Thang'],
                'Nam' => $row['Nam'],
                'TongTien' => $row['TongTien']
            );
        }
    } else {
        $data[] = array(
            'Thang' => $month,
            'Nam' => $year,
            'TongTien' => 0
        );
    }
}

// lấy dữ liệu tiền điện tiền nước , phòng trong tháng 
$month = date('m');
$sql_cash = "WITH UniqueRooms AS (
    SELECT DISTINCT ph.MaPhong, ph.GiaPhong
    FROM tbl_hoadon hd
    JOIN tbl_phong ph ON hd.MaPhong = ph.MaPhong
    WHERE MONTH(hd.NgayLapHD) = $month
)
SELECT
    SUM(hd.SoDien * hd.giadien) AS Tiendien,
    SUM(hd.SoNuoc * hd.gianuoc) AS Tiennuoc,
    SUM(IFNULL(hd.ChiPhiKhac, 0)) AS cpkhac,
    (SELECT SUM(GiaPhong) FROM UniqueRooms) AS Tienphong
FROM
    tbl_hoadon hd
JOIN
    tbl_phong ph ON hd.MaPhong = ph.MaPhong
WHERE
    MONTH(hd.NgayLapHD) = $month


";
$cash_data = getData($conn, $sql_cash);
$cash_dien = $cash_data[0]['Tiendien'];
$cash_nuoc = $cash_data[0]['Tiennuoc'];
$cash_cpkhac = $cash_data[0]['cpkhac'];
$cash_phong = $cash_data[0]['Tienphong'];


// Đóng kết nối CSDL
$conn->close();

$data_summary = [
    'total_room' => $total_rooms,
    'total_staff' => $total_staff,
    'total_electric' => $total_electric,
    'total_water' => $total_water,
    'total_student' => $total_students,
    'total_boy' => $total_boys,
    'total_girl' => $total_girls,
    'total_bill' => $total_bills,
    'total_contract' => $total_contracts,
    'month_data' => $data, 
    'cash_dien' => $cash_dien,
    'cash_nuoc' => $cash_nuoc,
    'cash_cpkhac'=> $cash_cpkhac,
    'cash_phong'=> $cash_phong,
];

echo json_encode($data_summary);
?>
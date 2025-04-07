-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2024 at 11:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ktx`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `ID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `ChucVu` int(11) NOT NULL DEFAULT 1 COMMENT '0 = quanly \r\n1 = sinh vien',
  `DateTime` datetime NOT NULL,
  `online` int(11) NOT NULL DEFAULT 0 COMMENT '0 = offline\r\n1 = online',
  `log` varchar(2000) NOT NULL COMMENT 'ghi lại sự kiện đăng nhập đăng xuất đổi mật khẩu vv '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`ID`, `username`, `password`, `ChucVu`, `DateTime`, `online`, `log`) VALUES
(1, 'admin', 'admin123', 2, '2024-07-08 16:20:05', 0, ''),
(49, 'anhtuan', 'anhtuan12', 1, '0000-00-00 00:00:00', 0, ''),
(22, 'buitam121', 'buithitam0908', 1, '0000-00-00 00:00:00', 0, ''),
(6, 'chaugiang', 'chaugiang', 0, '0000-00-00 00:00:00', 0, ''),
(12, 'dinhbinh', 'daobinh11', 1, '0000-00-00 00:00:00', 0, ''),
(38, 'dinhnam', 'dinhanm123', 1, '0000-00-00 00:00:00', 0, ''),
(28, 'ducnam', 'ducnam123', 1, '0000-00-00 00:00:00', 0, ''),
(3, 'ductoan', 'ductoan03', 0, '0000-00-00 00:00:00', 0, ''),
(19, 'duydatkkk', 'daoduydat', 1, '0000-00-00 00:00:00', 0, ''),
(40, 'haoquang', 'haoquang', 1, '0000-00-00 00:00:00', 0, ''),
(42, 'hoaianh', 'hoaianh123', 1, '0000-00-00 00:00:00', 0, ''),
(46, 'hoaithanh', 'hoaithanh', 1, '0000-00-00 00:00:00', 0, ''),
(50, 'honghanh', 'honghanh', 1, '0000-00-00 00:00:00', 0, ''),
(2, 'hongmai', 'hongmai04', 0, '0000-00-00 00:00:00', 0, ''),
(8, 'hongnhung', 'hongnhung', 1, '0000-00-00 00:00:00', 0, ''),
(30, 'huuhai', 'huuhai123', 1, '0000-00-00 00:00:00', 0, ''),
(23, 'huyenmy', 'huyenthuy', 1, '0000-00-00 00:00:00', 0, ''),
(5, 'khanhhuyen', 'khanhhuyen', 0, '0000-00-00 00:00:00', 0, ''),
(36, 'kimgiap', 'kimgiap12', 1, '0000-00-00 00:00:00', 0, ''),
(33, 'kimsang', 'kimsang12', 1, '0000-00-00 00:00:00', 0, ''),
(55, 'ledung', 'ledung12', 1, '0000-00-00 00:00:00', 0, ''),
(54, 'lethanh', 'lethanh12', 1, '0000-00-00 00:00:00', 0, ''),
(37, 'lethina', 'lena1234', 1, '0000-00-00 00:00:00', 0, ''),
(56, 'maianh', 'maianh123', 1, '0000-00-00 00:00:00', 0, ''),
(21, 'maianh123', 'maianh111', 1, '0000-00-00 00:00:00', 0, ''),
(41, 'maingoan', 'maingaon', 1, '0000-00-00 00:00:00', 0, ''),
(58, 'manhchien', 'manhchien', 1, '2024-07-09 04:22:29', 0, ''),
(43, 'manhdung', 'manhdung', 1, '0000-00-00 00:00:00', 0, ''),
(45, 'manhhung', 'manhhung', 1, '0000-00-00 00:00:00', 0, ''),
(25, 'ngocha22', 'tranngocha', 1, '0000-00-00 00:00:00', 0, ''),
(57, 'ngocmai11', 'homaingoc', 1, '0000-00-00 00:00:00', 0, ''),
(39, 'nguyetque', 'nguyetque', 1, '0000-00-00 00:00:00', 0, ''),
(53, 'quanghung', 'quanghung', 1, '0000-00-00 00:00:00', 0, ''),
(14, 'quangngan', 'quangngan', 1, '0000-00-00 00:00:00', 0, ''),
(34, 'quangvu', 'quangvu12', 1, '0000-00-00 00:00:00', 0, ''),
(13, 'quoccuong', 'cuong1429', 1, '0000-00-00 00:00:00', 0, ''),
(32, 'thanhlam', 'thanhlam12', 1, '0000-00-00 00:00:00', 0, ''),
(29, 'thanhnga', 'thanhnga', 1, '0000-00-00 00:00:00', 0, ''),
(48, 'thanhnha', 'thanhnha', 1, '0000-00-00 00:00:00', 0, ''),
(51, 'thanhphong', 'thanhphong', 1, '0000-00-00 00:00:00', 0, ''),
(10, 'thanhphuong', 'thanhphuong', 1, '0000-00-00 00:00:00', 0, ''),
(44, 'thanhtruc', 'thanhtruc', 1, '0000-00-00 00:00:00', 0, ''),
(35, 'thihoa', 'thihoa123', 1, '0000-00-00 00:00:00', 0, ''),
(26, 'thilinh', 'thilinh123', 1, '0000-00-00 00:00:00', 0, ''),
(9, 'thuylinh', 'lethuylinh', 1, '0000-00-00 00:00:00', 0, ''),
(7, 'thuytien', 'thuytien01', 1, '0000-00-00 00:00:00', 0, ''),
(18, 'tiendat11', 'datphamjtien', 1, '0000-00-00 00:00:00', 0, ''),
(24, 'tranglinh', 'linh12244', 1, '0000-00-00 00:00:00', 0, ''),
(31, 'tranvytam', 'vytam123', 1, '0000-00-00 00:00:00', 0, ''),
(16, 'trongphuc', 'phuc2004@', 1, '0000-00-00 00:00:00', 0, ''),
(17, 'tuanduy', 'duynguyen', 1, '0000-00-00 00:00:00', 0, ''),
(47, 'tuanhung', 'tuanhung', 1, '0000-00-00 00:00:00', 0, ''),
(27, 'vantam', 'vantam123', 1, '0000-00-00 00:00:00', 0, ''),
(15, 'viethoang', 'hoangnguyen', 1, '0000-00-00 00:00:00', 0, ''),
(4, 'viettung', 'viettung04', 0, '0000-00-00 00:00:00', 0, ''),
(20, 'xuansang', 'sang11111', 1, '0000-00-00 00:00:00', 0, ''),
(11, 'yenvy1204', 'phamyenvy', 1, '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat`
--

CREATE TABLE `tbl_chat` (
  `mess_id` int(11) NOT NULL,
  `user_send` varchar(20) NOT NULL,
  `user_get` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_chat`
--

INSERT INTO `tbl_chat` (`mess_id`, `user_send`, `user_get`) VALUES
(1, 'thuytien', 'hongmai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hoadon`
--

CREATE TABLE `tbl_hoadon` (
  `STT` int(11) NOT NULL,
  `MaHD` varchar(11) NOT NULL,
  `SoDien` int(11) NOT NULL,
  `GiaDien` int(11) NOT NULL,
  `SoNuoc` int(11) NOT NULL,
  `GiaNuoc` int(11) NOT NULL,
  `GiaPhong` int(11) NOT NULL,
  `ChiPhiKhac` int(11) DEFAULT NULL,
  `NgayLapHD` date NOT NULL,
  `MaPhong` varchar(20) NOT NULL,
  `MaNV` varchar(20) NOT NULL COMMENT 'mã người lập là mã nhân viên'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hoadon`
--

INSERT INTO `tbl_hoadon` (`STT`, `MaHD`, `SoDien`, `GiaDien`, `SoNuoc`, `GiaNuoc`, `GiaPhong`, `ChiPhiKhac`, `NgayLapHD`, `MaPhong`, `MaNV`) VALUES
(1, 'HD01', 400, 3500, 8, 25000, 2000000, 150000, '2024-07-08', 'P001', 'NV01'),
(2, 'HD02', 300, 3500, 5, 20000, 3000000, 150000, '2024-07-08', 'P005', 'NV01'),
(3, 'HD03', 250, 3500, 4, 25000, 2800000, 100000, '2024-07-08', 'P010', 'NV01'),
(4, 'HD04', 400, 3500, 6, 25000, 3000000, 150000, '2024-07-08', 'P008', 'NV03'),
(5, 'HD05', 453, 3500, 5, 25000, 3000000, 100000, '2024-07-08', 'P006', 'NV03'),
(6, 'HD06', 436, 3500, 4, 25000, 3000000, 200000, '2024-07-08', 'P006', 'NV04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hopdong`
--

CREATE TABLE `tbl_hopdong` (
  `STT` int(11) NOT NULL,
  `MaHD` varchar(50) NOT NULL,
  `MaPhong` varchar(20) NOT NULL,
  `NgayBD` date NOT NULL,
  `NgayKT` date NOT NULL,
  `MaSV` varchar(20) NOT NULL,
  `MaNV` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hopdong`
--

INSERT INTO `tbl_hopdong` (`STT`, `MaHD`, `MaPhong`, `NgayBD`, `NgayKT`, `MaSV`, `MaNV`) VALUES
(1, 'HD01', 'P002', '2023-01-01', '2025-01-01', '73DCTT09273', 'NV01'),
(2, 'HD02', 'P002', '2023-12-09', '2024-12-09', '73DCTT09732', 'NV01'),
(3, 'HD03', 'P009', '2023-12-09', '2024-12-09', '73DCTT11132', 'NV02'),
(4, 'HD04', 'P002', '2022-09-11', '2024-09-11', '73DCTT12344', 'NV02'),
(5, 'HD05', 'P001', '2021-11-02', '2025-11-02', '73DCTT22201', 'NV02'),
(6, 'HD06', 'P001', '2023-09-11', '2024-09-11', '73DCTT22212', 'NV03'),
(7, 'HD07', 'P001', '2022-10-10', '2024-10-10', '73DCTT23245', 'NV03'),
(8, 'HD08', 'P002', '2022-11-23', '2024-11-23', '73DCTT24342', 'NV04'),
(9, 'HD09', 'P004', '2021-10-22', '2024-10-22', '73DCTT24532', 'NV04');

--
-- Triggers `tbl_hopdong`
--
DELIMITER $$
CREATE TRIGGER `updat_room_count` AFTER INSERT ON `tbl_hopdong` FOR EACH ROW BEGIN
    DECLARE room_count INT;

    -- Lấy số lượng hiện tại của phòng
    SELECT COUNT(*) INTO room_count FROM tbl_hopdong WHERE MaPhong = NEW.MaPhong;

    -- Cập nhật số lượng mới của phòng
    UPDATE tbl_phong
    SET SoLuong = room_count
    WHERE MaPhong = NEW.MaPhong;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_room_count` AFTER INSERT ON `tbl_hopdong` FOR EACH ROW BEGIN
    DECLARE room_count INT;

    -- Lấy số lượng hiện tại của phòng
    SELECT COUNT(*) INTO room_count FROM tbl_hopdong WHERE MaPhong = NEW.MaPhong;

    -- Cập nhật số lượng mới của phòng
    UPDATE tbl_phong
    SET SoLuong = room_count
    WHERE MaPhong = NEW.MaPhong;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `mess_id` int(11) NOT NULL,
  `user_send` varchar(20) NOT NULL,
  `messages` varchar(16000) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`mess_id`, `user_send`, `messages`, `time`) VALUES
(64, 'hongmai123', 'hello', '2024-06-24 00:56:10'),
(2, 'admin', 'test code chat lần 1', '2024-07-08 17:09:01'),
(3, 'admin', 'check chat lần 2', '2024-07-08 17:11:56'),
(1, 'thuytien', 'sinh viên check chat', '2024-07-09 10:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nhanvien`
--

CREATE TABLE `tbl_nhanvien` (
  `STT` int(11) NOT NULL,
  `MaNV` varchar(20) NOT NULL,
  `TenNV` varchar(30) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `GioiTinh` int(11) NOT NULL COMMENT '0 : Nam \r\n1 : Nữ',
  `Phone` varchar(12) DEFAULT NULL,
  `CCCD` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ImageCCCDFront` varchar(255) DEFAULT NULL,
  `ImageCCCDBack` varchar(255) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT 0 COMMENT '0 = Chưa được duyệt\r\n1 = Đã được duyệt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_nhanvien`
--

INSERT INTO `tbl_nhanvien` (`STT`, `MaNV`, `TenNV`, `Username`, `GioiTinh`, `Phone`, `CCCD`, `ImageCCCDFront`, `ImageCCCDBack`, `DiaChi`, `Image`, `TrangThai`) VALUES
(1, 'NV01', 'Admin', 'admin', 1, '0862453665', '010203040506', 'cccd_mat1.png', 'cccd_mat2.webp', 'Hà Nội', 'admin.jpg', 1),
(2, 'NV02', 'Nguyễn Hồng Mai', 'hongmai', 1, '0862453667', '000007322251', 'the_mai11.jpg', 'the_sau.jpg', 'Hà Nội', 'the_mai.jpg', 1),
(3, 'NV03', 'Nông Đức Toàn ', 'ductoan', 0, '0348438004', '000007323253', 'ql_toan.jpg', 'the_sau.jpg', 'Tuyên Quang', 'ql_toan1.jpg', 1),
(4, 'NV04', 'Nguyễn Việt Tùng', 'viettung', 0, '0348349754', '000007322187', 'ql_tung.jpg', 'the_sau.jpg', 'Hà Nội', 'tung.jpg', 1),
(5, 'NV05', 'Nguyễn Thị Khánh Huyền ', 'khanhhuyen', 1, '0336528150', '000007322449', 'ql_huyen.jpg', 'ql-huyen.jpg', 'Thanh Hóa', 'ql_huyenn.jpg', 1),
(6, 'NV06', 'Phạm Thị Châu Giang', 'chaugiang', 1, '0838662004', '000003722238', 'ql-giang.jpg', 'ql_giang_.jpg', 'Hà Nội', 'ql_giangg.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phong`
--

CREATE TABLE `tbl_phong` (
  `Stt` int(11) NOT NULL,
  `MaPhong` varchar(20) NOT NULL,
  `TenPhong` varchar(50) NOT NULL,
  `LoaiPhong` int(11) DEFAULT NULL COMMENT '0:nam \r\n1:nữ',
  `GiaPhong` int(11) DEFAULT 0,
  `MoTa` varchar(2000) DEFAULT 'Không có mô tả ',
  `SoLuong` int(11) DEFAULT 8 COMMENT ' măc định là 8 người ',
  `SoSV` int(11) DEFAULT 0 COMMENT 'là số lượng sinh viên đang ở '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_phong`
--

INSERT INTO `tbl_phong` (`Stt`, `MaPhong`, `TenPhong`, `LoaiPhong`, `GiaPhong`, `MoTa`, `SoLuong`, `SoSV`) VALUES
(1, 'P001', 'Phòng 1', 1, 2000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 8, 7),
(2, 'P002', 'Phòng 2', 0, 2000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 8, 8),
(3, 'P003', 'Phòng 3', 0, 2000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 8, 4),
(4, 'P004', 'Phòng 4', 1, 2000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 8, 7),
(5, 'P005', 'Phòng 5', 1, 3000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 6, 0),
(6, 'P006', 'Phòng 6', 0, 3000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 6, 5),
(7, 'P007', 'Phòng 7 ', 0, 3000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 6, 2),
(8, 'P008', 'Phòng 8', 1, 3000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 6, 4),
(9, 'P009', 'Phòng 9', 0, 2800000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 6, 3),
(10, 'P010', 'Phòng 10 ', 0, 2800000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 4, 4),
(11, 'P011', 'Phòng 11', 1, 2800000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 4, 4),
(12, 'P012', 'Phòng 12', 1, 2800000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 4, 1),
(13, 'P013', 'Phòng 13', 0, 2000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 8, 1),
(14, 'P014', 'Phòng 14', 1, 2800000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 4, 0),
(15, 'P015', 'Phòng 15', 0, 3000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 6, 0),
(16, 'P016', 'Phòng 16', 0, 3000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 6, 0),
(17, 'P017', 'Phòng 17', 1, 2800000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 4, 0),
(18, 'P018', 'Phòng 18', 1, 3000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 6, 0),
(19, 'P019', 'Phòng 19', 1, 3000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 6, 0),
(20, 'P020', 'Phòng 20', 0, 3000000, 'Tiện nghi: quạt, wifi, điều hòa, máy giặt.', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sinhvien`
--

CREATE TABLE `tbl_sinhvien` (
  `STT` int(11) NOT NULL,
  `MaSV` varchar(30) NOT NULL,
  `MaPhong` varchar(20) NOT NULL,
  `Username` varchar(20) DEFAULT NULL,
  `TenSV` varchar(30) DEFAULT NULL,
  `Phone` varchar(12) DEFAULT NULL,
  `CCCD` varchar(16) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `Class` varchar(30) DEFAULT 'Chưa nhập thông tin ',
  `GioiTinh` int(11) DEFAULT NULL,
  `Image` varchar(200) DEFAULT NULL,
  `ImageCCCDFront` varchar(255) DEFAULT NULL,
  `ImageCCCDBack` varchar(255) DEFAULT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT 0 COMMENT '0 = Chưa được duyệt\r\n1 = Đã được duyệt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sinhvien`
--

INSERT INTO `tbl_sinhvien` (`STT`, `MaSV`, `MaPhong`, `Username`, `TenSV`, `Phone`, `CCCD`, `DiaChi`, `Class`, `GioiTinh`, `Image`, `ImageCCCDFront`, `ImageCCCDBack`, `TrangThai`) VALUES
(20, '72DCTT22201', 'P011', 'thilinh', 'Hồ Thị Linh', '0336528178', '483975487345', 'Hà Nội', '72DCTT21', 1, 'sv11_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(21, '72DCTT22202', 'P013', 'vantam', 'Trần Văn Tâm', '0357657888', '068724680123', 'Vĩnh Phúc', '72DCTN23', 0, 'sv11_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(22, '72DCTT22203', 'P007', 'ducnam', 'Nguyễn Đức Nam', '0357698238', '089124567843', 'Khánh Hòa', '72DCTT23', 0, 'sv12_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(23, '72DCTT22205', 'P004', 'thanhnga', 'Trần Thanh Nga', '0783562578', '083855772287', 'Thanh Hóa', '72DCTT21', 1, 'sv12_nu.png', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(47, '73DCHT22657', 'P009', 'quanghung', 'Lê Quang Hùng', '0946578567', '098834568765', 'Nghệ An', '73DCHT21', 0, 'sv25_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(41, '73DCOT22345', 'P010', 'tuanhung', 'Trần Tuấn Hưng', '0336898678', '098763481233', 'Yên Bái', '73DCOT21', 0, 'sv22_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(45, '73DCOT23569', 'P006', 'thanhphong', 'Nguyễn Thanh Phong', '0996744588', '098674433221', 'Hà Nội', '73DCOT26', 0, 'sv24_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(42, '73DCQT22678', 'P004', 'thanhnha', 'Mai Thanh Nhã ', '0996844563', '098354454768', 'Hà Nội', '73DCQT24', 1, 'sv22_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(50, '73DCTN22566', 'P011', 'maianh', 'Lại Mai Anh', '0998044563', '089992243561', 'Hà Nội', '73DCTT25', 1, 'sv26_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(44, '73DCTN22775', 'P011', 'honghanh', 'Lê Hồng Hạnh', '0644236534', '057835442477', 'Nghệ An', '73DCTN25', 1, 'sv23_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(49, '73DCTN23567', 'P008', 'ledung', 'Lê Thị Dung', '0981563245', '098455222331', 'Hải Dương', '73DCTN22', 1, 'sv24_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(38, '73DCTN23656', 'P004', 'thanhtruc', 'Lê Thanh Trúc', '0979563245', '099883355762', 'Hải Dương', '73DCTN21', 1, 'sv20_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(48, '73DCTN23946', 'P004', 'lethanh', 'Lê Thị Thanh', '0553487123', '096745623534', 'Hà Tĩnh', '73DCTN24', 1, 'sv25_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(6, '73DCTT09273', 'P003', 'dinhbinh', 'Đào Đình Bình', '0982456777', '003837218172', 'Quảng Ninh', '', 0, 'sv1_nam.jpeg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(12, '73DCTT09732', 'P003', 'tiendat11', 'Phạm Tiến Đạt', '0562453011', '000234532132', 'Hải Phòng', '', 0, 'sv8_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(14, '73DCTT11132', 'P009', 'xuansang', 'Nguyễn Xuân Sang', '0877453564', '008766788991', 'Hà Nội', '', 0, 'sv10_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(10, '73DCTT12344', 'P002', 'trongphuc', 'Nguyễn Trọng Phúc', '0862453600', '000344555666', 'Hà Nội', '', 0, 'sv6_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(11, '73DCTT22112', 'P002', 'tuanduy', 'Nguyễn Tuấn Duy ', '0862453987', '000344555111', 'Phúc Thọ', '', 0, 'sv7_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(1, '73DCTT22201', 'P001', 'thuytien', 'Khuất Thị Thùy Tiên', '0862453001', '010203040507', 'Hà Nam', '', 1, 'sv1_nu.jpeg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(29, '73DCTT22206', 'P008', 'thihoa', 'Hoàng Thị Hoa', '0996744511', '046524457689', 'Hà Nội', '73DCTT23', 1, 'sv15_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(28, '73DCTT22207', 'P003', 'quangvu', 'Lê Quang Vũ', '0996744563', '078787452345', 'Hà Nội', '73DCTT22', 0, 'sv15_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(27, '73DCTT22208', 'P010', 'kimsang', 'Nguyễn Kim Sáng', '0373223467', '098564442238', 'Thanh Hóa', '73DCTT24', 0, 'sv14-nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(25, '73DCTT22209', 'P001', 'tranvytam', 'Trần Vy Tâm', '0111763498', '045728889444', 'Thái Bình', '73DCTT21', 1, 'sv13_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(2, '73DCTT22212', 'P001', 'hongnhung', 'Trần Hồng Nhung', '0862453661', '090807060504', 'Hải Phòng', '', 1, 'sv2_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(26, '73DCTT22222', 'P011', 'thanhlam', 'Lê Thanh Lam', '0989563245', '086423112233', 'Hải Dương', '73DCTT23', 1, 'sv14_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(36, '73DCTT22657', 'P006', 'hoaianh', 'Hồ Hoài Anh', '0556528769', '077561246756', 'Thái Bình', '73DCTT26', 0, 'sv19_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(30, '73DCTT22675', 'P010', 'kimgiap', 'Nguyễn Kim Giáp', '0336556734', '057834975611', 'Nam Định', '73DCTT26', 0, 'sv16_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(24, '73DCTT22999', 'P002', 'huuhai', 'Lê Hữu Hai', '0876246893', '864567897867', 'Nam Định', '72DCTT25', 0, 'sv13_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(51, '73DCTT23111', 'P006', 'ngocmai11', 'Nguyễn Ngọc Minh', '0812353162', '034733785992', 'Quảng Ninh', '', 0, 'anh46.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(3, '73DCTT23245', 'P001', 'thuylinh', 'Lê Thị Thùy Linh', '0862453660', '090807060505', 'Th', '', 1, 'sv3_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(32, '73DCTT23444', 'P007', 'dinhnam', 'Vũ Đình Nam', '0946678567', '098765432255', 'Lạng Sơn', '73DCTT22', 0, 'sv17_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(33, '73DCTT23777', 'P008', 'nguyetque', 'Trần Nguyệt Quế', '0946688567', '098766432255', 'Lạng Sơn', '73DCTT22', 1, 'sv17_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(34, '73DCTT23888', 'P010', 'haoquang', 'Đỗ Hào Quang', '0336528769', '087561246756', 'Hà Nội', '73DCTT25', 0, 'sv18_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(43, '73DCTT23945', 'P003', 'anhtuan', 'Lê Anh Tuấn', '0698236534', '057835612477', 'Nghệ An', '73DCTT25', 0, 'sv23_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(37, '73DCTT23978', 'P002', 'manhdung', 'Đỗ Mạnh Dũng', '0989563244', '098347245777', 'Hà Nội', '73DCTT24', 0, 'sv20_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(35, '73DCTT23999', 'P004', 'maingoan', 'Mai Thị Ngoan', '0446528769', '067561246756', 'Hà Nội', '73DCTT26', 1, 'sv18_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(13, '73DCTT24342', 'P002', 'duydatkkk', 'Đào Duy Đạt ', '0765777222', '000234532181', 'Hải Phòng', '', 0, 'sv9_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(4, '73DCTT24532', 'P004', 'thanhphuong', 'Đào Thanh Phương', '0862453612', '080706050403', 'Quảng Ninh', '', 1, 'sv4_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(31, '73DCTT24569', 'P011', 'lethina', 'Lê Thị Na', '0336556735', '057834975622', 'Nam Định', '73DCTT26', 1, 'sv16_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(39, '73DCTT25467', 'P006', 'manhhung', 'Lê Mạnh Hùng', '0556528178', '057388991123', 'Nam Định', '73DCTT25', 0, 'sv21_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(52, '73DCTT26160', 'P009', 'manhchien', 'Nguyễn Mạnh Chiến', '0982323242', '039487263748', 'Hà Nội', 'Chưa nhập thông tin ', 0, 'anh52.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(17, '73DCTT27121', 'P001', 'huyenmy', 'Nguyễn Huyền My', '0877253162', '033766784991', 'Hà Nam', '', 1, 'sv8_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(18, '73DCTT28176', 'P001', 'tranglinh', 'Nguyễn Thùy Linh ', '0817253162', '034766784992', 'Quảng Ninh', '', 1, 'sv9_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(40, '73DCTT34568', 'P008', 'hoaithanh', 'Lê Hoài Thanh', '0556744563', '098455662314', 'Hà Nội', '73DCTT24', 1, 'sv21_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(7, '73DCTT35772', 'P002', 'quoccuong', 'Nguyễn Bá Quốc Cường', '0862456331', '090204030103', 'Nghệ An', '', 0, 'sv1_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(19, '73DCTT45362', 'P001', 'ngocha22', 'Trần Ngọc Hà', '0813353162', '034733784992', 'Quảng Ninh', '', 1, 'sv10_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(8, '73DCTT48372', 'P002', 'quangngan', 'Vũ Quang Ngạn', '0562456331', '090244030103', 'Thái Bình', '', 0, 'sv3_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(5, '73DCTT54555', 'P004', 'yenvy1204', 'Phạm Nguyễn Yến Vy', '0862453611', '080706050404', 'Nghệ An', '', 1, 'sv5_nu.png', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(16, '73DCTT54655', 'P012', 'buitam121', 'Bùi Thị Tâm', '0877453162', '033766785991', 'Hà Nội', '', 1, 'sv7_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(9, '73DCTT56443', 'P002', 'viethoang', 'Nguyễn Thế Việt Hoàng', '0862453699', '010293827371', 'Hà Nội', '', 0, 'sv4_nam.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1),
(15, '74DCTT23521', 'P012', 'maianh123', 'Phạm Mai Anh', '0877453562', '008766785991', 'Hà Nội', '', 1, 'sv6_nu.jpg', 'cccd_mat1.png', 'cccd_mat2.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thongbao`
--

CREATE TABLE `tbl_thongbao` (
  `STT` int(11) NOT NULL,
  `MaTB` varchar(20) NOT NULL,
  `TieuDe` varchar(180) NOT NULL,
  `NoiDung` varchar(2550) NOT NULL,
  `Ngay_tao` date NOT NULL,
  `MaNV` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_thongbao`
--

INSERT INTO `tbl_thongbao` (`STT`, `MaTB`, `TieuDe`, `NoiDung`, `Ngay_tao`, `MaNV`) VALUES
(1, 'TB01', 'Thanh tra', 'BQL sẽ tiến hành kiểm tra phòng vào ngày 15/8/2024.', '2024-07-08', 'NV01'),
(2, 'TB02', 'Vệ sinh', 'Đề nghị sinh viên các phòng ở tập hợp rác vào thứ 2 và thứ 5 hàng tuần.', '2024-07-08', 'NV01'),
(3, 'TB03', 'Đóng tiền', 'Các trưởng phòng tập hợp tiền phòng nộp cho Phòng công tác sinh viên vào ngày 20 - 24 hàng tháng.', '2024-07-08', 'NV01'),
(4, 'TB04', 'Tu sửa phòng ', 'Ngày 15 sẽ tiến hành sửa phòng. Đề nghị có ít nhất 1 sinh viên ở phòng.', '2024-07-08', 'NV02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vande`
--

CREATE TABLE `tbl_vande` (
  `STT` int(11) NOT NULL,
  `MaVD` varchar(20) NOT NULL,
  `TieuDe` varchar(180) NOT NULL,
  `NoiDung` varchar(2550) NOT NULL,
  `MaSV` varchar(20) NOT NULL,
  `MaNV` varchar(20) NOT NULL,
  `Ngay_tao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_vande`
--

INSERT INTO `tbl_vande` (`STT`, `MaVD`, `TieuDe`, `NoiDung`, `MaSV`, `MaNV`, `Ngay_tao`) VALUES
(1, 'KN01', 'Sửa chữa', 'BQL xem lại giúp em đồng hồ nước phòng 101 với ạ', '73DCTT22201', 'NV02', '2024-07-08 00:00:00'),
(2, 'KN02', 'Giờ giấc', 'Trường có thể đóng cửa muộn hơn không ạ', '73DCTN23567', 'NV03', '2024-07-09 02:44:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `ID` (`ID`) USING BTREE;

--
-- Indexes for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  ADD PRIMARY KEY (`mess_id`);

--
-- Indexes for table `tbl_hoadon`
--
ALTER TABLE `tbl_hoadon`
  ADD PRIMARY KEY (`MaHD`),
  ADD KEY `STT` (`STT`),
  ADD KEY `MaPhong` (`MaPhong`) USING BTREE,
  ADD KEY `MaNV` (`MaNV`) USING BTREE;

--
-- Indexes for table `tbl_hopdong`
--
ALTER TABLE `tbl_hopdong`
  ADD PRIMARY KEY (`MaHD`),
  ADD UNIQUE KEY `STT` (`STT`) USING BTREE,
  ADD KEY `MaNV` (`MaNV`),
  ADD KEY `MaPhong` (`MaPhong`) USING BTREE,
  ADD KEY `MaSV` (`MaSV`);

--
-- Indexes for table `tbl_nhanvien`
--
ALTER TABLE `tbl_nhanvien`
  ADD PRIMARY KEY (`MaNV`),
  ADD UNIQUE KEY `STT` (`STT`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Phone` (`Phone`,`CCCD`),
  ADD UNIQUE KEY `Phone_3` (`Phone`,`CCCD`),
  ADD KEY `Phone_2` (`Phone`,`CCCD`);

--
-- Indexes for table `tbl_phong`
--
ALTER TABLE `tbl_phong`
  ADD PRIMARY KEY (`MaPhong`),
  ADD UNIQUE KEY `Stt` (`Stt`) USING BTREE;

--
-- Indexes for table `tbl_sinhvien`
--
ALTER TABLE `tbl_sinhvien`
  ADD PRIMARY KEY (`MaSV`) USING BTREE,
  ADD UNIQUE KEY `username` (`Username`) USING BTREE,
  ADD UNIQUE KEY `Phone` (`Phone`,`CCCD`),
  ADD UNIQUE KEY `Phone_2` (`Phone`,`CCCD`),
  ADD KEY `MaPhong` (`MaPhong`) USING BTREE,
  ADD KEY `STT` (`STT`);

--
-- Indexes for table `tbl_thongbao`
--
ALTER TABLE `tbl_thongbao`
  ADD PRIMARY KEY (`MaTB`),
  ADD UNIQUE KEY `STT` (`STT`),
  ADD KEY `MaNV` (`MaNV`) USING BTREE;

--
-- Indexes for table `tbl_vande`
--
ALTER TABLE `tbl_vande`
  ADD PRIMARY KEY (`MaVD`),
  ADD UNIQUE KEY `STT` (`STT`,`MaSV`,`MaNV`),
  ADD KEY `MaNV` (`MaNV`),
  ADD KEY `MaSV` (`MaSV`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  MODIFY `mess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_hoadon`
--
ALTER TABLE `tbl_hoadon`
  MODIFY `STT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_hopdong`
--
ALTER TABLE `tbl_hopdong`
  MODIFY `STT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_nhanvien`
--
ALTER TABLE `tbl_nhanvien`
  MODIFY `STT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_phong`
--
ALTER TABLE `tbl_phong`
  MODIFY `Stt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_sinhvien`
--
ALTER TABLE `tbl_sinhvien`
  MODIFY `STT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_thongbao`
--
ALTER TABLE `tbl_thongbao`
  MODIFY `STT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_vande`
--
ALTER TABLE `tbl_vande`
  MODIFY `STT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_hoadon`
--
ALTER TABLE `tbl_hoadon`
  ADD CONSTRAINT `tbl_hoadon_ibfk_1` FOREIGN KEY (`MaNV`) REFERENCES `tbl_nhanvien` (`MaNV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_hoadon_ibfk_3` FOREIGN KEY (`MaPhong`) REFERENCES `tbl_phong` (`MaPhong`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_hopdong`
--
ALTER TABLE `tbl_hopdong`
  ADD CONSTRAINT `tbl_hopdong_ibfk_1` FOREIGN KEY (`MaNV`) REFERENCES `tbl_nhanvien` (`MaNV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_hopdong_ibfk_2` FOREIGN KEY (`MaSV`) REFERENCES `tbl_sinhvien` (`MaSV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_hopdong_ibfk_3` FOREIGN KEY (`MaPhong`) REFERENCES `tbl_phong` (`MaPhong`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_nhanvien`
--
ALTER TABLE `tbl_nhanvien`
  ADD CONSTRAINT `tbl_nhanvien_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `tbl_account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sinhvien`
--
ALTER TABLE `tbl_sinhvien`
  ADD CONSTRAINT `tbl_SinhVien_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `tbl_account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_SinhVien_ibfk_2` FOREIGN KEY (`MaPhong`) REFERENCES `tbl_phong` (`MaPhong`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_thongbao`
--
ALTER TABLE `tbl_thongbao`
  ADD CONSTRAINT `tbl_ThongBao_ibfk_1` FOREIGN KEY (`MaNV`) REFERENCES `tbl_nhanvien` (`MaNV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_vande`
--
ALTER TABLE `tbl_vande`
  ADD CONSTRAINT `tbl_vande_ibfk_1` FOREIGN KEY (`MaNV`) REFERENCES `tbl_nhanvien` (`MaNV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_vande_ibfk_2` FOREIGN KEY (`MaSV`) REFERENCES `tbl_sinhvien` (`MaSV`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

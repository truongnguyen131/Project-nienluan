-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 08, 2023 lúc 09:54 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nienluan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `anhgameplay`
--

CREATE TABLE `anhgameplay` (
  `agl_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `agl_ten` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `anhgameplay`
--

INSERT INTO `anhgameplay` (`agl_id`, `sp_id`, `agl_ten`) VALUES
(27, 30, 'zyro-image (1).png'),
(28, 30, 'zyro-image.png'),
(35, 34, '10IMG_1061.jpg'),
(36, 34, '284862376_5216102855147735_3149357939424922939_n.jpg'),
(37, 35, '10IMG_1061.jpg'),
(38, 35, '284862376_5216102855147735_3149357939424922939_n.jpg'),
(41, 37, 'Untitled.png'),
(42, 37, 'TOKYO-GHOUL-GAME.jpeg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `dh_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `ctdh_soluong` int(11) NOT NULL,
  `ctdh_tongtien` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`dh_id`, `sp_id`, `ctdh_soluong`, `ctdh_tongtien`) VALUES
(9, 30, 1, 200000),
(9, 34, 1, 300000),
(9, 35, 2, 1200000),
(10, 30, 1, 200000),
(10, 35, 1, 600000),
(10, 40, 1, 12312400),
(11, 48, 2, 24624800),
(12, 35, 2, 1200000),
(14, 30, 2, 400000),
(14, 35, 1, 600000),
(15, 48, 1, 12312400),
(16, 35, 1, 600000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia`
--

CREATE TABLE `danhgia` (
  `kh_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `dg_sao` float NOT NULL,
  `dg_cmt` varchar(500) NOT NULL,
  `dg_ngaydanhgia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `dh_id` int(11) NOT NULL,
  `dh_ngaylap` date NOT NULL,
  `kh_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`dh_id`, `dh_ngaylap`, `kh_id`) VALUES
(9, '2023-04-07', 12),
(10, '2023-04-08', 12),
(11, '2023-04-08', 12),
(12, '2023-04-08', 12),
(14, '2023-04-08', 12),
(15, '2023-04-08', 12),
(16, '2023-04-08', 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giamgia`
--

CREATE TABLE `giamgia` (
  `gg_id` int(11) NOT NULL,
  `gg_phantram` int(11) NOT NULL,
  `gg_ngaybatdau` date NOT NULL,
  `gg_ngayketthuc` date NOT NULL,
  `tl_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `kh_id` int(11) NOT NULL,
  `kh_hoten` varchar(100) NOT NULL,
  `kh_sdt` int(11) NOT NULL,
  `kh_email` varchar(50) NOT NULL,
  `kh_diemtichluy` float NOT NULL,
  `tk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`kh_id`, `kh_hoten`, `kh_sdt`, `kh_email`, `kh_diemtichluy`, `tk_id`) VALUES
(12, 'Truong Minh Tri', 938542421, '0', 0, 23);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nsx`
--

CREATE TABLE `nsx` (
  `nsx_id` int(11) NOT NULL,
  `nsx_ten` varchar(50) NOT NULL,
  `nsx_sdt` int(11) NOT NULL,
  `nsx_email` varchar(100) NOT NULL,
  `tk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nsx`
--

INSERT INTO `nsx` (`nsx_id`, `nsx_ten`, `nsx_sdt`, `nsx_email`, `tk_id`) VALUES
(1, 'admin', 0, '', 1),
(2, 'VNG', 2147483647, 'vnggame@gmail.com.vn', 24),
(3, 'admin1', 0, '', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `sp_id` int(11) NOT NULL,
  `sp_tengame` varchar(150) NOT NULL,
  `sp_imgavt` varchar(200) NOT NULL,
  `sp_file` varchar(3000) NOT NULL,
  `sp_mota` varchar(5000) NOT NULL,
  `sp_trailer` varchar(500) NOT NULL,
  `sp_gia` int(100) NOT NULL,
  `sp_ngayphathanh` date NOT NULL,
  `nsx_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`sp_id`, `sp_tengame`, `sp_imgavt`, `sp_file`, `sp_mota`, `sp_trailer`, `sp_gia`, `sp_ngayphathanh`, `nsx_id`) VALUES
(30, 'Game combat auto win k can choi', 'TOKYO-GHOUL-GAME.jpeg', 'website (1).zip', 'choi la win nap tien la win ', 'movie480.mp4', 200000, '2023-04-05', 2),
(34, 'abcxyz', 'Untitled.png', 'slick-1.8.1.zip', 'abcxyz', 'movie480.mp4', 300000, '2023-04-01', 2),
(35, 'Game nay choi k bao gio win', '272901924_23849393411120487_6168968477672361617_n.jpg', 'Dynamic-Web-Project-20230107T035512Z-001.zip', 'Game nay choi k bao gio win', 'movie480.mp4', 600000, '2023-04-06', 1),
(37, 'adasdasd', 'Untitled.png', 'slick-1.8.1.zip', 'ádasdasdasd', 'movie480.mp4', 12312412, '2023-04-04', 2),
(38, 'adasdasd1', 'Untitled.png', 'slick-1.8.1.zip', 'ádasdasdasd', 'movie480.mp4', 12312412, '2023-04-04', 2),
(39, 'adasdasd2', 'Untitled.png', 'slick-1.8.1.zip', 'ádasdasdasd', 'movie480.mp4', 12312412, '2023-04-04', 2),
(40, 'adasdasd3', 'Untitled.png', 'slick-1.8.1.zip', 'ádasdasdasd', 'movie480.mp4', 12312412, '2023-04-04', 2),
(41, 'adasdasd4', 'Untitled.png', 'slick-1.8.1.zip', 'ádasdasdasd', 'movie480.mp4', 12312412, '2023-04-04', 2),
(42, 'adasdasd5', 'Untitled.png', 'slick-1.8.1.zip', 'ádasdasdasd', 'movie480.mp4', 12312412, '2023-04-04', 2),
(43, 'adasdasd6', 'Untitled.png', 'slick-1.8.1.zip', 'ádasdasdasd', 'movie480.mp4', 12312412, '2023-04-04', 2),
(44, 'adasdasd7', 'Untitled.png', 'slick-1.8.1.zip', 'ádasdasdasd', 'movie480.mp4', 12312412, '2023-04-04', 2),
(45, 'adasdasd8', 'Untitled.png', 'slick-1.8.1.zip', 'ádasdasdasd', 'movie480.mp4', 12312412, '2023-04-04', 2),
(46, 'adasdasd9', 'Untitled.png', 'slick-1.8.1.zip', 'ádasdasdasd', 'movie480.mp4', 12312412, '2023-04-04', 2),
(47, 'adasdasd10', 'Untitled.png', 'slick-1.8.1.zip', 'ádasdasdasd', 'movie480.mp4', 12312412, '2023-04-04', 2),
(48, 'adasdasd11', 'Untitled.png', 'slick-1.8.1.zip', 'ádasdasdasd', 'movie480.mp4', 12312412, '2023-04-04', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanphamtheloai`
--

CREATE TABLE `sanphamtheloai` (
  `sptl_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `tl_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanphamtheloai`
--

INSERT INTO `sanphamtheloai` (`sptl_id`, `sp_id`, `tl_id`) VALUES
(14, 30, 11),
(15, 30, 12),
(16, 30, 13),
(17, 30, 14),
(24, 34, 6),
(25, 34, 7),
(26, 34, 8),
(27, 35, 13),
(28, 35, 14),
(32, 37, 6),
(33, 37, 7),
(34, 37, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `tk_id` int(11) NOT NULL,
  `tk_taikhoan` varchar(100) NOT NULL,
  `tk_matkhau` varchar(100) NOT NULL,
  `tk_loaitaikhoan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`tk_id`, `tk_taikhoan`, `tk_matkhau`, `tk_loaitaikhoan`) VALUES
(1, 'admin', '1', 'admin'),
(2, 'admin1', '1', 'admin'),
(23, 'tri1', '1', 'khach hang'),
(24, 'vng', '123', 'nha san xuat');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `tl_id` int(11) NOT NULL,
  `tl_ten` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`tl_id`, `tl_ten`) VALUES
(6, 'Chiến thuật'),
(7, 'Đố vui'),
(8, 'Đua xe'),
(9, 'Giáo dục'),
(10, 'Hành động'),
(11, 'Phiêu lưu'),
(12, 'Thể thao'),
(13, 'Nhập vai'),
(14, 'Đối kháng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongke_kh_va_sp`
--

CREATE TABLE `thongke_kh_va_sp` (
  `id_kh` int(11) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `ngaytai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `anhgameplay`
--
ALTER TABLE `anhgameplay`
  ADD PRIMARY KEY (`agl_id`),
  ADD KEY `fk_sp_agl` (`sp_id`);

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`dh_id`,`sp_id`);

--
-- Chỉ mục cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`kh_id`,`sp_id`),
  ADD KEY `fk_dg_sp` (`sp_id`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`dh_id`),
  ADD KEY `fk_hoadonkhachhang` (`kh_id`);

--
-- Chỉ mục cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  ADD PRIMARY KEY (`gg_id`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`kh_id`),
  ADD KEY `fk_tkkh` (`tk_id`);

--
-- Chỉ mục cho bảng `nsx`
--
ALTER TABLE `nsx`
  ADD PRIMARY KEY (`nsx_id`),
  ADD KEY `fk_tknsx` (`tk_id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`sp_id`),
  ADD KEY `fk_nsxsanpham` (`nsx_id`);

--
-- Chỉ mục cho bảng `sanphamtheloai`
--
ALTER TABLE `sanphamtheloai`
  ADD PRIMARY KEY (`sptl_id`),
  ADD KEY `fk_sptl1` (`sp_id`),
  ADD KEY `fk_sptl2` (`tl_id`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`tk_id`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`tl_id`);

--
-- Chỉ mục cho bảng `thongke_kh_va_sp`
--
ALTER TABLE `thongke_kh_va_sp`
  ADD PRIMARY KEY (`id_sp`,`id_kh`),
  ADD KEY `fk_thongke_kh_sp` (`id_kh`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `anhgameplay`
--
ALTER TABLE `anhgameplay`
  MODIFY `agl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `dh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  MODIFY `gg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `kh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `nsx`
--
ALTER TABLE `nsx`
  MODIFY `nsx_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `sanphamtheloai`
--
ALTER TABLE `sanphamtheloai`
  MODIFY `sptl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `tk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `tl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `anhgameplay`
--
ALTER TABLE `anhgameplay`
  ADD CONSTRAINT `fk_sp_agl` FOREIGN KEY (`sp_id`) REFERENCES `sanpham` (`sp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `fk_dg_kh` FOREIGN KEY (`kh_id`) REFERENCES `khachhang` (`kh_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dg_sp` FOREIGN KEY (`sp_id`) REFERENCES `sanpham` (`sp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `fk_hoadonkhachhang` FOREIGN KEY (`kh_id`) REFERENCES `khachhang` (`kh_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `fk_tkkh` FOREIGN KEY (`tk_id`) REFERENCES `taikhoan` (`tk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nsx`
--
ALTER TABLE `nsx`
  ADD CONSTRAINT `fk_tknsx` FOREIGN KEY (`tk_id`) REFERENCES `taikhoan` (`tk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_nsxsanpham` FOREIGN KEY (`nsx_id`) REFERENCES `nsx` (`nsx_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sanphamtheloai`
--
ALTER TABLE `sanphamtheloai`
  ADD CONSTRAINT `fk_sptl1` FOREIGN KEY (`sp_id`) REFERENCES `sanpham` (`sp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sptl2` FOREIGN KEY (`tl_id`) REFERENCES `theloai` (`tl_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `thongke_kh_va_sp`
--
ALTER TABLE `thongke_kh_va_sp`
  ADD CONSTRAINT `fk_thongke_kh_sp` FOREIGN KEY (`id_kh`) REFERENCES `khachhang` (`kh_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_thongke_sp_kh` FOREIGN KEY (`id_sp`) REFERENCES `sanpham` (`sp_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

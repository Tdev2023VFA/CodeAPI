-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 18, 2022 lúc 10:15 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `123123`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accountmomo`
--

CREATE TABLE `accountmomo` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  `setupkey` text NOT NULL,
  `ohash` text NOT NULL,
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_acb`
--

CREATE TABLE `account_acb` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `username` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `account` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `access_token` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `refreshToken` longtext CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `token` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_mbbank`
--

CREATE TABLE `account_mbbank` (
  `id` int(11) NOT NULL,
  `username` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `stk` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `sessionId` text DEFAULT NULL,
  `deviceId` text DEFAULT NULL,
  `token` text DEFAULT NULL,
  `time` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_thesieure`
--

CREATE TABLE `account_thesieure` (
  `id` int(11) NOT NULL,
  `user_id` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `username` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `cookie` longtext COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `balance` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `time` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_tpbank`
--

CREATE TABLE `account_tpbank` (
  `id` int(11) NOT NULL,
  `username` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `phone` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `stk` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `access_token` longtext COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `time` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_zalopay`
--

CREATE TABLE `account_zalopay` (
  `id` int(11) NOT NULL,
  `username` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `phone` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `salt` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `public_key` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `deviceId` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `session_id` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `display_name` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `access_token` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `zalo_id` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `user_id` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `profile_level` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `otp` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `time` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `short_name` text NOT NULL,
  `image` text NOT NULL,
  `accountNumber` text NOT NULL,
  `accountName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `title` text NOT NULL,
  `detail` text NOT NULL,
  `img` text NOT NULL,
  `content` text NOT NULL,
  `display` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cron_momo`
--

CREATE TABLE `cron_momo` (
  `id` int(11) NOT NULL,
  `user_id` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `phone` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `Name` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `imei` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `AAID` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `TOKEN` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ohash` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `SECUREID` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `rkey` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `rowCardId` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `authorization` longtext COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `refreshToken` longtext COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `agent_id` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `setupKeyDecrypt` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `setupKey` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `sessionkey` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `RSA_PUBLIC_KEY` longtext COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `BALANCE` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `BankVerify` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `partnerCode` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `device` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `hardware` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `facture` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MODELID` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `TimeLogin` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `errorDesc` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `today` int(11) DEFAULT 0,
  `month` int(11) DEFAULT 0,
  `today_gd` int(11) DEFAULT 0,
  `noidungtra` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `limit_day` int(11) DEFAULT NULL,
  `limit_month` int(11) DEFAULT NULL,
  `try` int(11) NOT NULL DEFAULT 0,
  `callback_url` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `uid` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `timemua` int(20) DEFAULT 0,
  `timehethan` bigint(20) DEFAULT 0,
  `gia` int(20) DEFAULT 0,
  `apikey` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `tinhtrang` int(2) NOT NULL DEFAULT 0,
  `ip_white` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status_anti` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `device`
--

CREATE TABLE `device` (
  `id` int(11) NOT NULL,
  `device` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `hardware` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `facture` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `MODELID` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `device`
--

INSERT INTO `device` (`id`, `device`, `hardware`, `facture`, `MODELID`) VALUES
(1, 'SM-G532F', 'mt6735', 'samsung', 'samsung sm-g532gmt6735r58j8671gsw'),
(2, 'Junoo-gm251', 'mt6735', 'samsung', 'samsung sm-gdsadsa1gsw'),
(3, 'SM-A102U', 'a10e', 'Samsung', 'Samsung SM-A102U'),
(4, 'SM-A305FN', 'a30', 'Samsung', 'Samsung SM-A305FN'),
(5, 'HTC One X9 dual sim', 'htc_e56ml_dtul', 'HTC', 'HTC One X9 dual sim'),
(6, 'HTC 7060', 'cp5dug', 'HTC', 'HTC HTC_7060'),
(7, 'HTC D10w', 'htc_a56dj_pro_dtwl', 'HTC', 'HTC htc_a56dj_pro_dtwl'),
(8, 'Oppo realme X Lite', 'RMX1851CN', 'Oppo', 'Oppo RMX1851'),
(9, 'MI 9', 'equuleus', 'Xiaomi', 'Xiaomi equuleus');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `key` text NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `document`
--

INSERT INTO `document` (`id`, `key`, `content`) VALUES
(2, 'momo', '<p>ksahdja</p>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dongtien`
--

CREATE TABLE `dongtien` (
  `id` int(11) NOT NULL,
  `sotientruoc` int(11) DEFAULT NULL,
  `sotienthaydoi` int(11) DEFAULT NULL,
  `sotiensau` int(11) DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `noidung` text COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `historyapi`
--

CREATE TABLE `historyapi` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `type` text NOT NULL,
  `api_key` text NOT NULL,
  `token` text NOT NULL,
  `day` int(11) NOT NULL,
  `sdt` text NOT NULL,
  `mk` text NOT NULL,
  `otp` int(11) NOT NULL,
  `ohash` text NOT NULL,
  `setupKey` text NOT NULL,
  `balance` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `user_id` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `trans_id` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `payment_method` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `amount` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `create_time` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ip_transfer`
--

CREATE TABLE `ip_transfer` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `ip_client` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `device` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `create_date` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `action` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `log_balance`
--

CREATE TABLE `log_balance` (
  `id` int(11) NOT NULL,
  `money_before` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `money_change` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `money_after` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `time` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `user_id` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `momo`
--

CREATE TABLE `momo` (
  `id` int(11) NOT NULL,
  `user` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `magd` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `price` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `noti`
--

CREATE TABLE `noti` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `create_date` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `value` longtext COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `options`
--

INSERT INTO `options` (`id`, `key`, `value`) VALUES
(1, 'title', 'CUNG CẤP API - UY TÍN - CHẤT LƯỢNG'),
(2, 'description', 'Hệ thống API cổng thanh toán trực tuyến. Cung cấp API thanh toán MoMo cá nhân, Vietcombank, Techcombank, MB Bank, ACB, VPBank...'),
(3, 'keywords', 'API MoMo, API Vietcombank, API Techcombank, API VPBANK, API MB BANK'),
(4, 'author', 'Nguyễn Nhật Lộc'),
(5, 'email_smtp', 'cskh.sieuthicode@gmail.com'),
(6, 'pass_email_smtp', 'xuwttubgxvikvjde'),
(11, 'noidung_naptien', 'NAPTIEN_'),
(12, 'thongbao', ''),
(13, 'anhbia', 'https://sieuthitool.com/img/tit.jpg'),
(14, 'favicon', 'https://sieuthitool.com/img/tit.jpg'),
(17, 'baotri', 'ON'),
(18, 'chinhsach', '<p>BẰNG VIỆC SỬ DỤNG C&Aacute;C DỊCH VỤ HOẶC MỞ MỘT T&Agrave;I KHOẢN, BẠN CHO BIẾT RẰNG BẠN CHẤP NHẬN, KH&Ocirc;NG R&Uacute;T LẠI, C&Aacute;C ĐIỀU KHOẢN DỊCH VỤ N&Agrave;Y. NẾU BẠN KH&Ocirc;NG ĐỒNG &Yacute; VỚI C&Aacute;C ĐIỀU KHOẢN N&Agrave;Y, VUI L&Ograve;NG KH&Ocirc;NG SỬ DỤNG C&Aacute;C DỊCH VỤ CỦA CH&Uacute;NG T&Ocirc;I HAY TRUY CẬP TRANG WEB. NẾU BẠN DƯỚI 18 TUỔI HOẶC &quot;ĐỘ TUỔI TRƯỞNG TH&Agrave;NH&quot;PH&Ugrave; HỢP Ở NƠI BẠN SỐNG, BẠN PHẢI XIN PH&Eacute;P CHA MẸ HOẶC NGƯỜI GI&Aacute;M HỘ HỢP PH&Aacute;P ĐỂ MỞ MỘT T&Agrave;I KHOẢN V&Agrave; CHA MẸ HOẶC NGƯỜI GI&Aacute;M HỘ HỢP PH&Aacute;P PHẢI ĐỒNG &Yacute; VỚI C&Aacute;C ĐIỀU KHOẢN DỊCH VỤ N&Agrave;Y. NẾU BẠN KH&Ocirc;NG BIẾT BẠN C&Oacute; THUỘC &quot;ĐỘ TUỔI TRƯỞNG TH&Agrave;NH&quot; Ở NƠI BẠN SỐNG HAY KH&Ocirc;NG, HOẶC KH&Ocirc;NG HIỂU PHẦN N&Agrave;Y, VUI L&Ograve;NG KH&Ocirc;NG TẠO T&Agrave;I KHOẢN CHO ĐẾN KHI BẠN Đ&Atilde; NHỜ CHA MẸ HOẶC NGƯỜI GI&Aacute;M HỘ HỢP PH&Aacute;P CỦA BẠN GI&Uacute;P ĐỠ. NẾU BẠN L&Agrave; CHA MẸ HOẶC NGƯỜI GI&Aacute;M HỘ HỢP PH&Aacute;P CỦA MỘT TRẺ VỊ TH&Agrave;NH NI&Ecirc;N MUỐN TẠO MỘT T&Agrave;I KHOẢN, BẠN PHẢI CHẤP NHẬN C&Aacute;C ĐIỀU KHOẢN DỊCH VỤ N&Agrave;Y THAY MẶT CHO TRẺ VỊ TH&Agrave;NH NI&Ecirc;N Đ&Oacute; V&Agrave; BẠN SẼ CHỊU TR&Aacute;CH NHIỆM ĐỐI VỚI TẤT CẢ HOẠT ĐỘNG SỬ DỤNG T&Agrave;I KHOẢN HAY C&Aacute;C DỊCH VỤ, BAO GỒM C&Aacute;C GIAO DỊCH MUA H&Agrave;NG DO TRẺ VỊ TH&Agrave;NH NI&Ecirc;N THỰC HIỆN, CHO D&Ugrave; T&Agrave;I KHOẢN CỦA TRẺ VỊ TH&Agrave;NH NI&Ecirc;N Đ&Oacute; ĐƯỢC MỞ V&Agrave;O L&Uacute;C N&Agrave;Y HAY ĐƯỢC TẠO SAU N&Agrave;Y V&Agrave; CHO D&Ugrave; TRẺ VỊ TH&Agrave;NH NI&Ecirc;N C&Oacute; ĐƯỢC BẠN GI&Aacute;M S&Aacute;T TRONG GIAO DỊCH MUA H&Agrave;NG Đ&Oacute; HAY KH&Ocirc;NG.</p>\r\n'),
(27, 'min_ruttien', '100000'),
(28, 'ck_con', '15'),
(29, 'phi_chuyentien', '500'),
(30, 'status_chuyentien', 'ON'),
(31, 'hotline', '0978364572'),
(32, 'email', 'nhatloc200@gmail.com'),
(33, 'theme_color', '#01578B'),
(34, 'modal_thongbao', 'dsa'),
(42, 'api_key', '0978364572'),
(43, 'check_time_cron_momo', '1662279903'),
(44, 'check_time_cron_tpbank', '1662279902'),
(45, 'check_time_cron_thesieure', '1662279903'),
(46, 'status_tpbank', '1'),
(47, 'token_tpbank', 'uxtHFGzLlVrC-IaowhS-zbZs-vPdl-qMu'),
(48, 'token_thesieure', 'MIkLrUgwtOGC-RlSOjE-LMSX-ufck-eQDB'),
(49, 'status_thesieure', '1'),
(50, 'token_momo', '3b6869c8-e6df-4d01-99f5-0dcde6dfdacd'),
(51, 'status_momo', '1'),
(52, 'display_api_tsr', '1'),
(53, 'limit_api_tsr', '1'),
(54, 'money_api_tsr', '15000'),
(55, 'display_api_tpbank', '1'),
(56, 'limit_api_tpbank', '1'),
(57, 'money_api_tpbank', '20000'),
(58, 'display_api_momo', '1'),
(59, 'limit_api_momo', '5'),
(60, 'money_api_momo', '30000'),
(61, 'noidungnap', 'naptien_'),
(62, 'sdt_momo', '0365157038'),
(63, 'name_momo', 'NGUYEN NHAT LOC'),
(64, 'display_api_mbbank', '1'),
(65, 'money_api_mbbank', '30000'),
(66, 'limit_api_mbbank', '2'),
(67, 'display_api_zalopay', '1'),
(68, 'money_api_zalopay', '30000'),
(69, 'limit_api_zalopay', '3'),
(70, 'money_api_momo_unlimit', '10000'),
(71, 'limit_api_momo_unlimit', '1000'),
(72, 'display_api_momo_unlimit', '1'),
(73, 'display_api_vcb', '1'),
(74, 'limit_api_vcb', '1'),
(75, 'money_api_vcb', '60000'),
(76, 'key_captcha', 'a0b3f9b4ee662c0d062256c060f47903107bafb1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `send`
--

CREATE TABLE `send` (
  `id` int(11) NOT NULL,
  `momo_id` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `tranId` varchar(11) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `partnerId` varchar(11) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `partnerName` mediumtext COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `amount` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `comment` mediumtext COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `time` mediumtext COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` varchar(32) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `status` varchar(11) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `ownerNumber` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ownerName` varchar(255) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `data` mediumtext COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `send_bank`
--

CREATE TABLE `send_bank` (
  `id` int(11) NOT NULL,
  `momo_id` varchar(255) DEFAULT NULL,
  `tranId` varchar(11) NOT NULL,
  `partnerId` varchar(11) NOT NULL,
  `partnerName` mediumtext NOT NULL,
  `amount` varchar(10) NOT NULL,
  `comment` mediumtext NOT NULL,
  `time` mediumtext NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` varchar(32) NOT NULL,
  `status` varchar(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `balance` int(11) DEFAULT 0,
  `ownerNumber` varchar(255) DEFAULT NULL,
  `ownerName` varchar(255) DEFAULT NULL,
  `data` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `level` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `ip` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `otp` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `money` int(11) NOT NULL DEFAULT 0,
  `total_money` int(11) NOT NULL DEFAULT 0,
  `banned` int(11) NOT NULL DEFAULT 0,
  `create_date` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `time_session` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `port_momo` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `time_api` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `time_tpbank` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `time_mbbank` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `time_zalopay` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `time_vcb` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vietcombank`
--

CREATE TABLE `vietcombank` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `username` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `account` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `session_id` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `access_key` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `cif` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `mobile_id` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `client_id` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `create_date` text COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accountmomo`
--
ALTER TABLE `accountmomo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `account_acb`
--
ALTER TABLE `account_acb`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `account_mbbank`
--
ALTER TABLE `account_mbbank`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `account_thesieure`
--
ALTER TABLE `account_thesieure`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `account_tpbank`
--
ALTER TABLE `account_tpbank`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `account_zalopay`
--
ALTER TABLE `account_zalopay`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cron_momo`
--
ALTER TABLE `cron_momo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `historyapi`
--
ALTER TABLE `historyapi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ip_transfer`
--
ALTER TABLE `ip_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `log_balance`
--
ALTER TABLE `log_balance`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `momo`
--
ALTER TABLE `momo`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `noti`
--
ALTER TABLE `noti`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `send`
--
ALTER TABLE `send`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `send_bank`
--
ALTER TABLE `send_bank`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vietcombank`
--
ALTER TABLE `vietcombank`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accountmomo`
--
ALTER TABLE `accountmomo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `account_acb`
--
ALTER TABLE `account_acb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `account_mbbank`
--
ALTER TABLE `account_mbbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `account_thesieure`
--
ALTER TABLE `account_thesieure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `account_tpbank`
--
ALTER TABLE `account_tpbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `account_zalopay`
--
ALTER TABLE `account_zalopay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `cron_momo`
--
ALTER TABLE `cron_momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `device`
--
ALTER TABLE `device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `historyapi`
--
ALTER TABLE `historyapi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ip_transfer`
--
ALTER TABLE `ip_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `log_balance`
--
ALTER TABLE `log_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `momo`
--
ALTER TABLE `momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `noti`
--
ALTER TABLE `noti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `send`
--
ALTER TABLE `send`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `send_bank`
--
ALTER TABLE `send_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `vietcombank`
--
ALTER TABLE `vietcombank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

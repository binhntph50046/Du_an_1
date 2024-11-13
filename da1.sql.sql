CREATE TABLE `danh_muc` (
  `danh_muc_id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `ten_danh_muc` VARCHAR(50) NOT NULL,
  `hinh` VARCHAR(255) NOT NULL,
  `mo_ta` TEXT,
  `trang_thai` TINYINT(1) DEFAULT 1
);

CREATE TABLE `san_pham` (
  `san_pham_id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `ten_san_pham` VARCHAR(50) NOT NULL,
  `gia` INT NOT NULL,
  `hinh` VARCHAR(255) NOT NULL,
  `ngay_nhap` DATE,
  `mo_ta` TEXT,
  `so_luot_xem` INT(11) DEFAULT 0,
  `trang_thai` TINYINT(1) DEFAULT 1,
  `danh_muc_id` INT(11) NOT NULL
);

CREATE TABLE `hinh_anh` (
  `san_pham_id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `hinh` varchar(255) NOT NULL
);

CREATE TABLE `tai_khoan` (
  `tai_khoan_id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `ho_va_ten` VARCHAR(50) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `mat_khau` VARCHAR(50) NOT NULL,
  `dia_chi` VARCHAR(255),
  `so_dien_thoai` VARCHAR(20) NOT NULL,
  `gioi_tinh` TINYINT(1) NOT NULL,
  `hinh` VARCHAR(255),
  `vai_tro` TINYINT(1) DEFAULT 0,
  `ngay_dang_ky` DATE DEFAULT null,
  `trang_thai` TINYINT(1) DEFAULT 1
);

CREATE TABLE `slides` (
  `slides_id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `img` VARCHAR(255) NOT NULL,
  `trang_thai` TINYINT(1) DEFAULT 1,
  `vi_tri` INT(11),
  `san_pham_id` INT(11) NOT NULL
);

CREATE TABLE `binh_luan` (
  `binh_luan_id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `noi_dung` VARCHAR(255) NOT NULL,
  `tai_khoan_id` INT(11) NOT NULL,
  `san_pham_id` INT(11) NOT NULL,
  `ngay_binh_luan` DATETIME DEFAULT (CURRENT_TIMESTAMP),
  `trang_thai` TINYINT(1) DEFAULT 1
);

CREATE TABLE `don_hang` (
  `don_hang_id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `tai_khoan_id` INT(11) NOT NULL,
  `ho_va_ten` VARCHAR(50) NOT NULL,
  `dia_chi` VARCHAR(255),
  `so_dien_thoai` VARCHAR(20) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `ngay_dat` DATE DEFAULT null,
  `tong_tien` INT,
  `phuong_thuc_thanh_toan` TINYINT(1) DEFAULT 1,
  `trang_thai` TINYINT(1) DEFAULT 1,
  `ngay_xu_ly` DATE
);

CREATE TABLE `chi_tiet_don_hang` (
  `chi_tiet_don_hang_id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `don_hang_id` INT(11) NOT NULL,
  `san_pham_id` INT(11) NOT NULL,
  `so_luong` INT NOT NULL,
  `gia` INT NOT NULL,
  `tong_tien` INT,
  `khuyen_mai` INT DEFAULT 0
);

CREATE TABLE `gio_hang` (
  `gio_hang_id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `tai_khoan_id` INT(11) NOT NULL,
  `san_pham_id` INT(11) NOT NULL,
  `so_luong` INT NOT NULL,
  `ngay_them_vao` DATE DEFAULT null
);

ALTER TABLE `hinh_anh` ADD FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`);

ALTER TABLE `san_pham` ADD FOREIGN KEY (`danh_muc_id`) REFERENCES `danh_muc` (`danh_muc_id`);

ALTER TABLE `slides` ADD FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`);

ALTER TABLE `binh_luan` ADD FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoan` (`tai_khoan_id`);

ALTER TABLE `binh_luan` ADD FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`);

ALTER TABLE `don_hang` ADD FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoan` (`tai_khoan_id`);

ALTER TABLE `chi_tiet_don_hang` ADD FOREIGN KEY (`don_hang_id`) REFERENCES `don_hang` (`don_hang_id`);

ALTER TABLE `chi_tiet_don_hang` ADD FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`);

ALTER TABLE `gio_hang` ADD FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoan` (`tai_khoan_id`);

ALTER TABLE `gio_hang` ADD FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`);

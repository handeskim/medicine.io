CREATE TABLE `status` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_status` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE `authorities` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_auth` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE `types_pharma` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_types_pharma` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) 
CREATE TABLE `generic_pharma` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_generic_pharma` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) 
CREATE TABLE `type_post` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_type_orders` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `url_check_orders` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) 
CREATE TABLE `type_oders` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_oders` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) 

CREATE TABLE `scheduling_callback` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `code_staff` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `code_customer` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `scheduling` datetime COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) 
CREATE TABLE `products` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `code_products` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `name_products` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `label_products` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `quantily` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `manuals` text COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) 


CREATE TABLE `nhan_vien` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `code` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` date COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `dien_thoai` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `hinh_anh` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `passport_id` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `authorities` int(255) DEFAULT NULL,
  `status` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `customer` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `code` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` date COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `dien_thoai` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `dien_thoai_2` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `hinh_anh` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `passport_id` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `supervisor` int(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

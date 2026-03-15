/*
 Navicat Premium Dump SQL

 Source Server         : Database
 Source Server Type    : MariaDB
 Source Server Version : 120201 (12.2.1-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : db_coffee_shop

 Target Server Type    : MariaDB
 Target Server Version : 120201 (12.2.1-MariaDB)
 File Encoding         : 65001

 Date: 17/12/2025 11:03:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bahan_baku_produk
-- ----------------------------
DROP TABLE IF EXISTS `bahan_baku_produk`;
CREATE TABLE `bahan_baku_produk`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `stok_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` decimal(10, 3) NOT NULL,
  `satuan_kebutuhan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `bahan_baku_produk_produk_id_foreign`(`produk_id` ASC) USING BTREE,
  INDEX `bahan_baku_produk_stok_id_foreign`(`stok_id` ASC) USING BTREE,
  CONSTRAINT `bahan_baku_produk_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `bahan_baku_produk_stok_id_foreign` FOREIGN KEY (`stok_id`) REFERENCES `stok` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bahan_baku_produk
-- ----------------------------
INSERT INTO `bahan_baku_produk` VALUES (2, 2, 4, 0.015, 'kg', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (3, 2, 5, 0.150, 'liter', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (4, 3, 4, 0.015, 'kg', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (5, 3, 5, 0.200, 'liter', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (6, 4, 4, 0.015, 'kg', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (7, 5, 4, 0.015, 'kg', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (8, 5, 5, 0.150, 'liter', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (9, 5, 8, 0.020, 'kg', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (10, 6, 5, 0.200, 'liter', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (11, 6, 6, 0.020, 'kg', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (12, 7, 5, 0.250, 'liter', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (13, 7, 6, 0.030, 'kg', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (14, 8, 10, 2.000, 'pcs', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (15, 8, 5, 0.150, 'liter', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (16, 8, 6, 0.030, 'kg', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (17, 9, 5, 0.200, 'liter', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (18, 9, 11, 0.050, 'liter', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (19, 10, 6, 0.100, 'kg', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (20, 10, 8, 0.050, 'kg', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `bahan_baku_produk` VALUES (21, 11, 4, 300.000, 'gram', '2025-12-17 03:53:15', '2025-12-17 03:53:15');
INSERT INTO `bahan_baku_produk` VALUES (22, 1, 4, 0.025, 'gram', '2025-12-17 03:57:28', '2025-12-17 03:57:28');

-- ----------------------------
-- Table structure for detail_pesanan
-- ----------------------------
DROP TABLE IF EXISTS `detail_pesanan`;
CREATE TABLE `detail_pesanan`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` decimal(10, 2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `detail_pesanan_produk_id_foreign`(`produk_id` ASC) USING BTREE,
  INDEX `detail_pesanan_pesanan_id_foreign`(`pesanan_id` ASC) USING BTREE,
  CONSTRAINT `detail_pesanan_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `detail_pesanan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_pesanan
-- ----------------------------
INSERT INTO `detail_pesanan` VALUES (1, 1, 1, 5, 75000.00, '2025-12-17 03:58:33', '2025-12-17 03:58:33');
INSERT INTO `detail_pesanan` VALUES (2, 1, 2, 3, 60000.00, '2025-12-17 03:58:33', '2025-12-17 03:58:33');

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (1, 'Kopi', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `kategori` VALUES (2, 'Non-Kopi', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `kategori` VALUES (3, 'Tea', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `kategori` VALUES (4, 'Snack', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `kategori` VALUES (5, 'Dessert', '2025-12-17 03:51:50', '2025-12-17 03:51:50');

-- ----------------------------
-- Table structure for laporan
-- ----------------------------
DROP TABLE IF EXISTS `laporan`;
CREATE TABLE `laporan`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `total_pesanan` int(11) NOT NULL,
  `total_pendapatan` decimal(12, 2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of laporan
-- ----------------------------
INSERT INTO `laporan` VALUES (1, '2025-12-17', 1, 135000.00, '2025-12-17 03:59:45', '2025-12-17 03:59:45');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (11, '2025_12_16_063358_create_kategori_table', 1);
INSERT INTO `migrations` VALUES (12, '2025_12_16_063405_create_produk_table', 1);
INSERT INTO `migrations` VALUES (13, '2025_12_16_063409_create_stok_table', 1);
INSERT INTO `migrations` VALUES (14, '2025_12_16_063414_create_pesanan_table', 1);
INSERT INTO `migrations` VALUES (15, '2025_12_16_063422_create_detail_pesanan_table', 1);
INSERT INTO `migrations` VALUES (16, '2025_12_16_063426_create_laporan_table', 1);
INSERT INTO `migrations` VALUES (17, '2025_12_16_074721_add_konversi_to_stok_table', 1);
INSERT INTO `migrations` VALUES (18, '2025_12_16_140906_add_soft_deletes_to_produk', 1);
INSERT INTO `migrations` VALUES (19, '2025_12_16_141540_update_pesanan_foreign_key_cascade', 1);
INSERT INTO `migrations` VALUES (20, '2025_12_16_143217_create_bahan_baku_produk_table', 1);

-- ----------------------------
-- Table structure for pesanan
-- ----------------------------
DROP TABLE IF EXISTS `pesanan`;
CREATE TABLE `pesanan`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('dine_in','takeaway') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','diproses','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harga` decimal(10, 2) NOT NULL,
  `tanggal_pesanan` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pesanan
-- ----------------------------
INSERT INTO `pesanan` VALUES (1, 'Arba Rinata', 'dine_in', 'selesai', 135000.00, '2025-12-17 10:58:33', '2025-12-17 03:58:33', '2025-12-17 03:58:44');

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `harga` decimal(10, 2) NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tersedia` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produk_kategori_id_foreign`(`kategori_id` ASC) USING BTREE,
  CONSTRAINT `produk_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES (1, 'Espresso', 1, 15000.00, 'Kopi espresso', 1, '2025-12-17 03:51:50', '2025-12-17 03:57:43', NULL);
INSERT INTO `produk` VALUES (2, 'Cappuccino', 1, 20000.00, 'Espresso dengan susu steamed', 1, '2025-12-17 03:51:50', '2025-12-17 03:51:50', NULL);
INSERT INTO `produk` VALUES (3, 'Latte', 1, 22000.00, 'Espresso dengan banyak susu', 1, '2025-12-17 03:51:50', '2025-12-17 03:51:50', NULL);
INSERT INTO `produk` VALUES (4, 'Americano', 1, 18000.00, 'Espresso dengan air panas', 1, '2025-12-17 03:51:50', '2025-12-17 03:51:50', NULL);
INSERT INTO `produk` VALUES (5, 'Mocha', 1, 23000.00, 'Espresso dengan coklat dan susu', 1, '2025-12-17 03:51:50', '2025-12-17 03:51:50', NULL);
INSERT INTO `produk` VALUES (6, 'Milo Dinosaur', 2, 18000.00, 'Milo dengan extra bubuk milo', 1, '2025-12-17 03:51:50', '2025-12-17 03:51:50', NULL);
INSERT INTO `produk` VALUES (7, 'Green Tea Latte', 2, 20000.00, 'Green tea dengan susu', 1, '2025-12-17 03:51:50', '2025-12-17 03:51:50', NULL);
INSERT INTO `produk` VALUES (8, 'Teh Tarik', 3, 12000.00, 'Teh susu khas Malaysia', 1, '2025-12-17 03:51:50', '2025-12-17 03:51:50', NULL);
INSERT INTO `produk` VALUES (9, 'Thai Tea', 3, 15000.00, 'Teh thailand dengan rasa khas', 1, '2025-12-17 03:51:50', '2025-12-17 03:51:50', NULL);
INSERT INTO `produk` VALUES (10, 'Red Velvet', 4, 25000.00, 'Red velvet dengan cream cheese', 1, '2025-12-17 03:51:50', '2025-12-17 03:51:50', NULL);
INSERT INTO `produk` VALUES (11, 'Kopi Hitam', 1, 9000.00, NULL, 1, '2025-12-17 03:52:58', '2025-12-17 03:52:58', NULL);

-- ----------------------------
-- Table structure for stok
-- ----------------------------
DROP TABLE IF EXISTS `stok`;
CREATE TABLE `stok`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_sekarang` int(11) NOT NULL,
  `stok_minimal` int(11) NOT NULL,
  `satuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan_dasar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `faktor_konversi` decimal(8, 4) NOT NULL DEFAULT 1.0000,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aman',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stok
-- ----------------------------
INSERT INTO `stok` VALUES (1, 'Cup Paper', 262, 100, 'pcs', NULL, 1.0000, 'aman', '2025-12-17 03:51:50', '2025-12-17 03:59:22');
INSERT INTO `stok` VALUES (2, 'Sedotan', 992, 200, 'pcs', NULL, 1.0000, 'aman', '2025-12-17 03:51:50', '2025-12-17 03:58:33');
INSERT INTO `stok` VALUES (3, 'Tutup Cup', 492, 100, 'pcs', NULL, 1.0000, 'aman', '2025-12-17 03:51:50', '2025-12-17 03:58:33');
INSERT INTO `stok` VALUES (4, 'Kopi Bubuk', 5, 1, 'kg', NULL, 1.0000, 'aman', '2025-12-17 03:51:50', '2025-12-17 03:58:33');
INSERT INTO `stok` VALUES (5, 'Susu Cair', 10, 2, 'liter', NULL, 1.0000, 'aman', '2025-12-17 03:51:50', '2025-12-17 03:58:33');
INSERT INTO `stok` VALUES (6, 'Gula Pasir', 20, 5, 'kg', NULL, 1.0000, 'aman', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `stok` VALUES (7, 'Es Batu', 50, 10, 'kg', NULL, 1.0000, 'aman', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `stok` VALUES (8, 'Coklat Bubuk', 3, 1, 'kg', NULL, 1.0000, 'aman', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `stok` VALUES (9, 'Vanilla Syrup', 5, 1, 'liter', NULL, 1.0000, 'aman', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `stok` VALUES (10, 'Teh Celup', 100, 20, 'pcs', NULL, 1.0000, 'aman', '2025-12-17 03:51:50', '2025-12-17 03:51:50');
INSERT INTO `stok` VALUES (11, 'Sirup Gula', 8, 2, 'liter', NULL, 1.0000, 'aman', '2025-12-17 03:51:50', '2025-12-17 03:51:50');

SET FOREIGN_KEY_CHECKS = 1;

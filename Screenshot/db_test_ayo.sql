/*
 Navicat Premium Data Transfer

 Source Server         : MySQL 8
 Source Server Type    : MySQL
 Source Server Version : 80027
 Source Host           : localhost:3306
 Source Schema         : db_test_ayo

 Target Server Type    : MySQL
 Target Server Version : 80027
 File Encoding         : 65001

 Date: 17/03/2022 16:53:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for event
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time(0) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int NOT NULL,
  `event_status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of event
-- ----------------------------

-- ----------------------------
-- Table structure for event_log
-- ----------------------------
DROP TABLE IF EXISTS `event_log`;
CREATE TABLE `event_log`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `event_resume` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_attend` int NOT NULL,
  `member_contribution` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_result` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of event_log
-- ----------------------------

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` int NOT NULL,
  `weight` int NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `member_email_unique`(`email`) USING BTREE,
  UNIQUE INDEX `member_phone_number_unique`(`phone_number`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES (1, 'Hidayat', 176, 78, 'hidayat@local.com', '0882918923', 1, NULL, '2022-03-17 15:51:52', NULL, NULL);
INSERT INTO `member` VALUES (2, 'Bakir', 168, 55, 'bakir@local.com', '0882918947', 1, NULL, '2022-03-17 15:52:44', NULL, NULL);

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL,
  `is_section` tinyint NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bullet` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_submenu` tinyint NOT NULL,
  `page` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `order` int NOT NULL,
  `is_active` tinyint NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 0, 0, 'Dashboard', 'dot', 'media/svg/icons/Design/Layers.svg', 0, 'dashboard', 0, 1, '2021-08-10 14:19:26', '2021-08-10 14:19:26', NULL);
INSERT INTO `menu` VALUES (2, 0, 1, 'Admin', 'dot', 'media/svg/icons/Design/Layers.svg', 0, '', 4, 1, '2021-08-10 14:19:26', '2021-08-10 14:19:26', NULL);
INSERT INTO `menu` VALUES (3, 0, 0, 'Settings', NULL, 'fa fa-cog', 1, NULL, 5, 1, '2021-08-10 14:19:26', '2021-08-10 14:19:26', NULL);
INSERT INTO `menu` VALUES (4, 3, 0, 'User Management', NULL, 'media/svg/icons/General/User.svg', 0, 'user', 0, 1, '2021-08-10 14:19:26', '2021-08-10 14:19:26', NULL);
INSERT INTO `menu` VALUES (5, 3, 0, 'Menu', NULL, 'media/svg/icons/Text/Menu.svg', 0, 'menu', 1, 1, '2021-08-10 14:19:26', '2021-08-10 14:19:26', NULL);
INSERT INTO `menu` VALUES (6, 3, 0, 'Roles', NULL, 'fas fa-user-cog', 0, 'roles', 2, 1, '2021-08-10 14:19:26', '2021-08-10 14:19:26', NULL);
INSERT INTO `menu` VALUES (7, 0, 1, 'Main Menu', NULL, 'default icon', 0, NULL, 1, 1, '2022-03-17 10:07:16', '2022-03-17 10:07:17', NULL);
INSERT INTO `menu` VALUES (8, 0, 0, 'Manajemen Organisasi', NULL, 'fas fa-users', 1, NULL, 2, 1, '2022-03-17 10:09:49', '2022-03-17 10:09:49', NULL);
INSERT INTO `menu` VALUES (9, 8, 0, 'Organisasi', NULL, 'fas fa-chevron-circle-right', 0, 'organization', 0, 1, '2022-03-17 10:11:34', '2022-03-17 10:11:34', NULL);
INSERT INTO `menu` VALUES (10, 8, 0, 'Manajemen Anggota', NULL, 'fas fa-chevron-circle-right', 0, 'member', 1, 1, '2022-03-17 10:13:33', '2022-03-17 10:13:33', NULL);
INSERT INTO `menu` VALUES (11, 0, 0, 'Manajemen Acara', NULL, 'far fa-calendar-alt', 1, NULL, 3, 1, '2022-03-17 10:19:35', '2022-03-17 10:19:35', NULL);
INSERT INTO `menu` VALUES (12, 11, 0, 'Master Acara', NULL, 'fas fa-chevron-circle-right', 0, 'event', 0, 1, '2022-03-17 10:20:19', '2022-03-17 10:20:19', NULL);
INSERT INTO `menu` VALUES (13, 11, 0, 'Laporan Acara', NULL, 'fas fa-chevron-circle-right', 0, 'eventlog', 1, 1, '2022-03-17 10:20:58', '2022-03-17 10:20:58', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 53 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (39, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (52, '2020_07_21_143659_create_users_table', 2);
INSERT INTO `migrations` VALUES (41, '2020_07_29_080404_create_services_table', 1);
INSERT INTO `migrations` VALUES (42, '2021_06_25_195234_create_roles_table', 1);
INSERT INTO `migrations` VALUES (43, '2021_08_10_133614_create_menu_table', 1);
INSERT INTO `migrations` VALUES (44, '2021_08_10_134309_create_permission_table', 1);
INSERT INTO `migrations` VALUES (45, '2021_08_10_135556_create_role_permission_table', 1);
INSERT INTO `migrations` VALUES (46, '2022_03_16_105728_create_organization_table', 1);
INSERT INTO `migrations` VALUES (55, '2022_03_16_105749_create_member_table', 4);
INSERT INTO `migrations` VALUES (48, '2022_03_16_105801_create_event_table', 1);
INSERT INTO `migrations` VALUES (49, '2022_03_16_110216_create_sport_branch_table', 1);
INSERT INTO `migrations` VALUES (53, '2022_03_16_110410_create_org_member_table', 3);
INSERT INTO `migrations` VALUES (51, '2022_03_16_113021_create_event_log_table', 1);

-- ----------------------------
-- Table structure for org_member
-- ----------------------------
DROP TABLE IF EXISTS `org_member`;
CREATE TABLE `org_member`  (
  `org_id` int NOT NULL,
  `position_id` int NOT NULL,
  `member_id` int NOT NULL
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of org_member
-- ----------------------------
INSERT INTO `org_member` VALUES (2, 1, 1);
INSERT INTO `org_member` VALUES (2, 3, 2);

-- ----------------------------
-- Table structure for organization
-- ----------------------------
DROP TABLE IF EXISTS `organization`;
CREATE TABLE `organization`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `org_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `since` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sport_branch_id` int NOT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of organization
-- ----------------------------
INSERT INTO `organization` VALUES (1, 'Plain FCE', 'GPt3Hug_20220317.png', '2016', 'Plamongan Indah Semarang Jawa Tengah Indonesia', 1, 1, 1, '2022-03-17 11:47:22', '2022-03-17 12:31:32', '2022-03-17 12:31:32');
INSERT INTO `organization` VALUES (2, 'Mumedsu', 'pzQbrHO_20220317.jfif', '2013', 'SMK N 4 Semarang, Jl. Pandanaran Kota Semarang', 2, 1, NULL, '2022-03-17 12:28:39', NULL, NULL);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `id` int NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES (1, 'menu-dashboard-show', 'Permission to show dashboard menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (2, 'section-admin-show', 'Permission to show admin section', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (3, 'menu-settings-show', 'Permission to show settings menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (4, 'menu-usermanagement-show', 'Permission to show usermanagement menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (5, 'menu-usermanagement-create', 'Permission to create in usermanagement menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (6, 'menu-usermanagement-edit', 'Permission to edit in usermanagement menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (7, 'menu-usermanagement-delete', 'Permission to delete in usermanagement menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (8, 'menu-section-show', 'Permission to show section menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (9, 'menu-section-create', 'Permission to create in section menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (10, 'menu-section-edit', 'Permission to edit in section menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (11, 'menu-section-delete', 'Permission to delete in section menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (12, 'menu-menu-show', 'Permission to show menu menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (13, 'menu-menu-create', 'Permission to create in menu menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (14, 'menu-menu-edit', 'Permission to edit in menu menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (15, 'menu-menu-delete', 'Permission to delete in menu menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (16, 'menu-roles-show', 'Permission to show roles menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (17, 'menu-roles-create', 'Permission to create in roles menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (18, 'menu-roles-edit', 'Permission to edit in roles menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (19, 'menu-roles-delete', 'Permission to delete in roles menu', 1, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `permission` VALUES (20, 'section-mainmenu-show', 'Permission to show mainmenu section', 1, '2022-03-17 10:07:17', NULL);
INSERT INTO `permission` VALUES (21, 'menu-manajemenorganisasi-show', 'Permission to show manajemenorganisasi menu', 1, '2022-03-17 10:09:49', NULL);
INSERT INTO `permission` VALUES (22, 'menu-organisasi-show', 'Permission to show organisasi menu', 1, '2022-03-17 10:11:34', NULL);
INSERT INTO `permission` VALUES (23, 'menu-organisasi-create', 'Permission to create in organisasi menu', 1, '2022-03-17 10:11:34', NULL);
INSERT INTO `permission` VALUES (24, 'menu-organisasi-edit', 'Permission to edit in organisasi menu', 1, '2022-03-17 10:11:34', NULL);
INSERT INTO `permission` VALUES (25, 'menu-organisasi-delete', 'Permission to delete in organisasi menu', 1, '2022-03-17 10:11:34', NULL);
INSERT INTO `permission` VALUES (26, 'menu-manajemenanggota-show', 'Permission to show manajemenanggota menu', 1, '2022-03-17 10:13:33', NULL);
INSERT INTO `permission` VALUES (27, 'menu-manajemenanggota-create', 'Permission to create in manajemenanggota menu', 1, '2022-03-17 10:13:33', NULL);
INSERT INTO `permission` VALUES (28, 'menu-manajemenanggota-edit', 'Permission to edit in manajemenanggota menu', 1, '2022-03-17 10:13:33', NULL);
INSERT INTO `permission` VALUES (29, 'menu-manajemenanggota-delete', 'Permission to delete in manajemenanggota menu', 1, '2022-03-17 10:13:33', NULL);
INSERT INTO `permission` VALUES (30, 'menu-manajemenacara-show', 'Permission to show manajemenacara menu', 1, '2022-03-17 10:19:35', NULL);
INSERT INTO `permission` VALUES (31, 'menu-masteracara-show', 'Permission to show masteracara menu', 1, '2022-03-17 10:20:19', NULL);
INSERT INTO `permission` VALUES (32, 'menu-masteracara-create', 'Permission to create in masteracara menu', 1, '2022-03-17 10:20:19', NULL);
INSERT INTO `permission` VALUES (33, 'menu-masteracara-edit', 'Permission to edit in masteracara menu', 1, '2022-03-17 10:20:19', NULL);
INSERT INTO `permission` VALUES (34, 'menu-masteracara-delete', 'Permission to delete in masteracara menu', 1, '2022-03-17 10:20:19', NULL);
INSERT INTO `permission` VALUES (35, 'menu-laporanacara-show', 'Permission to show laporanacara menu', 1, '2022-03-17 10:20:58', NULL);
INSERT INTO `permission` VALUES (36, 'menu-laporanacara-create', 'Permission to create in laporanacara menu', 1, '2022-03-17 10:20:58', NULL);
INSERT INTO `permission` VALUES (37, 'menu-laporanacara-edit', 'Permission to edit in laporanacara menu', 1, '2022-03-17 10:20:58', NULL);
INSERT INTO `permission` VALUES (38, 'menu-laporanacara-delete', 'Permission to delete in laporanacara menu', 1, '2022-03-17 10:20:58', NULL);

-- ----------------------------
-- Table structure for role_permission
-- ----------------------------
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `start_date` datetime(0) NULL DEFAULT NULL,
  `end_date` datetime(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 71 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of role_permission
-- ----------------------------
INSERT INTO `role_permission` VALUES (1, 1, 1, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (2, 1, 2, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (3, 1, 3, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (4, 1, 4, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (5, 1, 5, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (6, 1, 6, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (7, 1, 7, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (8, 1, 8, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (9, 1, 9, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (10, 1, 10, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (11, 1, 11, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (12, 1, 12, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (13, 1, 13, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (14, 1, 14, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (15, 2, 1, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (16, 2, 2, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (17, 2, 3, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (18, 2, 4, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (19, 2, 7, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (20, 2, 8, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (21, 2, 11, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (22, 2, 12, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (23, 1, 16, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (24, 1, 17, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (25, 1, 18, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (26, 1, 19, NULL, NULL, '2021-08-16 09:51:00', '2021-08-16 09:51:00');
INSERT INTO `role_permission` VALUES (27, 1, 20, NULL, NULL, '2022-03-17 10:07:17', NULL);
INSERT INTO `role_permission` VALUES (28, 2, 20, NULL, NULL, '2022-03-17 10:07:17', NULL);
INSERT INTO `role_permission` VALUES (29, 3, 20, NULL, NULL, '2022-03-17 10:07:17', NULL);
INSERT INTO `role_permission` VALUES (30, 1, 21, NULL, NULL, '2022-03-17 10:09:49', NULL);
INSERT INTO `role_permission` VALUES (31, 2, 21, NULL, NULL, '2022-03-17 10:09:49', NULL);
INSERT INTO `role_permission` VALUES (32, 1, 22, NULL, NULL, '2022-03-17 10:11:34', NULL);
INSERT INTO `role_permission` VALUES (33, 1, 23, NULL, NULL, '2022-03-17 10:11:34', NULL);
INSERT INTO `role_permission` VALUES (34, 1, 24, NULL, NULL, '2022-03-17 10:11:34', NULL);
INSERT INTO `role_permission` VALUES (35, 1, 25, NULL, NULL, '2022-03-17 10:11:34', NULL);
INSERT INTO `role_permission` VALUES (36, 2, 22, NULL, NULL, '2022-03-17 10:11:34', NULL);
INSERT INTO `role_permission` VALUES (37, 2, 23, NULL, NULL, '2022-03-17 10:11:34', NULL);
INSERT INTO `role_permission` VALUES (38, 2, 24, NULL, NULL, '2022-03-17 10:11:34', NULL);
INSERT INTO `role_permission` VALUES (39, 2, 25, NULL, NULL, '2022-03-17 10:11:34', NULL);
INSERT INTO `role_permission` VALUES (40, 1, 26, NULL, NULL, '2022-03-17 10:13:33', NULL);
INSERT INTO `role_permission` VALUES (41, 1, 27, NULL, NULL, '2022-03-17 10:13:33', NULL);
INSERT INTO `role_permission` VALUES (42, 1, 28, NULL, NULL, '2022-03-17 10:13:33', NULL);
INSERT INTO `role_permission` VALUES (43, 1, 29, NULL, NULL, '2022-03-17 10:13:33', NULL);
INSERT INTO `role_permission` VALUES (44, 2, 26, NULL, NULL, '2022-03-17 10:13:33', NULL);
INSERT INTO `role_permission` VALUES (45, 2, 27, NULL, NULL, '2022-03-17 10:13:33', NULL);
INSERT INTO `role_permission` VALUES (46, 2, 28, NULL, NULL, '2022-03-17 10:13:33', NULL);
INSERT INTO `role_permission` VALUES (47, 2, 29, NULL, NULL, '2022-03-17 10:13:33', NULL);
INSERT INTO `role_permission` VALUES (48, 1, 30, NULL, NULL, '2022-03-17 10:19:35', NULL);
INSERT INTO `role_permission` VALUES (49, 2, 30, NULL, NULL, '2022-03-17 10:19:35', NULL);
INSERT INTO `role_permission` VALUES (50, 3, 30, NULL, NULL, '2022-03-17 10:19:35', NULL);
INSERT INTO `role_permission` VALUES (51, 1, 31, NULL, NULL, '2022-03-17 10:20:19', NULL);
INSERT INTO `role_permission` VALUES (52, 1, 32, NULL, NULL, '2022-03-17 10:20:19', NULL);
INSERT INTO `role_permission` VALUES (53, 1, 33, NULL, NULL, '2022-03-17 10:20:19', NULL);
INSERT INTO `role_permission` VALUES (54, 1, 34, NULL, NULL, '2022-03-17 10:20:19', NULL);
INSERT INTO `role_permission` VALUES (55, 2, 31, NULL, NULL, '2022-03-17 10:20:19', NULL);
INSERT INTO `role_permission` VALUES (56, 2, 32, NULL, NULL, '2022-03-17 10:20:19', NULL);
INSERT INTO `role_permission` VALUES (57, 2, 33, NULL, NULL, '2022-03-17 10:20:19', NULL);
INSERT INTO `role_permission` VALUES (58, 2, 34, NULL, NULL, '2022-03-17 10:20:19', NULL);
INSERT INTO `role_permission` VALUES (59, 3, 31, NULL, NULL, '2022-03-17 10:20:19', NULL);
INSERT INTO `role_permission` VALUES (60, 3, 32, NULL, NULL, '2022-03-17 10:20:19', NULL);
INSERT INTO `role_permission` VALUES (61, 3, 33, NULL, NULL, '2022-03-17 10:20:19', NULL);
INSERT INTO `role_permission` VALUES (62, 3, 34, NULL, NULL, '2022-03-17 10:20:19', NULL);
INSERT INTO `role_permission` VALUES (63, 1, 35, NULL, NULL, '2022-03-17 10:20:58', NULL);
INSERT INTO `role_permission` VALUES (64, 1, 36, NULL, NULL, '2022-03-17 10:20:58', NULL);
INSERT INTO `role_permission` VALUES (65, 1, 37, NULL, NULL, '2022-03-17 10:20:58', NULL);
INSERT INTO `role_permission` VALUES (66, 1, 38, NULL, NULL, '2022-03-17 10:20:58', NULL);
INSERT INTO `role_permission` VALUES (67, 2, 35, NULL, NULL, '2022-03-17 10:20:58', NULL);
INSERT INTO `role_permission` VALUES (68, 2, 36, NULL, NULL, '2022-03-17 10:20:58', NULL);
INSERT INTO `role_permission` VALUES (69, 2, 37, NULL, NULL, '2022-03-17 10:20:58', NULL);
INSERT INTO `role_permission` VALUES (70, 2, 38, NULL, NULL, '2022-03-17 10:20:58', NULL);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `roles` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Superadmin', 1, '2021-06-25 21:34:26', '2021-06-25 21:34:26');
INSERT INTO `roles` VALUES (2, 'Admin', 1, '2021-06-26 06:34:26', '2021-06-26 06:34:26');
INSERT INTO `roles` VALUES (3, 'Member', 1, '2021-06-26 06:34:26', '2021-06-26 06:34:26');

-- ----------------------------
-- Table structure for services
-- ----------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of services
-- ----------------------------

-- ----------------------------
-- Table structure for sport_branch
-- ----------------------------
DROP TABLE IF EXISTS `sport_branch`;
CREATE TABLE `sport_branch`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sport_branch` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sport_branch
-- ----------------------------
INSERT INTO `sport_branch` VALUES (1, 'Sepak Bola', '1', 1, NULL, '2022-03-17 10:52:34', NULL, NULL);
INSERT INTO `sport_branch` VALUES (2, 'Futsal', '1', 1, NULL, '2022-03-17 10:52:55', NULL, NULL);
INSERT INTO `sport_branch` VALUES (3, 'Voli', '1', 1, NULL, '2022-03-17 10:53:17', NULL, NULL);
INSERT INTO `sport_branch` VALUES (4, 'Bulutangkis', '1', 1, NULL, '2022-03-17 10:53:37', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, 'superadmin@local.com', 'Super Administrator', '$2y$10$ao/iDtHHpF.aFrCkOZz5n.F52sjQqtGMVWfrkU2bFGxNhipH8tr.K', 1, NULL, NULL, '2021-06-25 21:34:26', '2021-06-25 21:34:26', NULL);
INSERT INTO `users` VALUES (2, 2, 'admin@local.com', 'Administrator', '$2y$10$ao/iDtHHpF.aFrCkOZz5n.F52sjQqtGMVWfrkU2bFGxNhipH8tr.K', 1, NULL, NULL, '2021-06-25 21:34:26', '2021-06-25 21:34:26', NULL);

SET FOREIGN_KEY_CHECKS = 1;

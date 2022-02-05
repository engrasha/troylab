/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : troylab

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-02-04 13:43:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'Admin', 'admin@example.com', null, '$2y$10$wGMLfptcfwM4J9kVhGaZjeVm6pjB38M7Of6qlFohA5WuZCul5N0Ru', 'a2wXUciTox2toQeNs1Jcc0iOyq9sQYzmHg9TmqfAszUfwq3HsG', '2022-02-04 21:32:21', '2022-02-04 21:32:21');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_admins_table', '1');
INSERT INTO `migrations` VALUES ('2', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('3', '2022_02_03_184816_create_schools_table', '1');
INSERT INTO `migrations` VALUES ('4', '2022_02_03_184817_create_students_table', '1');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for schools
-- ----------------------------
DROP TABLE IF EXISTS `schools`;
CREATE TABLE `schools` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of schools
-- ----------------------------
INSERT INTO `schools` VALUES ('1', 'School name', '1', null, '2022-02-04 21:32:21', '2022-02-04 21:32:21');

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `exam_assgin` int(11) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` bigint(20) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES ('1', 'student 3TeMVcMkaK', '1', '0', '10', '8kqCYrwiBV', '$2y$10$ftl8LEZFW2mJc4IOe/F.9ujSEbUzibp3eH6KT0GgoeY9pJr.17cnW', '1', null, 'o3ULfpYPQBmZfFf1kJPA0iFFCtZc23xT29WwUJIBOTN3AiDvJQ', '2022-02-04 21:32:20', '2022-02-04 21:32:20');
INSERT INTO `students` VALUES ('2', 'student AkXcF0Dzs6', '1', '0', '4', 'EFjZqXhTq0', '$2y$10$jIJn7.ypGoPaGPMQhl5HZO0.Ca7xLKLrYrcfsegBeGcYuVAwkFhsG', '1', null, '6DaLIrTSQfbpSAmdzR8mMthjdw8FeFsbvu78SImZezqildCtjd', '2022-02-04 21:32:20', '2022-02-04 21:32:20');
INSERT INTO `students` VALUES ('3', 'student onfgSZdSZ3', '1', '0', '3', '8sumIPyp94', '$2y$10$3tH9f2F8eIQ0LMIW6VETTuQyCIKccUd0pE8JJ6LORwofje3n3tUCm', '1', null, 'Hfr3OOuzXbZ3TYGcVO1VD1IkdlPR4kyTSGlrw7dCzAmxYK6MbE', '2022-02-04 21:32:20', '2022-02-04 21:32:20');
INSERT INTO `students` VALUES ('4', 'student r2wT75GZms', '1', '0', '1', 'BSP3WWsSfU', '$2y$10$ygVXgU1pqJR1/TKDyU1WQORKvPIG/Hv1xP4YXs5/z2LJYkALvPmG2', '1', null, 'rioNVd9RQBcmgfrIai92qeQaHjyA713NNIgfrx0bYd3zKiIgxC', '2022-02-04 21:32:20', '2022-02-04 21:32:20');
INSERT INTO `students` VALUES ('5', 'student R6sHmmT2Yi', '1', '0', '10', 'Bo8zkFbfsA', '$2y$10$A8z3gGveZkcGAV6dw/6IRON6yP.A9GRLkiDPWQxZ4V7zioMB8chbe', '1', null, 'GpIO0Y64Nw5EzofI3uA4XF4b7HfZFGRODJZqnmmVj1wItOKkss', '2022-02-04 21:32:21', '2022-02-04 21:32:21');
INSERT INTO `students` VALUES ('6', 'student TmzH5n7VjD', '1', '0', '8', 'ViZ2a3Ejrz', '$2y$10$M4HiKod5ei9YJf3jdUuqnupH/tJjutnk.J.YTL5OIu6ADKeYbndHO', '1', null, '6aL9SIfCcfbyRwejuGYHYvhwLtjlmQdMAJ8Ke4xpy3pRO4ON3j', '2022-02-04 21:32:21', '2022-02-04 21:32:21');
INSERT INTO `students` VALUES ('7', 'student ueOD7tdz1C', '1', '0', '5', 'j9yQeJ9qpK', '$2y$10$JbmzNE8TfNmFstLF9LXOIuivTm9i0aEifqpULZJp5HXOpS5eAq./q', '1', null, 'gTQXvKcWXTAwEP0FRAsSNCVJfvN750XRWhu6dQ7x7RlWr7XRls', '2022-02-04 21:32:21', '2022-02-04 21:32:21');
INSERT INTO `students` VALUES ('8', 'student UvFhBYf92A', '1', '0', '6', 'aIMYZSkZAY', '$2y$10$PZqar5O5bkl064S1FiUi.eqHX12kWiwV2O4sZTUY6N29zbk2wJRRi', '1', null, '0pvKDqC2RVs4slbIcxXDRjdjyjJAF3JxEy8BsuBWyo9IyC146I', '2022-02-04 21:32:21', '2022-02-04 21:32:21');
INSERT INTO `students` VALUES ('9', 'student 5z1OApFFLe', '1', '0', '1', 'SKkZL6V5wM', '$2y$10$ZsHtJap30N3QBkS8Lxo/6O46tDaStc84MR.a7QzLfr7LQMp12wGmy', '1', null, 'wD7kfjsY3PyxfBpiNww7xhAoNA6makr04f8sZ0k91b4wFrFWjh', '2022-02-04 21:32:21', '2022-02-04 21:32:21');
INSERT INTO `students` VALUES ('10', 'student 2zwZi0LkEv', '1', '0', '6', 'btUN1TWrVj', '$2y$10$GqPwmjKQ454SIw.dQsneKuAz4cQ1HQL0Mrnc3DdUrbNxdh/t0fLfC', '1', null, 'GBzncE2uoAFsEvzO8vWZziwZyAEC5g3gudBDMhZ6yj6E1GhQwW', '2022-02-04 21:32:21', '2022-02-04 21:32:21');
INSERT INTO `students` VALUES ('11', 'new student', '1', '1', '11', 'stu', '$2y$10$a6s4vXSxm1ZRfDG4DaZbWeeMLi4p75Ik9KLG60m4OP02PzscZ3oHS', '1', null, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3Ryb3lsYWIvYXBpL2xvZ2luIiwiaWF0IjoxNjQ0MDEwNTM2LCJleHAiOjE2NDQwMTQxMzYsIm5iZiI6MTY0NDAxMDUzNiwianRpIjoiaGJybndaNUY5NEFDWjRhQyIsInN1YiI6MTEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.AkMsWWhzQlC8d2fENFOBqNTHtCf2JLENeUCRSQXHbCo', '2022-02-04 21:35:17', '2022-02-04 21:35:36');

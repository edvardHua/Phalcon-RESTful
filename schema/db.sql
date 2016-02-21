/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-02-20 20:36:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_time` tinytext COLLATE utf8_bin,
  `creator_id` int(6) NOT NULL,
  `modified_time` tinytext COLLATE utf8_bin,
  `modifier` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '管理员', null, null, '0', null, null);
INSERT INTO `role` VALUES ('2', '用户', null, null, '0', null, null);

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `created_time` tinytext COLLATE utf8_bin,
  `creator` int(11) DEFAULT NULL,
  `isdeleted` tinyint(1) DEFAULT '0',
  `deleted_time` tinytext COLLATE utf8_bin,
  `deletor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id2` (`user_id`),
  KEY `fk_role_id2` (`role_id`),
  CONSTRAINT `fk_role_id2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  CONSTRAINT `fk_user_id2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '1', '1', null, null, '0', null, null);
INSERT INTO `role_user` VALUES ('2', '2', '2', null, null, '0', null, null);

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(64) COLLATE utf8_bin NOT NULL COMMENT '登录后，会有token',
  `user_id` int(11) NOT NULL,
  `auth` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `expire` tinytext COLLATE utf8_bin COMMENT '过期时间',
  `created_time` tinytext COLLATE utf8_bin COMMENT '创建时间',
  `logout_time` tinytext COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=508 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of token
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '用户名',
  `password` varchar(128) COLLATE utf8_bin DEFAULT NULL COMMENT '密码',
  `name` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '真实姓名',
  `organization` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '机构名',
  `title` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '职称',
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '电邮',
  `creator` int(11) DEFAULT NULL,
  `created_time` tinytext COLLATE utf8_bin,
  `modifier` int(11) DEFAULT NULL,
  `modified_time` tinytext COLLATE utf8_bin,
  `isdeleted` tinyint(4) DEFAULT '0',
  `deletor` int(11) DEFAULT NULL,
  `deleted_time` tinytext COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', null, 'Admin', '$2y$10$JjP2XjCo8/8fnZctZHqKieg3QkU7ucwcq8gDG8PLgpTR/6/s7a7gS', 'Edvard', null, 'Software Enginner', 'edvard_hua@live.com', null, 0x303030302D30302D30302030303A30303A3030, null, 0x303030302D30302D30302030303A30303A3030, '0', null, null);
INSERT INTO `user` VALUES ('2', null, 'MCAA2015', '$2y$10$JjP2XjCo8/8fnZctZHqKieg3QkU7ucwcq8gDG8PLgpTR/6/s7a7gS', null, null, null, null, null, null, null, null, '0', null, null);

-- ----------------------------
-- Table structure for `m_ninchi`
-- ----------------------------
DROP TABLE IF EXISTS `m_ninchi`;
CREATE TABLE `m_ninchi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `entry_date` datetime NOT NULL,
  `entry_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `delete_datetime` datetime DEFAULT NULL,
  `delete_user` int(11) DEFAULT NULL,
  `delete_flg` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

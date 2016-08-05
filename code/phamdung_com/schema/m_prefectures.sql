-- ----------------------------
-- Table structure for `m_prefectures`
-- ----------------------------
DROP TABLE IF EXISTS `m_prefectures`;
CREATE TABLE `m_prefectures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prefecture_name` varchar(255) NOT NULL,
  `entry_date` datetime NOT NULL,
  `entry_user` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `delete_datetime` datetime DEFAULT NULL,
  `delete_user` int(11) DEFAULT NULL,
  `delete_flg` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

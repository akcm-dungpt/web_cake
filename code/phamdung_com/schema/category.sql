DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `no` int(11) NOT NULL auto_increment,
  `sort_no` int(11) default NULL,
  `name` text,
  `delete_flg` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
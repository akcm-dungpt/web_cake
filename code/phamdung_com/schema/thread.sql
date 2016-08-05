DROP TABLE IF EXISTS `thread`;
CREATE TABLE  `thread` (
  `threadNo` int(11) NOT NULL auto_increment,
  `no` int(11) default NULL,
  `date` datetime default NULL,
  `flag` int(11) default NULL,
  `name` text,
  `mail` text,
  `title` text,
  `message` text,
  `id` varchar(255) default NULL,
  `public` int(11) default NULL,
  `attribute` int(11) default NULL,
  `delete_flg` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`threadNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
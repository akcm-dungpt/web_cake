DROP TABLE IF EXISTS `mail`;
CREATE TABLE  `mail` (
  `no` int(11) NOT NULL auto_increment,
  `date` datetime default NULL,
  `subject` text,
  `message` text,
  `mailFrom` text,
  `age` text,
  `gender` text,
  `zip` text,
  `pref` text,
  `attribute` text,
  `entryDay` text,
  `bbsmail` text,
  `institution` text,
  `enquete` text,
  PRIMARY KEY  (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
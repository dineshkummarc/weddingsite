/*
 weddingsite db schema for MySQL 5
 by Tom Duff <tduff@labrack.net>
 
 Note: ONLY run on a new database, all old data will be lost if you don't.
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `tblguestbook`
-- ----------------------------
DROP TABLE IF EXISTS `tblguestbook`;
CREATE TABLE `tblguestbook` (
  `id` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL DEFAULT 'Anonymous',
  `entry` text NOT NULL,
  `ipaddress` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `tblinvitees`
-- ----------------------------
DROP TABLE IF EXISTS `tblinvitees`;
CREATE TABLE `tblinvitees` (
  `id` smallint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `passcode` varchar(4) DEFAULT NULL,
  `invitedBy` varchar(5) DEFAULT 'bride',
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `guestName` varchar(100) DEFAULT NULL,
  `streetAddress` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` tinytext,
  `zip` tinytext,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `hasLoggedIn` tinyint(1) DEFAULT '0',
  `rsvpCode` tinyint(3) unsigned zerofill DEFAULT '001',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `tblregistries`
-- ----------------------------
DROP TABLE IF EXISTS `tblregistries`;
CREATE TABLE `tblregistries` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `storename` varchar(50) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `isActive` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `blocks`
-- ----------------------------
DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `blocked_user_id` int(10) NOT NULL,
  `blocked` int(1) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNI_contact_relation` (`user_id`,`blocked_user_id`) USING BTREE,
  KEY `FK_contacts-user` (`user_id`) USING BTREE,
  KEY `FK_contacts-blocked_user` (`blocked_user_id`) USING BTREE,
  CONSTRAINT `FK_contacts-user` FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_contacts-blocked_user` FOREIGN KEY (`blocked_user_id`) REFERENCES users(`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

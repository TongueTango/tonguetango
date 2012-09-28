-- ----------------------------
-- Table structure for `group_blocks`
-- ----------------------------
DROP TABLE IF EXISTS `group_blocks`;
CREATE TABLE `group_blocks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `blocked` int(1) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `delete_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNI_group_blocks_relation` (`user_id`,`group_id`) USING BTREE,
  KEY `FK_group_blocks_user` (`user_id`) USING BTREE,
  KEY `FK_group_blocks_group` (`group_id`) USING BTREE,
  CONSTRAINT `FK_group_blocks_user` FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_group_blocks_group` FOREIGN KEY (`group_id`) REFERENCES groups(`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

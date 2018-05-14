#user table
CREATE TABLE `user`(
    `id` int(11) unsigned NOT NULL auto_increment,
    `username` VARCHAR(20) NOT NULL DEFAULT '',
    `password` VARCHAR(50) NOT NULL DEFAULT '',
    `last_ip` VARCHAR(20) NOT NULL DEFAULT '',
    `is_admin` tinyint(1) NOT NULL DEFAULT 0,
    `avatar` VARCHAR(150) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


#page table
CREATE TABLE `page`(
    `id` int(11) unsigned NOT NULL auto_increment,
    `userid` int(11) unsigned NOT NULL DEFAULT 0,
    `title` VARCHAR(20) NOT NULL DEFAULT '',
    `content` text NOT NULL,
    `create_time` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    FOREIGN KEY(`userid`) references user(id),
    KEY userid(`userid`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

#comment table
CREATE TABLE `comment`(
    `id` int(11) unsigned NOT NULL auto_increment,
    `userid` int(11) unsigned NOT NULL DEFAULT 0,
    `pageid` int(11) unsigned NOT NULL DEFAULT 0,
    `content` VARCHAR(255) NOT NULL DEFAULT '',
    `create_time` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    FOREIGN KEY(`userid`) references user(id),
    FOREIGN KEY(`pageid`) references page(id),
    KEY userid(`userid`),
    KEY pageid(`pageid`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
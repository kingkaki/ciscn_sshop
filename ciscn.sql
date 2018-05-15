

#commoditys table
CREATE TABLE `commoditys`(
    `id` INT(11) unsigned NOT NULL auto_increment,
    `name` VARCHAR(200) NOT NULL DEFAULT '',
    `desc` VARCHAR(500) NOT NULL DEFAULT '',
    `amount` INT(11) unsigned NOT NULL DEFAULT 0,
    `price` FLOAT NOT NULL,
    KEY userid(`id`),
    UNIQUE KEY `name`(`name`) 
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

#user table
CREATE TABLE `user`(
    `id` int(11) unsigned NOT NULL auto_increment,
    `username` VARCHAR(50) NOT NULL DEFAULT '',
    `mail` VARCHAR(50) NOT NULL DEFAULT '',
    `password` VARCHAR(60) NOT NULL DEFAULT '',
    `integral` FLOAT NOT NULL,
    PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

#shopcar table
CREATE TABLE `shopcar`(
    `id` INT(11) unsigned NOT NULL auto_increment,
    `userid` int(11) unsigned NOT NULL DEFAULT 0,
    `commodityid` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`userid`) references user(id),
    FOREIGN KEY(`commodityid`) references commoditys(id)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

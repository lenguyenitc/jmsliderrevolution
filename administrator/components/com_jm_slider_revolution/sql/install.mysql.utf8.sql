CREATE TABLE IF NOT EXISTS `#__revslider_sliders` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`params` TEXT NOT NULL ,
`title` TINYTEXT NOT NULL ,
`alias` TINYTEXT NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__revslider_slides` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`slider_id` TEXT NOT NULL ,
`params` TEXT NOT NULL ,
`layers` TEXT NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__revslider_static_slides` (
id int(11) NOT NULL AUTO_INCREMENT,
slider_id int(11) NOT NULL,
params text NOT NULL,
layers text NOT NULL,
PRIMARY KEY (id)
) DEFAULT COLLATE=utf8_general_ci;
								
CREATE TABLE IF NOT EXISTS `#__revslider_settings` (
id int(11) NOT NULL AUTO_INCREMENT,
general TEXT NOT NULL,
params TEXT NOT NULL,
PRIMARY KEY (id)
) DEFAULT COLLATE=utf8_general_ci;
								
CREATE TABLE IF NOT EXISTS `#__revslider_css` (
id int(11) NOT NULL AUTO_INCREMENT,
handle TEXT NOT NULL,
settings TEXT,
hover TEXT,
params TEXT NOT NULL,
PRIMARY KEY (id)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__revslider_layer_animations` (
id int(11) NOT NULL AUTO_INCREMENT,
handle TEXT NOT NULL,
params TEXT NOT NULL,
PRIMARY KEY (id)
) DEFAULT COLLATE=utf8_general_ci;


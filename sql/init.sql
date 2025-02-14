
-- Create Tables
USE senate_sim;
DROP TABLE IF EXISTS `Committees`;
DROP TABLE IF EXISTS `Parties`;
DROP TABLE IF EXISTS `Bills`;
DROP TABLE IF EXISTS `Senators`;
DROP TABLE IF EXISTS `Votes`;
DROP TABLE IF EXISTS `Settings`;

-- Committees Table

CREATE TABLE `Committees`
(
    `co_id` 	        INT UNSIGNED AUTO_INCREMENT,
    `co_name`           TEXT NOT NULL,
    `co_location`       TEXT NOT NULL,
    PRIMARY KEY (`co_id`)
) ENGINE = InnoDB;

ALTER TABLE `Committees`
    AUTO_INCREMENT = 1001;
	
	
-- Parties Table
	
CREATE TABLE `Parties`
(
    `pa_id` 	        INT UNSIGNED AUTO_INCREMENT,
    `pa_name`           TEXT NOT NULL,
    `pa_location`       TEXT NOT NULL,
    `pa_color`          TEXT NOT NULL,
    PRIMARY KEY (`pa_id`)
) ENGINE = InnoDB;

ALTER TABLE `Parties`
    AUTO_INCREMENT = 1001;


-- Bills Table

CREATE TABLE `Bills`
(
    `bl_id` 	      INT UNSIGNED AUTO_INCREMENT,
    `bl_title`        TEXT NOT NULL,
    `bl_short_text`   LONGTEXT NOT NULL,
    `bl_url`          TEXT,
    PRIMARY KEY (`bl_id`)
) ENGINE = InnoDB;

ALTER TABLE `Bills`
    AUTO_INCREMENT = 1001;


-- Senators Table

CREATE TABLE `Senators`
(
    `se_id` 	      INT UNSIGNED AUTO_INCREMENT,
    `se_first_name`   TEXT NOT NULL,
	`se_last_name`    TEXT NOT NULL,
    `se_title`        TEXT NOT NULL,
    `se_co_id`        INT UNSIGNED,
    `se_pa_id`        INT UNSIGNED,
    PRIMARY KEY (`se_id`),
    CONSTRAINT FK_Senators_Committee FOREIGN KEY (`se_co_id`) REFERENCES Committees(`co_id`),
    CONSTRAINT FK_Senators_Parties FOREIGN KEY (`se_pa_id`) REFERENCES Parties(`pa_id`)
) ENGINE = InnoDB;

ALTER TABLE `Senators`
    AUTO_INCREMENT = 1001;

-- Votes

CREATE TABLE `Votes`
(
    `vo_id` 	      INT UNSIGNED AUTO_INCREMENT,
	`vo_vote`         TEXT NOT NULL,
    `vo_se_id`        INT UNSIGNED NOT NULL,
    `vo_bl_id`        INT UNSIGNED NOT NULL,
    PRIMARY KEY (`vo_id`),
    CONSTRAINT FK_Votes_Senators FOREIGN KEY (`vo_se_id`) REFERENCES Senators(`se_id`),
    CONSTRAINT FK_Votes_Bills FOREIGN KEY (`vo_bl_id`) REFERENCES Bills(`bl_id`)
) ENGINE = InnoDB;

ALTER TABLE `Votes`
    AUTO_INCREMENT = 1001;

-- Setings Table

CREATE TABLE `Settings`
(
    `se_id` 	      INT UNSIGNED AUTO_INCREMENT,
    `se_active_bill`  INT,
	PRIMARY KEY (`se_id`)
) ENGINE = InnoDB;

ALTER TABLE `Settings`
    AUTO_INCREMENT = 1001;


-- PartiesBills Table
CREATE TABLE `PartiesBills`
(
    `pb_id` 	      INT UNSIGNED AUTO_INCREMENT,
    `pb_view`         TEXT NOT NULL,
    `pb_pa_id`        INT UNSIGNED NOT NULL,
    `pb_bl_id`        INT UNSIGNED NOT NULL,
    PRIMARY KEY (`pb_id`),
    CONSTRAINT FK_PartiesBills_Parties FOREIGN KEY (`pb_pa_id`) REFERENCES Parties(`pa_id`),
    CONSTRAINT FK_PartiesBills_Bills FOREIGN KEY (`pb_bl_id`) REFERENCES Bills(`bl_id`)
) ENGINE = InnoDB;

ALTER TABLE `PartiesBills`
    AUTO_INCREMENT = 1001;

-- CommitteesBills Table
CREATE TABLE `CommitteesBills`
(
    `cb_id` 	      INT UNSIGNED AUTO_INCREMENT,
    `cb_co_id`        INT UNSIGNED NOT NULL,
    `cb_bl_id`        INT UNSIGNED NOT NULL,
    PRIMARY KEY (`cb_id`),
    CONSTRAINT FK_CommitteesBills_Committees FOREIGN KEY (`cb_co_id`) REFERENCES Committees(`co_id`),
    CONSTRAINT FK_CommitteesBills_Bills FOREIGN KEY (`cb_bl_id`) REFERENCES Bills(`bl_id`)
) ENGINE = InnoDB;

ALTER TABLE `PartiesBills`
    AUTO_INCREMENT = 1001;
	
-- Insert Test Data

INSERT INTO `Committees` (co_name, co_location) VALUES ('Budget', 'Main Room');
INSERT INTO `Committees` (co_name, co_location) VALUES ('Health Committee', 'Small Room');

INSERT INTO `Parties` (pa_name, pa_location, pa_color) VALUES ('Green', 'Small Room', '#31C905');
INSERT INTO `Parties` (pa_name, pa_location, pa_color) VALUES ('Orange', 'Large Room', '#FF9209');

INSERT INTO `Bills` (bl_title, bl_short_text, bl_url) VALUES ('SB 101', 'Intro Bill.', 'http://www.google.com');
INSERT INTO `Bills` (bl_title, bl_short_text, bl_url) VALUES ('SB 102', 'The Second Bill.', 'http://www.yahoo.com');

INSERT INTO `Senators` (se_first_name, se_last_name, se_title, se_co_id, se_pa_id) VALUES ('Jane', 'Smith', 'Leader', 1001, 1001);
INSERT INTO `Senators` (se_first_name, se_last_name, se_title) VALUES ('Pete', 'Roberts', 'Whip');

INSERT INTO `Votes` (vo_vote, vo_se_id, vo_bl_id) VALUES ('ABS', 1001, 1001);

INSERT INTO `Settings` (se_active_bill) VALUES ( 1001);

INSERT INTO `PartiesBills`(pb_view, pb_pa_id, pb_bl_id) VALUES ('FOR', 1001, 1001);
INSERT INTO `PartiesBills`(pb_view, pb_pa_id, pb_bl_id) VALUES ('AGAINST', 1002, 1001);
INSERT INTO `PartiesBills`(pb_view, pb_pa_id, pb_bl_id) VALUES ('AGAINST', 1001, 1002);
INSERT INTO `PartiesBills`(pb_view, pb_pa_id, pb_bl_id) VALUES ('FOR', 1002, 1002);

INSERT INTO `CommitteesBills`(cb_co_id, cb_bl_id) VALUES(1001, 1002);
INSERT INTO `CommitteesBills`(cb_co_id, cb_bl_id) VALUES(1002, 1001);

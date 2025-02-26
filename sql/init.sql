
USE senate_sim;

-- Clear Tables
DROP TABLE IF EXISTS `Committees`;
DROP TABLE IF EXISTS `Parties`;
DROP TABLE IF EXISTS `Bills`;
DROP TABLE IF EXISTS `Senators`;
DROP TABLE IF EXISTS `Settings`;
DROP TABLE IF EXISTS `PartiesBills`;
DROP TABLE IF EXISTS `CommitteesBills`;
DROP TABLE IF EXISTS `CommitteePositionTypes`;
DROP TABLE IF EXISTS `SenatorsCommittees`;
DROP TABLE IF EXISTS `VoteTypes`;
DROP TABLE IF EXISTS `Votes`;
DROP TABLE IF EXISTS `Admins`;

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
    `se_pa_id`        INT UNSIGNED,
    PRIMARY KEY (`se_id`),
    CONSTRAINT FK_Senators_Parties FOREIGN KEY (`se_pa_id`) REFERENCES Parties(`pa_id`)
) ENGINE = InnoDB;

ALTER TABLE `Senators`
    AUTO_INCREMENT = 1001;


-- PartyViewTypes Table
CREATE TABLE `PartyViewTypes`
(
    `pvt_id` 	      INT UNSIGNED AUTO_INCREMENT,
    `pvt_view`        TEXT NOT NULL,
    `pvt_color`       TEXT NOT NULL,
    PRIMARY KEY (`pvt_id`)
) ENGINE = InnoDB;

ALTER TABLE `PartyViewTypes`
    AUTO_INCREMENT = 1001;


-- PartiesBills Table
CREATE TABLE `PartiesBills`
(
    `pb_id` 	      INT UNSIGNED AUTO_INCREMENT,
    `pb_pvt_id`       INT UNSIGNED NOT NULL,
    `pb_pa_id`        INT UNSIGNED NOT NULL,
    `pb_bl_id`        INT UNSIGNED NOT NULL,
    PRIMARY KEY (`pb_id`),
    CONSTRAINT FK_PartiesBills_PartyViewTypes FOREIGN KEY (`pb_pvt_id`) REFERENCES PartyViewTypes(`pvt_id`),
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


-- CommitteePositionTypes Table
CREATE TABLE `CommitteePositionTypes`
(
    `cpt_id` 	      INT UNSIGNED AUTO_INCREMENT,
    `cpt_name`        TEXT NOT NULL,
    `cpt_order`       INT NOT NULL,
    PRIMARY KEY (`cpt_id`)
) ENGINE = InnoDB;

ALTER TABLE `CommitteePositionTypes`
    AUTO_INCREMENT = 1001;


-- SenatorsCommittees Table
CREATE TABLE `SenatorsCommittees`
(
    `sc_id` 	      INT UNSIGNED AUTO_INCREMENT,
    `sc_cpt_id`       INT UNSIGNED NOT NULL,
    `sc_se_id`        INT UNSIGNED NOT NULL,
    `sc_co_id`        INT UNSIGNED NOT NULL,
    PRIMARY KEY (`sc_id`),
    CONSTRAINT FK_SenatorsCommittees_CommitteePositionTypes FOREIGN KEY (`sc_cpt_id`) REFERENCES CommitteePositionTypes(`cpt_id`),
    CONSTRAINT FK_SenatorsCommittees_Senators FOREIGN KEY (`sc_se_id`) REFERENCES Senators(`se_id`),
    CONSTRAINT FK_SenatorsCommittees_Committees FOREIGN KEY (`sc_co_id`) REFERENCES Committees(`co_id`)
) ENGINE = InnoDB;

ALTER TABLE `SenatorsCommittees`
    AUTO_INCREMENT = 1001;
	
-- VoteTypes Table
CREATE TABLE `VoteTypes`
(
    `vt_id` 	      INT UNSIGNED AUTO_INCREMENT,
    `vt_name`         TEXT NOT NULL,
    `vt_color`        TEXT NOT NULL,
    PRIMARY KEY (`vt_id`)
) ENGINE = InnoDB;

ALTER TABLE `VoteTypes`
    AUTO_INCREMENT = 1001;

-- Votes Table
CREATE TABLE `Votes`
(
    `vo_id` 	      INT UNSIGNED AUTO_INCREMENT,
    `vo_vt_id`        INT UNSIGNED NOT NULL,
    `vo_se_id`        INT UNSIGNED NOT NULL,
    `vo_bl_id`        INT UNSIGNED NOT NULL,
    PRIMARY KEY (`vo_id`),
    CONSTRAINT FK_Votes_VoteTypes FOREIGN KEY (`vo_vt_id`) REFERENCES VoteTypes(`vt_id`),
    CONSTRAINT FK_Votes_Senators FOREIGN KEY (`vo_se_id`) REFERENCES Senators(`se_id`),
    CONSTRAINT FK_Votes_Bills FOREIGN KEY (`vo_bl_id`) REFERENCES Bills(`bl_id`)
) ENGINE = InnoDB;

ALTER TABLE `Votes`
    AUTO_INCREMENT = 1001;


-- Admins Table
CREATE TABLE `Admins`
(
    `ad_id` 	         INT UNSIGNED AUTO_INCREMENT,
    `ad_username`        TEXT NOT NULL,
    `ad_password`        TEXT NOT NULL,
    PRIMARY KEY (`ad_id`)
) ENGINE = InnoDB;

ALTER TABLE `Admins`
    AUTO_INCREMENT = 1001;



-- Settings Table

CREATE TABLE `Settings`
(
    `st_id` 	        INT UNSIGNED AUTO_INCREMENT,
    `st_start_session`  BOOLEAN NOT NULL,
    `st_active_bill`    INT UNSIGNED,
    `st_default_vt`     INT UNSIGNED NOT NULL,
    `st_default_pvt`    INT UNSIGNED NOT NULL,
	PRIMARY KEY (`st_id`),
    CONSTRAINT FK_Settings_Bills FOREIGN KEY (`st_active_bill`) REFERENCES Bills(`bl_id`),
    CONSTRAINT FK_Settings_VoteTypes FOREIGN KEY (`st_default_vt`) REFERENCES VoteTypes(`vt_id`)
) ENGINE = InnoDB;

ALTER TABLE `Settings`
    AUTO_INCREMENT = 1001;



-- Insert Test Data

INSERT INTO `Committees` (co_name, co_location) VALUES ('Budget', 'Main Room');
INSERT INTO `Committees` (co_name, co_location) VALUES ('Health Committee', 'Small Room');

INSERT INTO `Parties` (pa_name, pa_location, pa_color) VALUES ('Green', 'Small Room', '#31C905');
INSERT INTO `Parties` (pa_name, pa_location, pa_color) VALUES ('Orange', 'Large Room', '#FF9209');

INSERT INTO `Bills` (bl_title, bl_short_text, bl_url) VALUES ('SB 101', 'Intro Bill.', 'http://www.google.com');
INSERT INTO `Bills` (bl_title, bl_short_text, bl_url) VALUES ('SB 102', 'The Second Bill.', 'http://www.yahoo.com');

INSERT INTO `Senators` (se_first_name, se_last_name, se_title, se_pa_id) VALUES ('Jane', 'Smith', 'Leader', 1001);
INSERT INTO `Senators` (se_first_name, se_last_name, se_title) VALUES ('Pete', 'Roberts', 'Whip');

INSERT INTO `CommitteePositionTypes`(cpt_name, cpt_order) VALUES ('Chair', 1);
INSERT INTO `CommitteePositionTypes`(cpt_name, cpt_order) VALUES ('Vice-Chair', 2);
INSERT INTO `CommitteePositionTypes`(cpt_name, cpt_order) VALUES ('Member', 3);

INSERT INTO `PartyViewTypes`(pvt_view, pvt_color) VALUES ('NEUTRAL', '#FFFFFF');
INSERT INTO `PartyViewTypes`(pvt_view, pvt_color) VALUES ('FOR', '#00CD03');
INSERT INTO `PartyViewTypes`(pvt_view, pvt_color) VALUES ('AGAINST', '#ff0011');

INSERT INTO `PartiesBills`(pb_pvt_id, pb_pa_id, pb_bl_id) VALUES (1002, 1001, 1001);
INSERT INTO `PartiesBills`(pb_pvt_id, pb_pa_id, pb_bl_id) VALUES (1003, 1002, 1001);
INSERT INTO `PartiesBills`(pb_pvt_id, pb_pa_id, pb_bl_id) VALUES (1003, 1001, 1002);
INSERT INTO `PartiesBills`(pb_pvt_id, pb_pa_id, pb_bl_id) VALUES (1002, 1002, 1002);

INSERT INTO `CommitteesBills`(cb_co_id, cb_bl_id) VALUES(1001, 1002);
INSERT INTO `CommitteesBills`(cb_co_id, cb_bl_id) VALUES(1002, 1001);

INSERT INTO `SenatorsCommittees`(sc_cpt_id, sc_se_id, sc_co_id) VALUES(1001, 1001, 1001);

INSERT INTO `VoteTypes`(vt_name, vt_color) VALUES ('ABS', '#FFFFFF');
INSERT INTO `VoteTypes`(vt_name, vt_color) VALUES ('YEA', '#00CD03');
INSERT INTO `VoteTypes`(vt_name, vt_color) VALUES ('NAY', '#ff0011');
INSERT INTO `VoteTypes`(vt_name, vt_color) VALUES ('EXC', '#52e0ff');

INSERT INTO `Votes`(vo_vt_id, vo_se_id, vo_bl_id) VALUES (1004, 1001, 1001);
INSERT INTO `Votes`(vo_vt_id, vo_se_id, vo_bl_id) VALUES (1004, 1001, 1002);
INSERT INTO `Votes`(vo_vt_id, vo_se_id, vo_bl_id) VALUES (1004, 1002, 1001);
INSERT INTO `Votes`(vo_vt_id, vo_se_id, vo_bl_id) VALUES (1004, 1002, 1002);

INSERT INTO `Admins`(ad_username, ad_password)VALUES('admin', 'test123');

INSERT INTO `Settings` (st_start_session, st_active_bill, st_default_vt, st_default_pvt) VALUES ( 0, 1001, 1001, 1001);

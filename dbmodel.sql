
-- ------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- SixtyOne implementation : © <Your name here> <Your email address here>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-- -----

-- dbmodel.sql

-- This is the file where you are describing the database schema of your game
-- Basically, you just have to export from PhpMyAdmin your table structure and copy/paste
-- this export here.
-- Note that the database itself and the standard tables ("global", "stats", "gamelog" and "player") are
-- already created and must not be created here

-- Note: The database schema is created from this file when the game starts. If you modify this file,
--       you have to restart a game to see your changes in database.

-- Example 1: create a standard "card" table to be used with the "Deck" tools (see example game "hearts"):

-- CREATE TABLE IF NOT EXISTS `card` (
--   `card_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
--   `card_type` varchar(16) NOT NULL,
--   `card_type_arg` int(11) NOT NULL,
--   `card_location` varchar(16) NOT NULL,
--   `card_location_arg` int(11) NOT NULL,
--   PRIMARY KEY (`card_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- Example 2: add a custom field to the standard "player" table
-- ALTER TABLE `player` ADD `player_my_custom_field` INT UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `player` ADD `die_1` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `die_2` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `die_3` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `location_chosen` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `score_area_1` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `score_area_2` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `score_area_3` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `score_area_4` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `score_area_5` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `score_area_6` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_1_1` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_1_2` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_1_3` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_1_4` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_2_1` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_2_2` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_2_3` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_2_4` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_2_5` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_3_1_1` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_3_1_2` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_3_2_1` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_3_2_2` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_3_2_3` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_4_1` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_4_2` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_4_3` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_4_4` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_4_5` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_4_6` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_5_1` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_5_2` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_5_3` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_5_4` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_5_5` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_5_6` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_6_1` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_6_2` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_6_3` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_6_4` INT UNSIGNED DEFAULT NULL;
ALTER TABLE `player` ADD `area_6_5` INT UNSIGNED DEFAULT NULL;

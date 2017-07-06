-- MySQL Workbench Synchronization
-- Generated: 2017-06-20 19:36
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Orlando J Betancourth Alvareng

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `portfoliomanager`.`portafolio_documento`
ADD COLUMN `documentourl` VARCHAR(256) NULL DEFAULT NULL AFTER `documentoultimaversion`;

ALTER TABLE `portfoliomanager`.`portafolio_documento`
CHANGE COLUMN `documentoportafolio` `documentoportafolio` BIGINT(18) NOT NULL AUTO_INCREMENT ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

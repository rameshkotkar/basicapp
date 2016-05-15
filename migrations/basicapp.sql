-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema basicapp
-- -----------------------------------------------------
-- Basic App 

 
-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(50) NOT NULL,
  `lastname` VARCHAR(50) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `auth_key` VARCHAR(32) NOT NULL,
  `password_reset_token` VARCHAR(100) NULL,
  `contact` VARCHAR(15) NOT NULL,
  `country` CHAR(2) NOT NULL,
  `access_token` VARCHAR(100) NOT NULL,
  `type` TINYINT(2) UNSIGNED NOT NULL COMMENT '0-User\n1-Administrator\n2-Manager',
  `status` TINYINT(2) UNSIGNED NOT NULL COMMENT '0-Inactive\n1-Active\n2-Suspend',
  `created_at` INT UNSIGNED NOT NULL,
  `updated_at` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `api_key_UNIQUE` (`access_token` ASC))
ENGINE = InnoDB
COMMENT = 'User data will be stored.';



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

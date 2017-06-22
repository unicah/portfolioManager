-- MySQL Workbench Synchronization
-- Generated: 2017-06-10 11:45
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Orlando J Betancourth Alvareng

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER SCHEMA `portfoliomanager`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci ;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`usuario` (
  `usuariocod` BIGINT(10) NOT NULL AUTO_INCREMENT,
  `usuarioemail` VARCHAR(80) NULL DEFAULT NULL,
  `usuarionom` VARCHAR(80) NULL DEFAULT NULL,
  `usuariopswd` VARCHAR(128) NULL DEFAULT NULL,
  `usuariofching` DATETIME NULL DEFAULT NULL,
  `usuariopswdest` CHAR(3) NULL DEFAULT NULL,
  `usuariopswdexp` DATETIME NULL DEFAULT NULL,
  `usuarioest` CHAR(3) NULL DEFAULT NULL,
  `usuarioactcod` VARCHAR(128) NULL DEFAULT NULL,
  `usuariopswdchg` VARCHAR(128) NULL DEFAULT NULL,
  `usuariotipo` CHAR(3) NULL DEFAULT NULL COMMENT 'Tipo de Usuario, Normal, Consultor o Cliente',
  PRIMARY KEY (`usuariocod`),
  UNIQUE INDEX `usuarioemail_UNIQUE` (`usuarioemail` ASC),
  INDEX `usuariotipo` (`usuariotipo` ASC, `usuarioemail` ASC, `usuariocod` ASC, `usuarioest` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`roles` (
  `rolescod` VARCHAR(15) NOT NULL,
  `rolesdsc` VARCHAR(45) NULL DEFAULT NULL,
  `rolesest` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`rolescod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`roles_usuarios` (
  `usuariocod` BIGINT(10) NOT NULL,
  `rolescod` VARCHAR(15) NOT NULL,
  `roleusuarioest` CHAR(3) NULL DEFAULT NULL,
  `roleusuariofch` DATETIME NULL DEFAULT NULL,
  `roleusuarioexp` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`usuariocod`, `rolescod`),
  INDEX `rol_usuario_key_idx` (`rolescod` ASC),
  CONSTRAINT `usuario_rol_key`
    FOREIGN KEY (`usuariocod`)
    REFERENCES `portfoliomanager`.`usuario` (`usuariocod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `rol_usuario_key`
    FOREIGN KEY (`rolescod`)
    REFERENCES `portfoliomanager`.`roles` (`rolescod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`programa_roles` (
  `rolescod` VARCHAR(15) NOT NULL,
  `programacod` VARCHAR(15) NOT NULL,
  `programarolest` CHAR(3) NULL DEFAULT NULL,
  `programarolexp` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`rolescod`, `programacod`),
  INDEX `rol_programa_key_idx` (`programacod` ASC),
  CONSTRAINT `programa_rol_key`
    FOREIGN KEY (`rolescod`)
    REFERENCES `portfoliomanager`.`roles` (`rolescod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `rol_programa_key`
    FOREIGN KEY (`programacod`)
    REFERENCES `portfoliomanager`.`programas` (`programacod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`programas` (
  `programacod` VARCHAR(15) NOT NULL,
  `programadsc` VARCHAR(45) NULL DEFAULT NULL,
  `programaest` CHAR(3) NULL DEFAULT NULL,
  `programatyp` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`programacod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`portafolio` (
  `portafoliocodigo` BIGINT(18) NOT NULL AUTO_INCREMENT,
  `portafolionombre` VARCHAR(128) NULL DEFAULT NULL,
  `portafoliofechacreado` DATETIME NULL DEFAULT NULL,
  `portafolioobservacion` VARCHAR(5000) NULL DEFAULT NULL,
  `portafolioestado` CHAR(3) NULL DEFAULT NULL,
  `departamentocodigo` INT(10) NOT NULL,
  PRIMARY KEY (`portafoliocodigo`),
  INDEX `fk_portafolio_departamento1_idx` (`departamentocodigo` ASC),
  CONSTRAINT `fk_portafolio_departamento1`
    FOREIGN KEY (`departamentocodigo`)
    REFERENCES `portfoliomanager`.`departamento` (`departamentocodigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`portafolio_rol` (
  `rolportafolio` CHAR(3) NOT NULL,
  `portafoliocodigo` BIGINT(18) NOT NULL,
  `rolportafolionombre` VARCHAR(45) NULL DEFAULT NULL,
  `rolportafolioestado` CHAR(3) NULL DEFAULT NULL,
  `roledicion` CHAR(3) NULL DEFAULT NULL,
  `rolvisualiza` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`rolportafolio`, `portafoliocodigo`),
  INDEX `fk_portafolio_roles_portafolio1_idx` (`portafoliocodigo` ASC),
  CONSTRAINT `fk_portafolio_roles_portafolio1`
    FOREIGN KEY (`portafoliocodigo`)
    REFERENCES `portfoliomanager`.`portafolio` (`portafoliocodigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`portafolio_categoria` (
  `categoriaportafolio` CHAR(3) NOT NULL,
  `portafoliocodigo` BIGINT(18) NOT NULL,
  `categoriaportafolionombre` VARCHAR(45) NULL DEFAULT NULL,
  `categoriaportafolioestado` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`categoriaportafolio`, `portafoliocodigo`),
  INDEX `fk_portafolio_categoria_portafolio1_idx` (`portafoliocodigo` ASC),
  CONSTRAINT `fk_portafolio_categoria_portafolio1`
    FOREIGN KEY (`portafoliocodigo`)
    REFERENCES `portfoliomanager`.`portafolio` (`portafoliocodigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`portafolio_flujo` (
  `flujoportafolio` CHAR(3) NOT NULL,
  `portafoliocodigo` BIGINT(18) NOT NULL,
  `flujoportafolionombre` VARCHAR(45) NULL DEFAULT NULL,
  `flujoportafolioestado` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`flujoportafolio`, `portafoliocodigo`),
  INDEX `fk_portafolio_flujo_portafolio1_idx` (`portafoliocodigo` ASC),
  CONSTRAINT `fk_portafolio_flujo_portafolio1`
    FOREIGN KEY (`portafoliocodigo`)
    REFERENCES `portfoliomanager`.`portafolio` (`portafoliocodigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`portafolio_documento` (
  `documentoportafolio` BIGINT(18) NOT NULL,
  `portafoliocodigo` BIGINT(18) NOT NULL,
  `documentoportafoliocodigo` VARCHAR(45) NOT NULL,
  `documentoportafolioflujoactual` CHAR(3) NULL DEFAULT NULL,
  `documentoportafolioestado` CHAR(3) NULL DEFAULT NULL,
  `documentoportafolioobservacion` VARCHAR(5000) NULL DEFAULT NULL,
  `categoriaportafolio` CHAR(3) NULL DEFAULT NULL,
  `documentofechamodificado` DATETIME NULL DEFAULT NULL,
  `documentoversionactual` INT(10) NULL DEFAULT NULL,
  `documentoeditoractual` BIGINT(18) NULL DEFAULT NULL,
  `documentodescripcion` VARCHAR(120) NULL DEFAULT NULL,
  `documentofichero` VARCHAR(120) NULL DEFAULT NULL,
  `documentoextencion` VARCHAR(10) NULL DEFAULT NULL,
  `documentousuarioingresa` BIGINT(10) NOT NULL,
  `documentousuariomodifica` BIGINT(10) NULL DEFAULT NULL,
  `documentoultimocomentario` INT(10) NULL DEFAULT NULL,
  `documentoultimalarma` INT(10) NULL DEFAULT NULL,
  `documentoultimaversion` INT(10) NULL DEFAULT NULL,
  PRIMARY KEY (`documentoportafolio`),
  UNIQUE INDEX `documentoportafoliocodigo_UNIQUE` (`documentoportafoliocodigo` ASC),
  INDEX `fk_portafolio_documento_portafolio1_idx` (`portafoliocodigo` ASC),
  INDEX `fk_portafolio_documento_portafolio_categoria1_idx` (`categoriaportafolio` ASC),
  INDEX `fk_portafolio_documento_portafolio_flujo1_idx` (`documentoportafolioflujoactual` ASC),
  INDEX `fk_portafolio_documento_usuario1_idx` (`documentousuarioingresa` ASC),
  INDEX `fk_portafolio_documento_usuario2_idx` (`documentousuariomodifica` ASC),
  CONSTRAINT `fk_portafolio_documento_portafolio1`
    FOREIGN KEY (`portafoliocodigo`)
    REFERENCES `portfoliomanager`.`portafolio` (`portafoliocodigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portafolio_documento_portafolio_categoria1`
    FOREIGN KEY (`categoriaportafolio`)
    REFERENCES `portfoliomanager`.`portafolio_categoria` (`categoriaportafolio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portafolio_documento_portafolio_flujo1`
    FOREIGN KEY (`documentoportafolioflujoactual`)
    REFERENCES `portfoliomanager`.`portafolio_flujo` (`flujoportafolio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portafolio_documento_usuario1`
    FOREIGN KEY (`documentousuarioingresa`)
    REFERENCES `portfoliomanager`.`usuario` (`usuariocod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portafolio_documento_usuario2`
    FOREIGN KEY (`documentousuariomodifica`)
    REFERENCES `portfoliomanager`.`usuario` (`usuariocod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`portafolio_documento_bitacora` (
  `bitacoradocumento` BIGINT(18) NOT NULL AUTO_INCREMENT,
  `documentoportafolio` BIGINT(18) NOT NULL,
  `bitacorafecha` DATETIME NULL DEFAULT NULL,
  `bitacoratipo` CHAR(3) NULL DEFAULT NULL,
  `bitacoraprograma` VARCHAR(45) NULL DEFAULT NULL,
  `bitacorausuario` BIGINT(10) NULL DEFAULT NULL,
  `bitacoraobjeto` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`bitacoradocumento`),
  INDEX `fk_portafolio_documento_bitacora_portafolio_documento1_idx` (`documentoportafolio` ASC),
  INDEX `fk_portafolio_documento_bitacora_usuario1_idx` (`bitacorausuario` ASC),
  CONSTRAINT `fk_portafolio_documento_bitacora_portafolio_documento1`
    FOREIGN KEY (`documentoportafolio`)
    REFERENCES `portfoliomanager`.`portafolio_documento` (`documentoportafolio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portafolio_documento_bitacora_usuario1`
    FOREIGN KEY (`bitacorausuario`)
    REFERENCES `portfoliomanager`.`usuario` (`usuariocod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`portafolio_documento_version` (
  `documentoversion` INT(10) NOT NULL,
  `documentoportafolio` BIGINT(18) NOT NULL,
  `versionfechaingreso` DATETIME NULL DEFAULT NULL,
  `versionusuarioingresa` BIGINT(10) NULL DEFAULT NULL,
  `versionobservacion` VARCHAR(256) NULL DEFAULT NULL,
  `versionobservacionsistema` VARCHAR(256) NULL DEFAULT NULL,
  `versionurl` VARCHAR(256) NULL DEFAULT NULL,
  `versionhash` VARCHAR(128) NULL DEFAULT NULL,
  PRIMARY KEY (`documentoversion`, `documentoportafolio`),
  INDEX `fk_portafolio_documento_version_portafolio_documento1_idx` (`documentoportafolio` ASC),
  INDEX `fk_portafolio_documento_version_usuario1_idx` (`versionusuarioingresa` ASC),
  CONSTRAINT `fk_portafolio_documento_version_portafolio_documento1`
    FOREIGN KEY (`documentoportafolio`)
    REFERENCES `portfoliomanager`.`portafolio_documento` (`documentoportafolio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portafolio_documento_version_usuario1`
    FOREIGN KEY (`versionusuarioingresa`)
    REFERENCES `portfoliomanager`.`usuario` (`usuariocod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`portafolio_colaboradores` (
  `portafoliocodigo` BIGINT(18) NOT NULL,
  `usuariocod` BIGINT(10) NOT NULL,
  `rolportafolio` CHAR(3) NOT NULL,
  `colaboradorestado` CHAR(3) NULL DEFAULT NULL,
  `colaboradorfechaexpira` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`portafoliocodigo`, `usuariocod`),
  INDEX `fk_portafolio_colaboradores_usuario1_idx` (`usuariocod` ASC),
  CONSTRAINT `fk_portafolio_colaboradores_portafolio1`
    FOREIGN KEY (`portafoliocodigo`)
    REFERENCES `portfoliomanager`.`portafolio` (`portafoliocodigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portafolio_colaboradores_usuario1`
    FOREIGN KEY (`usuariocod`)
    REFERENCES `portfoliomanager`.`usuario` (`usuariocod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`portafolio_documento_colaboradores` (
  `documentoportafolio` BIGINT(18) NOT NULL,
  `usuariocod` BIGINT(10) NOT NULL,
  `documentoedicion` CHAR(3) NULL DEFAULT NULL,
  `documentocolaboradorfechaexpira` DATETIME NULL DEFAULT NULL,
  `documentocolaboradorestado` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`documentoportafolio`, `usuariocod`),
  INDEX `fk_portafolio_documento_colaboradores_usuario1_idx` (`usuariocod` ASC),
  CONSTRAINT `fk_portafolio_documento_colaboradores_portafolio_documento1`
    FOREIGN KEY (`documentoportafolio`)
    REFERENCES `portfoliomanager`.`portafolio_documento` (`documentoportafolio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portafolio_documento_colaboradores_usuario1`
    FOREIGN KEY (`usuariocod`)
    REFERENCES `portfoliomanager`.`usuario` (`usuariocod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`portafolio_documento_comentario` (
  `portafoliodocumento` BIGINT(13) NOT NULL,
  `documentocomentariocodigo` INT(10) NOT NULL,
  `documentocomentario` VARCHAR(2000) NOT NULL,
  `documentousuarioingresa` BIGINT(10) NOT NULL,
  `documentocomentariofecha` DATETIME NULL DEFAULT NULL,
  `documentocomentarioestado` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`portafoliodocumento`, `documentocomentariocodigo`),
  INDEX `fk_portafolio_documento_comentario_usuario1_idx` (`documentousuarioingresa` ASC),
  CONSTRAINT `fk_portafolio_documento_comentario_portafolio_documento1`
    FOREIGN KEY (`portafoliodocumento`)
    REFERENCES `portfoliomanager`.`portafolio_documento` (`documentoportafolio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portafolio_documento_comentario_usuario1`
    FOREIGN KEY (`documentousuarioingresa`)
    REFERENCES `portfoliomanager`.`usuario` (`usuariocod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`portafolio_documento_alarma` (
  `documentoportafolio` BIGINT(18) NOT NULL,
  `alarmacodigo` INT(10) NOT NULL,
  `alarmaFechaHora` DATETIME NOT NULL,
  `alarmaenviartodos` CHAR(3) NULL DEFAULT NULL,
  `alarmausuarioingresa` BIGINT(10) NULL DEFAULT NULL,
  `alarmafechaingresa` DATETIME NULL DEFAULT NULL,
  `alarmaestado` CHAR(3) NULL DEFAULT NULL,
  `alarmausuariodestino` BIGINT(10) NULL DEFAULT NULL,
  PRIMARY KEY (`documentoportafolio`, `alarmacodigo`),
  INDEX `fk_portafolio_documento_alarma_usuario1_idx` (`alarmausuarioingresa` ASC),
  INDEX `fk_portafolio_documento_alarma_usuario2_idx` (`alarmausuariodestino` ASC),
  CONSTRAINT `fk_portafolio_documento_alarma_portafolio_documento1`
    FOREIGN KEY (`documentoportafolio`)
    REFERENCES `portfoliomanager`.`portafolio_documento` (`documentoportafolio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portafolio_documento_alarma_usuario1`
    FOREIGN KEY (`alarmausuarioingresa`)
    REFERENCES `portfoliomanager`.`usuario` (`usuariocod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portafolio_documento_alarma_usuario2`
    FOREIGN KEY (`alarmausuariodestino`)
    REFERENCES `portfoliomanager`.`usuario` (`usuariocod`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfoliomanager`.`departamento` (
  `departamentocodigo` INT(10) NOT NULL AUTO_INCREMENT,
  `departmanetodesc` VARCHAR(128) NULL DEFAULT NULL,
  `departamentoest` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`departamentocodigo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

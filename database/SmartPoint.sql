-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema SmartPoint
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema SmartPoint
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `SmartPoint` DEFAULT CHARACTER SET utf8mb4 ;
USE `SmartPoint` ;

-- -----------------------------------------------------
-- Table `SmartPoint`.`clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SmartPoint`.`clientes` ;

CREATE TABLE IF NOT EXISTS `SmartPoint`.`clientes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido1` VARCHAR(45) NOT NULL,
  `apellido2` VARCHAR(45) NULL,
  `telefono` VARCHAR(100) NOT NULL,
  `fecha_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `deuda` DECIMAL(10,2) NULL,
  `calle` VARCHAR(100) NULL DEFAULT NULL,
  `numero` VARCHAR(10) NULL,
  `colonia` VARCHAR(100) NULL,
  `cod_postal` VARCHAR(10) NULL,
  `ciudad` VARCHAR(50) NOT NULL,
  `estado` VARCHAR(50) NOT NULL,
  `pais` VARCHAR(45) NOT NULL DEFAULT 'Mexico',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `SmartPoint`.`abonos_clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SmartPoint`.`abonos_clientes` ;

CREATE TABLE IF NOT EXISTS `SmartPoint`.`abonos_clientes` (
  `id` INT(11) NOT NULL,
  `monto` DECIMAL(10,2) NOT NULL,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `cliente_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `cliente_id`),
  INDEX `fk_abonos_clientes1_idx` (`cliente_id` ASC) VISIBLE,
  UNIQUE INDEX `monto_UNIQUE` (`monto` ASC) VISIBLE,
  CONSTRAINT `fk_abonos_clientes1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `SmartPoint`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `SmartPoint`.`proveedores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SmartPoint`.`proveedores` ;

CREATE TABLE IF NOT EXISTS `SmartPoint`.`proveedores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(100) NOT NULL,
  `fecha_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `deuda` DECIMAL(10,2) NULL,
  `calle` VARCHAR(100) NULL,
  `numero` VARCHAR(10) NULL,
  `colonia` VARCHAR(100) NULL,
  `cod_postal` VARCHAR(10) NULL,
  `ciudad` VARCHAR(50) NOT NULL,
  `estado` VARCHAR(50) NOT NULL,
  `pais` VARCHAR(50) NOT NULL DEFAULT 'Mexico',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `SmartPoint`.`abonos_proveedores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SmartPoint`.`abonos_proveedores` ;

CREATE TABLE IF NOT EXISTS `SmartPoint`.`abonos_proveedores` (
  `id` INT(11) NOT NULL,
  `monto` DECIMAL(10,2) NOT NULL,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `proveedor_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `proveedor_id`),
  INDEX `fk_abonospro_proveedores1_idx` (`proveedor_id` ASC) VISIBLE,
  CONSTRAINT `fk_abonospro_proveedores1`
    FOREIGN KEY (`proveedor_id`)
    REFERENCES `SmartPoint`.`proveedores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `SmartPoint`.`empresas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SmartPoint`.`empresas` ;

CREATE TABLE IF NOT EXISTS `SmartPoint`.`empresas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `SmartPoint`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SmartPoint`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `SmartPoint`.`usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `rol` VARCHAR(45) NULL DEFAULT NULL,
  `empresa_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `empresa_id`),
  INDEX `fk_usuarios_config1_idx` (`empresa_id` ASC) VISIBLE,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE,
  CONSTRAINT `fk_usuarios_config1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `SmartPoint`.`empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `SmartPoint`.`ventas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SmartPoint`.`ventas` ;

CREATE TABLE IF NOT EXISTS `SmartPoint`.`ventas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `metodo_pago` VARCHAR(45) NULL DEFAULT NULL,
  `total` DECIMAL(10,2) NOT NULL,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `cliente_id` INT(11) NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`, `cliente_id`),
  INDEX `fk_ventas_clientes1_idx` (`cliente_id` ASC) VISIBLE,
  INDEX `fk_ventas_usuarios1_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_ventas_clientes1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `SmartPoint`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ventas_usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `SmartPoint`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `SmartPoint`.`productos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SmartPoint`.`productos` ;

CREATE TABLE IF NOT EXISTS `SmartPoint`.`productos` (
  `cod_pro` VARCHAR(50) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `cantidad` DECIMAL(10,2) NOT NULL,
  `precio` DECIMAL(10,2) NOT NULL,
  `st_minimos` DECIMAL(10,2) NULL DEFAULT NULL,
  `st_maximos` DECIMAL(10,2) NULL DEFAULT NULL,
  `piezas` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`cod_pro`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `SmartPoint`.`detalles_ventas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SmartPoint`.`detalles_ventas` ;

CREATE TABLE IF NOT EXISTS `SmartPoint`.`detalles_ventas` (
  `cod_pro` VARCHAR(50) NOT NULL,
  `venta_id` INT(11) NOT NULL,
  `cantidad` DECIMAL(10,2) NOT NULL,
  INDEX `fk_detalle_ventas1_idx` (`venta_id` ASC) VISIBLE,
  INDEX `fk_detalles_productos1_idx` (`cod_pro` ASC) VISIBLE,
  PRIMARY KEY (`cod_pro`, `venta_id`),
  CONSTRAINT `fk_detalle_ventas1`
    FOREIGN KEY (`venta_id`)
    REFERENCES `SmartPoint`.`ventas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalles_productos1`
    FOREIGN KEY (`cod_pro`)
    REFERENCES `SmartPoint`.`productos` (`cod_pro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 19
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `SmartPoint`.`surtidos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SmartPoint`.`surtidos` ;

CREATE TABLE IF NOT EXISTS `SmartPoint`.`surtidos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `metodo_pago` VARCHAR(45) NULL DEFAULT NULL,
  `total` DECIMAL(10,2) NOT NULL,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `usuario_id` INT NOT NULL,
  `proveedor_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`, `proveedor_id`),
  INDEX `fk_surtir_proveedor1_idx` (`proveedor_id` ASC) VISIBLE,
  INDEX `fk_surtir_usuarios1_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_surtir_proveedor1`
    FOREIGN KEY (`proveedor_id`)
    REFERENCES `SmartPoint`.`proveedores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_surtir_usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `SmartPoint`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `SmartPoint`.`detalles_surtidos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SmartPoint`.`detalles_surtidos` ;

CREATE TABLE IF NOT EXISTS `SmartPoint`.`detalles_surtidos` (
  `cod_pro` VARCHAR(50) NOT NULL,
  `surtido_id` INT(11) NOT NULL,
  `cantidad` DECIMAL(10,2) NOT NULL,
  `precio_compra` DECIMAL(10,2) NOT NULL,
  INDEX `fk_detallesurtir_surtir_idx` (`surtido_id` ASC) VISIBLE,
  INDEX `fk_detallesurtir_productos1_idx` (`cod_pro` ASC) VISIBLE,
  PRIMARY KEY (`surtido_id`, `cod_pro`),
  CONSTRAINT `fk_detallesurtir_surtir`
    FOREIGN KEY (`surtido_id`)
    REFERENCES `SmartPoint`.`surtidos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detallesurtir_productos1`
    FOREIGN KEY (`cod_pro`)
    REFERENCES `SmartPoint`.`productos` (`cod_pro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `SmartPoint`.`transacciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SmartPoint`.`transacciones` ;

CREATE TABLE IF NOT EXISTS `SmartPoint`.`transacciones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `tipo` VARCHAR(100) NOT NULL,
  `monto` DECIMAL(10,2) NOT NULL,
  `descripcion` VARCHAR(100) NULL DEFAULT NULL,
  `usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`),
  INDEX `fk_transaccioncaja_usuarios1_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_transaccioncaja_usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `SmartPoint`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 21
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

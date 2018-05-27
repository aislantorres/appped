SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `boletodb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `boletodb` ;

-- -----------------------------------------------------
-- Table `boletodb`.`empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `boletodb`.`empresa` (
  `em_id` INT NOT NULL AUTO_INCREMENT,
  `em_nome` VARCHAR(80) NULL,
  `em_endereco` VARCHAR(100) NULL,
  `em_bairro` VARCHAR(40) NULL,
  `em_cep` VARCHAR(8) NULL,
  `em_cidade` VARCHAR(45) NULL,
  `em_uf` VARCHAR(2) NULL,
  `em_cnpj` VARCHAR(14) NULL,
  `em_agencia` VARCHAR(5) NULL,
  `em_conta` VARCHAR(15) NULL,
  `em_convenio` VARCHAR(20) NULL,
  PRIMARY KEY (`em_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `boletodb`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `boletodb`.`cliente` (
  `cl_id` INT NOT NULL AUTO_INCREMENT,
  `cl_nome` VARCHAR(80) NULL,
  `cl_endereco` VARCHAR(100) NULL,
  `cl_complemento` VARCHAR(20) NULL,
  `cl_bairro` VARCHAR(80) NULL,
  `cl_cep` VARCHAR(8) NULL,
  `cl_cidade` VARCHAR(45) NULL,
  `cl_uf` VARCHAR(2) NULL,
  `cl_cpfCnpj` VARCHAR(14) NULL,
  `cl_senha` VARCHAR(45) NULL,
  `cl_tipo` VARCHAR(1) NULL COMMENT 'Tipo de cliente.1- Socio = pode apenas imprimir boleto 9- Administrador = Gerencia usuarios, imprime boletos, envia remessa e envia retorno',
  `cl_email` VARCHAR(150) NULL,
  `cl_telefone` VARCHAR(15) NULL,
  `cl_celular` VARCHAR(15) NULL,
  PRIMARY KEY (`cl_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `boletodb`.`titulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `boletodb`.`titulo` (
  `tl_id` INT NOT NULL AUTO_INCREMENT,
  `tl_idEmpresa` INT NULL,
  `tl_idCliente` INT NULL,
  `tl_banco` VARCHAR(5) NULL,
  `tl_dataDoc` DATETIME NULL,
  `tl_numeroDoc` VARCHAR(20) NULL,
  `tl_especie` VARCHAR(10) NULL,
  `tl_especieDoc` VARCHAR(10) NULL,
  `tl_aceite` VARCHAR(1) NULL,
  `tl_dataProcessa` DATETIME NULL,
  `tl_dataVencto` DATETIME NULL,
  `tl_agencia` VARCHAR(5) NULL,
  `tl_agenciaDV` VARCHAR(1) NULL,
  `tl_conta` VARCHAR(15) NULL,
  `tl_contaDV` VARCHAR(1) NULL,
  `tl_carteira` VARCHAR(4) NULL,
  `tl_convenio` VARCHAR(20) NULL,
  `tl_nossoNumero` VARCHAR(20) NULL,
  `tl_linhaDigitavel` VARCHAR(45) NULL,
  `tl_valor` FLOAT NULL,
  `tl_desconto` FLOAT NULL,
  `tl_abatimento` FLOAT NULL,
  `tl_mora` FLOAT NULL,
  `tl_outrosAcrescimos` FLOAT NULL,
  `tl_valorCobrado` FLOAT NULL,
  `tl_msg1` VARCHAR(255) NULL,
  `tl_msg2` VARCHAR(255) NULL,
  `tl_msg3` VARCHAR(255) NULL,
  `tl_dmaBaixa` DATETIME NULL,
  `tl_situacao` VARCHAR(1) NULL COMMENT '0-Titulo em aberto , pode ser impresso 1- titulo liquidado - ja foi pago, não pode ser reimpresso',
  PRIMARY KEY (`tl_id`),
  INDEX `IDEMPRESA_idx` (`tl_idEmpresa` ASC),
  INDEX `IDCLIENTE_idx` (`tl_idCliente` ASC),
  INDEX `NUMDOC` (`tl_numeroDoc` ASC),
  INDEX `DATADOC` (`tl_dataDoc` DESC),
  CONSTRAINT `IDEMPRESA`
    FOREIGN KEY (`tl_idEmpresa`)
    REFERENCES `boletodb`.`empresa` (`em_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `IDCLIENTE`
    FOREIGN KEY (`tl_idCliente`)
    REFERENCES `boletodb`.`cliente` (`cl_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `boletodb`.`config`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `boletodb`.`config` (
  `cf_id` INT NOT NULL AUTO_INCREMENT,
  `cf_chave` VARCHAR(100) NULL,
  `cf_valor` VARCHAR(100) NULL,
  `cf_descricao` VARCHAR(255) NULL,
  PRIMARY KEY (`cf_id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

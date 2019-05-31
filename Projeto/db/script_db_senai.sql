-- MySQL Script generated by MySQL Workbench
-- Fri May 31 13:37:25 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema dbpc1020191
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbpc1020191
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_ator`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_ator` (
  `cod_ator` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_ator` VARCHAR(50) NOT NULL,
  `nascionalidade` VARCHAR(50) NOT NULL,
  `atividade` VARCHAR(100) NOT NULL,
  `data_nacimento` DATE NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  `biografia` TEXT NOT NULL,
  `imagem_ator` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`cod_ator`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_estado` (
  `cod_estado` INT(11) NOT NULL AUTO_INCREMENT,
  `estado` VARCHAR(40) NOT NULL,
  `uf` VARCHAR(4) NOT NULL,
  PRIMARY KEY (`cod_estado`))
ENGINE = InnoDB
AUTO_INCREMENT = 28
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_cidade` (
  `cod_cidade` INT(11) NOT NULL AUTO_INCREMENT,
  `cod_estado` INT(11) NOT NULL,
  `cidade` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`cod_cidade`),
  INDEX `cod_estado` (`cod_estado` ASC),
  CONSTRAINT `tbl_cidade_ibfk_1`
    FOREIGN KEY (`cod_estado`)
    REFERENCES `dbpc1020191`.`tbl_estado` (`cod_estado`))
ENGINE = InnoDB
AUTO_INCREMENT = 5598
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_classificacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_classificacao` (
  `cod_classificacao` INT(11) NOT NULL AUTO_INCREMENT,
  `classificacao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`cod_classificacao`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_diretor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_diretor` (
  `cod_diretor` INT(11) NOT NULL AUTO_INCREMENT,
  `diretor` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`cod_diretor`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_ditribuidora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_ditribuidora` (
  `cod_distribuidora` INT(11) NOT NULL AUTO_INCREMENT,
  `distribuidora` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`cod_distribuidora`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_endereco` (
  `cod_endereco` INT(11) NOT NULL AUTO_INCREMENT,
  `logradouro` VARCHAR(100) NOT NULL,
  `cep` VARCHAR(50) NOT NULL,
  `bairro` VARCHAR(100) NOT NULL,
  `numero` VARCHAR(50) NOT NULL,
  `cod_cidade` INT(11) NOT NULL,
  PRIMARY KEY (`cod_endereco`),
  INDEX `fk_endereco_cidade_idx` (`cod_cidade` ASC),
  CONSTRAINT `fk_endereco_cidade`
    FOREIGN KEY (`cod_cidade`)
    REFERENCES `dbpc1020191`.`tbl_cidade` (`cod_cidade`))
ENGINE = InnoDB
AUTO_INCREMENT = 45
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_fale_conosco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_fale_conosco` (
  `codigo` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(20) NULL DEFAULT NULL,
  `celular` VARCHAR(20) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `homePage` VARCHAR(150) NULL DEFAULT NULL,
  `facebook` VARCHAR(150) NULL DEFAULT NULL,
  `assunto` VARCHAR(30) NULL DEFAULT NULL,
  `mensagem` TEXT NULL DEFAULT NULL,
  `sexo` CHAR(1) NOT NULL,
  `profissao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_filme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_filme` (
  `cod_filme` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo_filme` VARCHAR(100) NOT NULL,
  `descricao` TEXT NOT NULL,
  `preco_filme` DECIMAL(6,3) NOT NULL,
  `imagem_filme` VARCHAR(150) NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  `status_produto` TINYINT(1) NOT NULL DEFAULT '0',
  `duracao` VARCHAR(30) NOT NULL,
  `cod_classificacao` INT(11) NOT NULL,
  `cod_distribuidora` INT(11) NOT NULL,
  PRIMARY KEY (`cod_filme`),
  INDEX `fk_filme_classificacao_idx` (`cod_classificacao` ASC),
  INDEX `fk_filme_distribuidora_idx` (`cod_distribuidora` ASC),
  CONSTRAINT `fk_filme_classificacao`
    FOREIGN KEY (`cod_classificacao`)
    REFERENCES `dbpc1020191`.`tbl_classificacao` (`cod_classificacao`),
  CONSTRAINT `fk_filme_distribuidora`
    FOREIGN KEY (`cod_distribuidora`)
    REFERENCES `dbpc1020191`.`tbl_ditribuidora` (`cod_distribuidora`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_filme_ator`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_filme_ator` (
  `cod_filme` INT(11) NOT NULL,
  `cod_ator` INT(11) NOT NULL,
  INDEX `fk_filme_ator_idx` (`cod_filme` ASC),
  INDEX `fk_ator_filme_idx` (`cod_ator` ASC),
  CONSTRAINT `fk_ator_filme`
    FOREIGN KEY (`cod_ator`)
    REFERENCES `dbpc1020191`.`tbl_ator` (`cod_ator`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_filme_ator`
    FOREIGN KEY (`cod_filme`)
    REFERENCES `dbpc1020191`.`tbl_filme` (`cod_filme`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_filme_diretor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_filme_diretor` (
  `cod_filme` INT(11) NOT NULL,
  `cod_diretor` INT(11) NOT NULL,
  INDEX `fk_filme_diretor_idx` (`cod_filme` ASC),
  INDEX `fk_diretor_filme_idx` (`cod_diretor` ASC),
  CONSTRAINT `fk_diretor_filme`
    FOREIGN KEY (`cod_diretor`)
    REFERENCES `dbpc1020191`.`tbl_diretor` (`cod_diretor`),
  CONSTRAINT `fk_filme_diretor`
    FOREIGN KEY (`cod_filme`)
    REFERENCES `dbpc1020191`.`tbl_filme` (`cod_filme`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_genero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_genero` (
  `cod_genero` INT(11) NOT NULL AUTO_INCREMENT,
  `genero` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`cod_genero`))
ENGINE = InnoDB
AUTO_INCREMENT = 26
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_categoria` (
  `cod_categoria` INT NOT NULL,
  `categoria` VARCHAR(100) NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cod_categoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_filme_genero_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_filme_genero_categoria` (
  `cod_relacao_genero_filme_categoria` INT NOT NULL AUTO_INCREMENT,
  `cod_filme` INT(11) NOT NULL,
  `cod_genero` INT(11) NOT NULL,
  `cod_categoria` INT NOT NULL,
  INDEX `fk_filme_genero_idx` (`cod_filme` ASC),
  INDEX `fk_genero_filme_idx` (`cod_genero` ASC),
  PRIMARY KEY (`cod_relacao_genero_filme_categoria`),
  INDEX `fk_categoria_genero_idx` (`cod_categoria` ASC),
  CONSTRAINT `fk_filme_genero`
    FOREIGN KEY (`cod_filme`)
    REFERENCES `dbpc1020191`.`tbl_filme` (`cod_filme`),
  CONSTRAINT `fk_genero_filme`
    FOREIGN KEY (`cod_genero`)
    REFERENCES `dbpc1020191`.`tbl_genero` (`cod_genero`),
  CONSTRAINT `fk_categoria_genero`
    FOREIGN KEY (`cod_categoria`)
    REFERENCES `dbpc1020191`.`tbl_categoria` (`cod_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_loja`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_loja` (
  `cod_loja` INT(11) NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL DEFAULT '1',
  `cod_endereco` INT(11) NOT NULL,
  PRIMARY KEY (`cod_loja`),
  INDEX `fk_loja_endereco` (`cod_endereco` ASC),
  CONSTRAINT `fk_loja_endereco`
    FOREIGN KEY (`cod_endereco`)
    REFERENCES `dbpc1020191`.`tbl_endereco` (`cod_endereco`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 43
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_nivel_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_nivel_usuario` (
  `cod_nivel` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_nivel` VARCHAR(40) NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT '1',
  `adm_conteudo` TINYINT(1) NULL DEFAULT '0',
  `adm_fale_conosco` TINYINT(1) NULL DEFAULT '0',
  `adm_produto` TINYINT(1) NULL DEFAULT '0',
  `adm_usuario` TINYINT(1) NULL DEFAULT '0',
  PRIMARY KEY (`cod_nivel`))
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_promocao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_promocao` (
  `cod_promocao` INT(11) NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  `porcentagem_desconto` INT(11) NOT NULL,
  `cod_filme` INT(11) NOT NULL,
  PRIMARY KEY (`cod_promocao`),
  INDEX `fk_promocao_filme_idx` (`cod_filme` ASC),
  CONSTRAINT `fk_promocao_filme`
    FOREIGN KEY (`cod_filme`)
    REFERENCES `dbpc1020191`.`tbl_filme` (`cod_filme`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_sobre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_sobre` (
  `cod_sobre` INT(11) NOT NULL AUTO_INCREMENT,
  `texto_sobre` TEXT NOT NULL,
  `titulo_sobre` VARCHAR(40) NOT NULL,
  `imagem_sobre` VARCHAR(150) NULL DEFAULT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cod_sobre`))
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_usuario` (
  `cod_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT '0',
  `cod_nivel` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`cod_usuario`),
  INDEX `cod_nivel` (`cod_nivel` ASC),
  CONSTRAINT `tbl_usuario_ibfk_1`
    FOREIGN KEY (`cod_nivel`)
    REFERENCES `dbpc1020191`.`tbl_nivel_usuario` (`cod_nivel`)
    ON DELETE SET NULL)
ENGINE = InnoDB
AUTO_INCREMENT = 28
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbpc1020191`.`tbl_subcategoria_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbpc1020191`.`tbl_subcategoria_categoria` (
  `cod_relacao_subcategoria_categoria` INT NOT NULL AUTO_INCREMENT,
  `cod_categoria` INT NOT NULL,
  `cod_genero` INT NOT NULL,
  PRIMARY KEY (`cod_relacao_subcategoria_categoria`),
  INDEX `fk_genero_idx` (`cod_genero` ASC),
  INDEX `fk_categoria_subcategoria_idx` (`cod_categoria` ASC),
  CONSTRAINT `fk_genero_subcategoria`
    FOREIGN KEY (`cod_genero`)
    REFERENCES `dbpc1020191`.`tbl_genero` (`cod_genero`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_categoria_subcategoria`
    FOREIGN KEY (`cod_categoria`)
    REFERENCES `dbpc1020191`.`tbl_categoria` (`cod_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

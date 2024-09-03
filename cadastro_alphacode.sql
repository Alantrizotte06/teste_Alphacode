CREATE DATABASE cadastro_alphacode;

USE cadastro_alphacode;

CREATE TABLE dados (
	id INT(11) AUTO_INCREMENT
PRIMARY KEY,
 nome VARCHAR(100) NOT NULL,
 data_nascimento DATE NOT NULL,
 email VARCHAR(100) NOT NULL,
 profissao VARCHAR(100) NOT NULL,
 telefone VARCHAR(15) NOT NULL,
 celular VARCHAR(15) NOT NULL
);
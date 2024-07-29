CREATE DATABASE sistema_cadastro;
USE sistema_cadastro;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    endereco VARCHAR(255)
);


CREATE TABLE animais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    especie VARCHAR(255) NOT NULL,
    idade INT NOT NULL,
    descricao TEXT NOT NULL,
    genero ENUM('Masculino', 'Feminino') NOT NULL
);

ALTER TABLE animais ADD COLUMN foto VARCHAR(255);
ALTER TABLE animais ADD COLUMN opcao_compra ENUM('comprar', 'adotar') NOT NULL;

show tables;

DESCRIBE usuarios;
DESCRIBE animais;
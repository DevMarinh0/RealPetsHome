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

CREATE TABLE ADMS (
id INT auto_increment PRIMARY KEY,
email varchar(100) NOT NULL,
senha varchar(100) NOT NULL
);

CREATE TABLE institucional (
   id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    endereco VARCHAR(255)
);
CREATE TABLE patrocinadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    localizacao VARCHAR(255)
);
CREATE TABLE produtosPatrocinadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    descricao TEXT,
    foto varchar(255) NOT NULL
);

ALTER TABLE animais ADD COLUMN preco DECIMAL(10, 2);
ALTER TABLE animais MODIFY COLUMN preco DECIMAL(10, 2) NULL;

INSERT INTO adms (email, senha) VALUES ('adm1@gmail.com', 'adm123');
INSERT INTO adms (email, senha) VALUES ('adm2@gmail.com', 'adm123');

ALTER TABLE animais ADD COLUMN foto VARCHAR(255);
ALTER TABLE animais ADD COLUMN opcao_compra ENUM('comprar', 'adotar') NOT NULL;
ALTER TABLE produtospatrocinadores ADD COLUMN foto varchar(255);
show tables;

-- Inserindo dados na tabela produtosPatrocinadores
INSERT INTO produtosPatrocinadores (nome, preco, descricao, foto) VALUES 
('Ração Premium', 120.00, 'Ração Premium para cães adultos, 10kg', 'foto_racao_premium.jpg'),
('Brinquedo para Gato', 25.50, 'Brinquedo interativo para gatos', 'foto_brinquedo_gato.jpg');

-- Inserindo dados na tabela institucional
INSERT INTO institucional (nome, email, senha, telefone, endereco) VALUES 
('Instituto Animal Feliz', 'contato@animalfeliz.org', 'senha123', '123456789', 'Rua dos Animais, 100'),
('ONG Pet Amigo', 'contato@petamigo.org', 'senha456', '987654321', 'Av. dos Pets, 200');

-- Inserindo dados na tabela animais
INSERT INTO animais (nome, especie, idade, descricao, genero, preco, foto, opcao_compra) VALUES 
('Rex', 'Cachorro', 2, 'Cachorro de grande porte, amigável e brincalhão.', 'Masculino', 300.00, 'foto_rex.jpg', 'comprar'),
('Mimi', 'Gato', 2, 'Gata pequena, carinhosa e sociável.', 'Feminino', NULL, 'foto_mimi.jpg', 'adotar');

-- Inserindo dados na tabela usuarios
INSERT INTO usuarios (id, nome, email, senha, telefone, endereco) VALUES 
(1, 'João Silva', 'joao.silva@example.com', 'senhaJoao123', '11987654321', 'Rua das Flores, 123'),
(2, 'Maria Oliveira', 'maria.oliveira@example.com', 'senhaMaria456', '21987654321', 'Av. Central, 456');

ALTER TABLE animais ADD COLUMN usuario_id INT;

UPDATE animais SET usuario_id = 1 WHERE id = 1;  
UPDATE animais SET usuario_id = 2 WHERE id = 2;  
SELECT * FROM animais;
SELECT * FROM usuarios;

DESCRIBE usuarios;
DESCRIBE animais;
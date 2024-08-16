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
('Brinquedo para Gato', 25.50, 'Brinquedo interativo para gatos', 'foto_brinquedo_gato.jpg'),
('Coleira Ajustável', 45.00, 'Coleira ajustável para cães de médio porte.', 'foto_coleira.jpg'),
('Caminha para Gato', 80.00, 'Caminha confortável para gatos.', 'foto_caminha_gato.jpg'),
('Ração para Filhotes', 60.00, 'Ração específica para filhotes de cães, 5kg.', 'foto_racao_filhotes.jpg');

-- Inserindo dados na tabela institucional
INSERT INTO institucional (nome, email, senha, telefone, endereco) VALUES 
('Instituto Animal Feliz', 'contato@animalfeliz.org', 'senha123', '123456789', 'Rua dos Animais, 100'),
('ONG Pet Amigo', 'contato@petamigo.org', 'senha456', '987654321', 'Av. dos Pets, 200');

-- Inserindo dados na tabela animais
INSERT INTO animais (nome, especie, idade, descricao, genero, preco, foto, opcao_compra) VALUES 
('Rex', 'Cachorro', 2, 'Cachorro de grande porte, amigável e brincalhão.', 'Masculino', 300.00, 'foto_rex.jpg', 'comprar'),
('Mimi', 'Gato', 2, 'Gata pequena, carinhosa e sociável.', 'Feminino', NULL, 'foto_mimi.jpg', 'adotar'),
('Luna', 'Gato', 1, 'Gata brincalhona e cheia de energia.', 'Feminino', 200.00, 'foto_luna.jpg', 'comprar'),
('Thor', 'Cachorro', 3, 'Cachorro forte e protetor, ideal para guarda.', 'Masculino', NULL, 'foto_thor.jpg', 'adotar'),
('Bella', 'Cachorro', 4, 'Cachorra de porte médio, dócil e amigável.', 'Feminino', 150.00, 'foto_bella.jpg', 'comprar');

-- Inserindo dados na tabela usuarios
INSERT INTO usuarios (id, nome, email, senha, telefone, endereco) VALUES 
(1, 'João Silva', 'joao.silva@exemplo.com', 'senhaJoao123', '11987654321', 'Rua das Flores, 123'),
(2, 'Maria Oliveira', 'maria.oliveira@exemplo.com', 'senhaMaria456', '21987654321', 'Av. Central, 456'),
(3,'Carlos Souza', 'carlos.souza@exemplo.com', 'senhaCarlos789', '31987654321', 'Rua das Acácias, 789'),
(4,'Ana Pereira', 'ana.pereira@exemplo.com', 'senhaAna123', '41987654321', 'Av. das Palmeiras, 321'),
(5,'Lucas Almeida', 'lucas.almeida@exemplo.com', 'senhaLucas456', '51987654321', 'Rua das Orquídeas, 654');

-- Inserindo dados na tabela patrocinadores
INSERT INTO patrocinadores (nome, email, telefone, localizacao) VALUES 
('PetShop A', 'contato@petshopa.com', '11987654321', 'Rua das Flores, 123'),
('Loja B', 'atendimento@lojab.com', '21987654322', 'Av. Central, 456'),
('Clínica C', 'info@clinicac.com', '31987654323', 'Praça da República, 789');

ALTER TABLE animais ADD COLUMN usuario_id INT;

UPDATE animais SET usuario_id = 1 WHERE id = 1;  
UPDATE animais SET usuario_id = 2 WHERE id = 2; 
UPDATE animais SET usuario_id = 3 WHERE id = 3;
UPDATE animais SET usuario_id = 4 WHERE id = 4;
UPDATE animais SET usuario_id = 5 WHERE id = 5;
UPDATE animais SET usuario_id = 6 WHERE id = 6;
UPDATE animais SET usuario_id = 7 WHERE id = 7;
UPDATE animais SET usuario_id = 8 WHERE id = 8;  
 

SELECT * FROM animais;
SELECT * FROM usuarios;

DESCRIBE usuarios;
DESCRIBE animais;
DROP DATABASE IF EXISTS projeto_max;
CREATE DATABASE projeto_max;
USE projeto_max;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    senha VARCHAR(255)
);

-- Usuário inicial
INSERT INTO usuarios (nome, email, senha) VALUES
('Max Mauro Dias Santos', 'max@email.com', 
'$2y$10$DMYY1ASOkoiv/t5inkfcr.d90C64ScUX6u04JwgoqOjKxYbOIGIqW'); 
-- senha = 123

-- Tabela para textos do home
CREATE TABLE textos_home (
    id INT AUTO_INCREMENT PRIMARY KEY,
    conteudo TEXT NOT NULL
);

INSERT INTO textos_home (conteudo) VALUES ('Texto do Home inicial...');

CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255),
    ano INT,
    capa VARCHAR(255) NULL
);

-- Seções da home
CREATE TABLE secoes_home (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    conteudo TEXT,
    imagem VARCHAR(255) NULL,
    ordem INT DEFAULT 0
);

-- Adicionar a coluna link
ALTER TABLE secoes_home ADD link VARCHAR(255) NULL;

-- Exemplo de seções iniciais
INSERT INTO secoes_home (titulo, conteudo, imagem, link, ordem) VALUES
("Banner", "Bem-vindo ao Projeto Max 🚀", "/imagens/banner.jpg", "https://www.google.com", 1),
("Sobre", "Texto sobre o projeto...", NULL, NULL, 2),
("Notícias", "Últimas novidades aqui...", NULL, NULL, 3);

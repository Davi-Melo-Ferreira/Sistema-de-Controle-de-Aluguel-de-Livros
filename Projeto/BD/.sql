-- DROP database davi_livraria_db;

CREATE DATABASE IF NOT EXISTS davi_livraria_db
DEFAULT CHARACTER SET utf8mb4
DEFAULT COLLATE utf8mb4_unicode_ci;

USE davi_livraria_db;

CREATE TABLE IF NOT EXISTS cliente (
	id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(100) NOT NULL,
    email_cliente VARCHAR(100) NOT NULL UNIQUE,
    endereco_cliente VARCHAR(100) NOT  NULL
);

CREATE TABLE IF NOT EXISTS vendedor (
	id_vendedor INT AUTO_INCREMENT PRIMARY KEY,
    nome_vendedor VARCHAR(100) NOT NULL,
    email_vendedor VARCHAR(100) NOT NULL UNIQUE,
    senha_vendedor CHAR(60) NOT NULL
);

CREATE TABLE IF NOT EXISTS livro (
	id_livro INT AUTO_INCREMENT PRIMARY KEY,
    nome_livro VARCHAR(100) NOT NULL,
    valor_livro DECIMAL(10, 2) NOT NULL,
    editora_livro VARCHAR(100) NOT NULL,
    ano_livro YEAR NOT NULL,
    idioma_livro VARCHAR(100) NOT NULL,
    autor_livro VARCHAR(100) NOT NULL,
    alugado_livro BOOLEAN
);

CREATE TABLE alugueis (
    id_aluguel INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_livro INT NOT NULL,
    data_aluguel TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    prazo_devolucao DATE NOT NULL,
    data_devolucao DATE NULL,
    taxa_atraso DECIMAL(10,2) NOT NULL DEFAULT 5.00,
    FOREIGN KEY (id_livro) REFERENCES livros(id_livro),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
    CHECK (data_devolucao IS NULL OR data_devolucao >= data_aluguel)
);
-- Criação do Banco de Dados
CREATE DATABASE IF NOT EXISTS crud_php;

-- Seleção do Banco de Dados
USE crud_php;

-- Criação da Tabela de Usuários
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    idade INT NOT NULL,
    endereco VARCHAR(255) NOT NULL
);

-- Inserção de Dados de Exemplo
INSERT INTO users (nome, idade, endereco) VALUES
    ('João', 25, 'Rua A, 123'),
    ('Maria', 30, 'Rua B, 456'),
    ('Carlos', 22, 'Rua C, 789');

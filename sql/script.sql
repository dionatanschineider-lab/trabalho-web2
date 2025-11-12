-- Banco e tabelas para o sistema web
CREATE DATABASE IF NOT EXISTS web_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE web_system;

-- tabela de usuários
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- usuário administrador (senha: Admin@123)
INSERT INTO users (name, email, password) VALUES
('Administrador', 'admin@example.com', '$2y$10$CwTycUXWue0Thq9StjUM0uJ8J7f3GQh2y8uQ1sZ4b7YgQ9h5u5GPa');

-- tabela de produtos
CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  description TEXT,
  price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  quantity INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- dados iniciais
INSERT INTO products (name, description, price, quantity) VALUES
('Tomate', 'Tomate orgânico', 3.50, 120),
('Maçã', 'Maçã gala', 4.20, 80),
('Banana', 'Banana nanica', 2.10, 200);

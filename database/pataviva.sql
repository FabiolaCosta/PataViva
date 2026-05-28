CREATE DATABASE pataviva;
USE pataviva;

-- TABELA USUARIOS
CREATE TABLE usuarios (
    usuario_id int AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20),

    senha VARCHAR(255) NOT NULL,

    data_nascimento DATE,

    cep VARCHAR(10),
    rua VARCHAR(100),
    numero VARCHAR(20),
    bairro VARCHAR(100),
    cidade VARCHAR(100),
    estado VARCHAR(50),

    tipo_moradia ENUM('casa', 'apartamento'),
    situacao_imovel ENUM('proprio', 'alugado'),

    possui_quintal BOOLEAN,
    possui_telas BOOLEAN,
    possui_outros_animais BOOLEAN,

    experiencia_animais TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- TABELA ANIMAIS 
CREATE TABLE animais(
    animal_id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especie VARCHAR(50) NOT NULL,
    sexo ENUM('m', 'f') NOT NULL,
    porte ENUM('pequeno', 'medio', 'grande') NOT NULL,
    idade INT,
    descricao TEXT,
    foto VARCHAR(255),
    status ENUM('para adoção', 'adotado') DEFAULT 'para adoção'
);

-- TABELA SOLICITACOES
CREATE TABLE solicitacoes(
    sol_id INT AUTO_INCREMENT PRIMARY KEY, 
    usuario_id INT NOT NULL,
    animal_id INT NOT NULL,
    dt_sol TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pendente', 'aprovado', 'negado') DEFAULT 'pendente',
    CONSTRAINT fk_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id),
    CONSTRAINT fk_animal FOREIGN KEY (animal_id) REFERENCES animais(animal_id)
);

-- TABELA ADOCOES
CREATE TABLE adocoes(
    adocao_id INT AUTO_INCREMENT PRIMARY KEY, 
    sol_id INT NOT NULL UNIQUE,
    dt_adocao DATE NOT NULL,
    CONSTRAINT fk_solicitacao FOREIGN KEY (sol_id) REFERENCES solicitacoes(sol_id)
);

-- TABELA ADMINISTRADOR
CREATE TABLE administrador (
    admin_id int AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL
); 

--senha pataviva123
INSERT INTO administrador (email, senha) VALUES
('pataviva.admin@gmail.com', '$2y$10$MO91exLB7HljUuEqJ1LDDOlNvYN/NMBcYasuupuFvJcw7aAaeSft6'); 

CREATE TABLE doacoes (
    doacao_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NULL,
    valor DECIMAL(10,2) NOT NULL,
    pix_feito ENUM('sim','nao') NOT NULL,
    dt_doacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE doacoes
ADD CONSTRAINT fk_usuario_doacao
FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id);

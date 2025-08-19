CREATE DATABASE imagens_db;
USE imagens_db;

CREATE TABLE uploads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imagem VARCHAR(255),
    observacao TEXT,
    volume VARCHAR(200),
    transbordo ENUM('Sim', 'Não'),
    data_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    local VARCHAR(200)
);
CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
     email VARCHAR(200),
     senha VARCHAR(200),
     nome VARCHAR(200)
     );

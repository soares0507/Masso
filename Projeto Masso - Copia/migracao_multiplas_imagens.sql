-- Criação da tabela para locais/observações
CREATE TABLE IF NOT EXISTS upload_locais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nivel VARCHAR(255),
    observacao TEXT,
    volume VARCHAR(255),
    transbordo VARCHAR(255),
    data_envio DATETIME,
    usuario_id INT,
    local VARCHAR(255)
);

-- Criação da tabela para imagens associadas ao local
CREATE TABLE IF NOT EXISTS upload_imagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    local_id INT,
    imagem VARCHAR(255),
    FOREIGN KEY (local_id) REFERENCES upload_locais(id) ON DELETE CASCADE
);
CREATE TABLE usuarios (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    papel ENUM('admin', 'gerente', 'membro') DEFAULT 'membro',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE projetos (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    descricao TEXT,
    dono_id BIGINT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (dono_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE projeto_usuario (
    projeto_id BIGINT NOT NULL,
    usuario_id BIGINT NOT NULL,
    papel ENUM('dono', 'editor', 'visualizador') DEFAULT 'visualizador',
    PRIMARY KEY (projeto_id, usuario_id),
    FOREIGN KEY (projeto_id) REFERENCES projetos(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE tarefas (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    projeto_id BIGINT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    status ENUM('a_fazer', 'fazendo', 'feito') DEFAULT 'a_fazer',
    prioridade ENUM('baixa', 'media', 'alta') DEFAULT 'media',
    responsavel_id BIGINT,
    data_entrega DATE,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (projeto_id) REFERENCES projetos(id) ON DELETE CASCADE,
    FOREIGN KEY (responsavel_id) REFERENCES usuarios(id) ON DELETE SET NULL
);

CREATE TABLE comentarios (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    tarefa_id BIGINT NOT NULL,
    usuario_id BIGINT NOT NULL,
    conteudo TEXT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tarefa_id) REFERENCES tarefas(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Execute uma única vez em bancos já existentes antes desta correção.
ALTER TABLE usuarios
    ADD COLUMN ativo TINYINT(1) NOT NULL DEFAULT 1 AFTER foto;

-- Opcional: execute somente se ainda não houver e-mails duplicados.
-- ALTER TABLE usuarios ADD UNIQUE KEY uq_usuarios_email (email);

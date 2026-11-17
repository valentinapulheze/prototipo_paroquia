<?php

class Aviso
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Listar avisos
    public function listar()
    {
        $sql = "SELECT
                    a.id_aviso,
                    a.id_usuario,
                    a.titulo,
                    a.detalhamento,
                    a.mensagem,
                    a.categoria,
                    a.destaque,
                    a.data_expiracao,
                    a.criado_em,
                    a.atualizado_em,
                    a.status,
                    a.foto,
                    u.nome AS usuario
                FROM avisos a
                LEFT JOIN usuarios u
                    ON a.id_usuario = u.id_usuario
                ORDER BY a.id_aviso DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar aviso pelo ID
    public function buscarPorId($id)
    {
        $sql = "SELECT *
                FROM avisos
                WHERE id_aviso = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Criar aviso
    public function criar($dados)
    {
        $sql = "INSERT INTO avisos
                (
                    id_usuario,
                    titulo,
                    detalhamento,
                    mensagem,
                    categoria,
                    destaque,
                    data_expiracao,
                    foto
                )
                VALUES
                (
                    :id_usuario,
                    :titulo,
                    :detalhamento,
                    :mensagem,
                    :categoria,
                    :destaque,
                    :data_expiracao,
                    :foto
                )";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id_usuario', $dados['id_usuario'], PDO::PARAM_INT);
        $stmt->bindValue(':titulo', $dados['titulo']);
        $stmt->bindValue(':detalhamento', $dados['detalhamento']);
        $stmt->bindValue(':mensagem', $dados['mensagem'] ?? null);
        $stmt->bindValue(':categoria', $dados['categoria'] ?? 'geral');
        $stmt->bindValue(':destaque', (int) ($dados['destaque'] ?? 0), PDO::PARAM_INT);
        $stmt->bindValue(':data_expiracao', $dados['data_expiracao'] ?: null);
        $stmt->bindValue(':foto', $dados['foto'] ?? '');

        return $stmt->execute();
    }

    // Atualizar aviso
    public function atualizar($dados)
    {
        $sql = "UPDATE avisos
                SET
                    titulo = :titulo,
                    detalhamento = :detalhamento,
                    mensagem = :mensagem,
                    categoria = :categoria,
                    destaque = :destaque,
                    data_expiracao = :data_expiracao";

        if (array_key_exists('foto', $dados)) {
            $sql .= ", foto = :foto";
        }

        $sql .= " WHERE id_aviso = :id_aviso";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':titulo', $dados['titulo']);
        $stmt->bindValue(':detalhamento', $dados['detalhamento']);
        $stmt->bindValue(':mensagem', $dados['mensagem'] ?? null);
        $stmt->bindValue(':categoria', $dados['categoria'] ?? 'geral');
        $stmt->bindValue(':destaque', (int) ($dados['destaque'] ?? 0), PDO::PARAM_INT);
        $stmt->bindValue(':data_expiracao', $dados['data_expiracao'] ?: null);
        $stmt->bindValue(':id_aviso', $dados['id_aviso'], PDO::PARAM_INT);

        if (array_key_exists('foto', $dados)) {
            $stmt->bindValue(':foto', $dados['foto'] ?? '');
        }

        return $stmt->execute();
    }

    // Excluir aviso
    public function excluir($id)
    {
        $sql = "DELETE FROM avisos
                WHERE id_aviso = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}

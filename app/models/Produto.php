
<?php

class Produto
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    // Cadastrar produto na lojinha
    public function save($data)
    {
        $sql = "INSERT INTO lojas
                (id_usuario, titulo, preco, foto)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $data['id_usuario'],
            $data['titulo'],
            $data['preco'],
            $data['foto']
        ]);
    }

    // Atualizar produto
    public function update($data)
    {
        $sql = "UPDATE lojas
                SET titulo = ?, preco = ?, foto = ?
                WHERE id_loja = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $data['titulo'],
            $data['preco'],
            $data['foto'],
            $data['id_loja']
        ]);
    }

    // Listar todos os produtos
    public function getAll()
    {
        $sql = "SELECT * FROM lojas ORDER BY titulo ASC";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar produto pelo ID
    public function getById($id)
    {
        $sql = "SELECT * FROM lojas WHERE id_loja = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Excluir produto
    public function delete($id)
    {
        $sql = "DELETE FROM lojas WHERE id_loja = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$id]);
    }
}

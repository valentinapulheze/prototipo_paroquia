<?php
class Token
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    public function save($data)
    {

        $sql = "INSERT INTO password_resets (email, token, created_at) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['email'],
            $data['token'],
            $data['created_at']
        ]);
    }

    public function update($data)
    {
        $sql = "UPDATE password_resets SET email = ?";
        $sql .= " WHERE id = ?";
        $valores = [
            $data['email'],
            $data['id']
        ];

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($valores);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM password_resets ORDER BY email";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM password_resets WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM password_resets WHERE id = ?";
        //var_dump($sql);exit;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }
}

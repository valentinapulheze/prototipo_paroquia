
<?php

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    // Cadastra um usuário
    public function save($data)
    {
        $tipoAcesso = (string) ($data['tipo_acesso'] ?? '1');

        if (!in_array($tipoAcesso, ['0', '1'], true)) {
            throw new InvalidArgumentException('Perfil de acesso inválido.');
        }

        $sql = "INSERT INTO usuarios
                (nome, email, telefone, tipo_acesso, senha, foto, ativo)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            trim($data['nome']),
            trim($data['email']),
            trim($data['telefone'] ?? ''),
            $tipoAcesso,
            $data['senha'],
            $data['foto'] ?? '',
            (int) ($data['ativo'] ?? 1)
        ]);

        return $this->conn->lastInsertId();
    }

    // Atualiza os dados de um usuário
    public function update($data)
    {
        $id = $data['idusuario'] ?? $data['id_usuario'] ?? null;

        if (empty($id)) {
            return false;
        }

        $campos = [];
        $valores = [];

        if (array_key_exists('nome', $data)) {
            $campos[] = 'nome = ?';
            $valores[] = trim($data['nome']);
        }

        if (array_key_exists('email', $data)) {
            $email = trim($data['email']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }

            $campos[] = 'email = ?';
            $valores[] = $email;
        }

        if (array_key_exists('telefone', $data)) {
            $campos[] = 'telefone = ?';
            $valores[] = trim($data['telefone'] ?? '');
        }

        if (array_key_exists('tipo_acesso', $data)) {
            $tipoAcesso = (string) $data['tipo_acesso'];

            if (!in_array($tipoAcesso, ['0', '1'], true)) {
                return false;
            }

            $campos[] = 'tipo_acesso = ?';
            $valores[] = $tipoAcesso;
        }

        // Só altera a senha quando uma nova senha for informada.
        if (isset($data['senha']) && $data['senha'] !== '') {
            $senha = $data['senha'];

            if (strlen($senha) < 6 || strlen($senha) > 20) {
                return false;
            }

            $campos[] = 'senha = ?';
            $valores[] = password_hash($senha, PASSWORD_DEFAULT);
        }

        // Só altera a foto quando uma nova foto for informada.
        if (!empty($data['foto'])) {
            $campos[] = 'foto = ?';
            $valores[] = $data['foto'];
        }

        if (array_key_exists('ativo', $data)) {
            $ativo = (int) $data['ativo'];
            if (!in_array($ativo, [0, 1], true)) {
                return false;
            }
            $campos[] = 'ativo = ?';
            $valores[] = $ativo;
        }

        if (empty($campos)) {
            return false;
        }

        $sql = 'UPDATE usuarios SET '
             . implode(', ', $campos)
             . ' WHERE id_usuario = ?';

        $valores[] = $id;

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute($valores);
    }

    // Verifica o login
    public function login($data)
    {
        $sql = 'SELECT * FROM usuarios WHERE email = ? AND ativo = 1';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([trim($data['email'] ?? '')]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (
            !$user ||
            !password_verify($data['senha'] ?? '', $user['senha'])
        ) {
            return false;
        }

        return true;
    }

    // Busca o nome pelo e-mail
    public function getNameByEmail($email)
    {
        $sql = 'SELECT nome FROM usuarios WHERE email = ?';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([trim($email)]);

        return $stmt->fetchColumn();
    }

    // Busca um usuário pelo e-mail
    public function getUserByEmail($email)
    {
        $sql = 'SELECT * FROM usuarios WHERE email = ?';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([trim($email)]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lista todos os usuários
    public function getAll()
    {
        $sql = 'SELECT * FROM usuarios ORDER BY nome';

        return $this->conn
                    ->query($sql)
                    ->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca um usuário pelo ID
    public function getById($id)
    {
        $sql = 'SELECT * FROM usuarios WHERE id_usuario = ?';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Exclui um usuário
    public function delete($id)
    {
        $sql = 'DELETE FROM usuarios WHERE id_usuario = ?';

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$id]);
    }

    // Atualiza a senha pelo e-mail
    public function atualizarSenhaPorEmail($email, $novaSenha)
    {
        if (strlen($novaSenha) < 6 || strlen($novaSenha) > 20) {
            return false;
        }

        $sql = 'UPDATE usuarios SET senha = ? WHERE email = ?';

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            password_hash($novaSenha, PASSWORD_DEFAULT),
            trim($email)
        ]);
    }
}

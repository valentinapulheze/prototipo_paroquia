<?php

class Agendamento
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    // Retorna as datas que o administrador bloqueou
    public function getDiasBloqueados($mes = null, $ano = null)
    {
        $sql = "SELECT data
                FROM disponibilidade_agendamento
                WHERE status = 0";

        $params = [];

        if ($mes !== null && $ano !== null) {
            $sql .= " AND MONTH(data) = ? AND YEAR(data) = ?";
            $params = [$mes, $ano];
        }

        $sql .= " ORDER BY data ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Retorna todas as datas bloqueadas para o painel administrativo
    public function getDisponibilidades()
    {
        $sql = "SELECT d.*, u.nome
                FROM disponibilidade_agendamento d
                LEFT JOIN usuarios u ON d.id_usuario = u.id_usuario
                WHERE d.status = 0
                ORDER BY d.data ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Verifica se a data está liberada
    public function dataDisponivel($data)
    {
        $sql = "SELECT COUNT(*)
                FROM disponibilidade_agendamento
                WHERE data = ? AND status = 0";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$data]);

        return $stmt->fetchColumn() == 0;
    }

    // Cadastra uma data indisponível
    public function bloquearData($data, $idUsuario)
    {
        if (!$this->dataDisponivel($data)) {
            return false;
        }

        $sql = "INSERT INTO disponibilidade_agendamento
                (data, hora_inicial, hora_final, status, id_usuario)
                VALUES (?, '00:00:00', '00:00:00', 0, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$data, $idUsuario]);
    }

    // Compatibilidade com o nome usado no controller anterior
    public function bloquearDisponibilidade($data, $idUsuario)
    {
        return $this->bloquearData($data, $idUsuario);
    }

    // Libera uma data bloqueada
    public function liberarData($data)
    {
        $sql = "DELETE FROM disponibilidade_agendamento
                WHERE data = ? AND status = 0";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$data]);
    }

    // Compatibilidade com o nome usado no controller anterior
    public function liberarDisponibilidade($data)
    {
        return $this->liberarData($data);
    }

    // Verifica se o horário escolhido já foi agendado
    public function horarioDisponivel($data, $hora)
    {
        if (!$this->dataDisponivel($data)) {
            return false;
        }

        $sql = "SELECT COUNT(*)
                FROM agendamentos
                WHERE data = ? AND hora_inicial = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$data, $hora]);

        return $stmt->fetchColumn() == 0;
    }

    // Salva um novo agendamento
    public function salvarAgendamento($dados)
    {
        $sql = "INSERT INTO agendamentos
                (id_usuario, data, hora_inicial, hora_final, detalhamento)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $dados['id_usuario'],
            $dados['data'],
            $dados['hora_inicial'],
            $dados['hora_final'],
            $dados['detalhamento']
        ]);
    }

    // Lista todos os agendamentos para o painel administrativo
    public function getAgendamentos()
    {
        $sql = "SELECT a.*, u.nome
                FROM agendamentos a
                INNER JOIN usuarios u ON a.id_usuario = u.id_usuario
                ORDER BY a.data ASC, a.hora_inicial ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lista os agendamentos de um usuário específico
    public function getAgendamentosUsuario($idUsuario)
    {
        $sql = "SELECT *
                FROM agendamentos
                WHERE id_usuario = ?
                ORDER BY data ASC, hora_inicial ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Exclui um agendamento
    public function excluirAgendamento($id)
    {
        $sql = "DELETE FROM agendamentos
                WHERE id_agendamento = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$id]);
    }
}
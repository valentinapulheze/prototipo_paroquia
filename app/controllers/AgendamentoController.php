<?php

class AgendamentoController extends Controller
{
    private function iniciarSessao()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function verificarUsuario()
    {
        $this->iniciarSessao();
        if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
            header('Location: ' . BASE_URL . '/?url=login');
            exit;
        }
    }

    private function verificarAdmin()
    {
        $this->verificarUsuario();

        if (!isset($_SESSION['user_tipo_acesso']) ||
            $_SESSION['user_tipo_acesso'] !== '0') {
            header('Location: ' . BASE_URL . '/?url=dashboard');
            exit;
        }
    }

    // Página para o usuário realizar um agendamento
    public function index()
    {
        $this->verificarUsuario();

        $agendamentoModel = $this->model('Agendamento');

        $diasBloqueados = $agendamentoModel->getDiasBloqueados();

        $agendamentos = [];

        if (method_exists($agendamentoModel, 'getAgendamentos')) {
            $agendamentos = $agendamentoModel->getAgendamentos();
        }

        $this->view('agendamento/agendar', [
            'diasBloqueados' => $diasBloqueados,
            'agendamentos' => $agendamentos
        ]);
    }

    // Salva o agendamento do usuário
    public function salvar()
    {
        $this->verificarUsuario();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/?url=agendamento');
            exit;
        }

        $data = $_POST['data'] ?? '';
        $hora = $_POST['hora'] ?? '';
        $detalhamento = trim($_POST['detalhamento'] ?? '');

        if (empty($data) || empty($hora)) {
            $_SESSION['erro_agendamento'] = 'Selecione uma data e um horário.';
            header('Location: ' . BASE_URL . '/?url=agendamento');
            exit;
        }

        // Permite horários de início entre 06h e 17h
        // Cada agendamento dura uma hora, terminando até as 18h.
        $horariosPermitidos = [];

        for ($i = 6; $i < 18; $i++) {
            $horariosPermitidos[] = sprintf('%02d:00', $i);
        }

        if (!in_array($hora, $horariosPermitidos, true)) {
            $_SESSION['erro_agendamento'] = 'Horário inválido.';
            header('Location: ' . BASE_URL . '/?url=agendamento');
            exit;
        }

        $agendamentoModel = $this->model('Agendamento');

        if (!$agendamentoModel->horarioDisponivel($data, $hora . ':00')) {
            $_SESSION['erro_agendamento'] = 'Essa data ou horário não está disponível.';
            header('Location: ' . BASE_URL . '/?url=agendamento');
            exit;
        }

        $horaFinal = date('H:i:s', strtotime($hora . ':00 +1 hour'));

        $dados = [
            'id_usuario' => $_SESSION['user_id_usuario'],
            'data' => $data,
            'hora_inicial' => $hora . ':00',
            'hora_final' => $horaFinal,
            'detalhamento' => $detalhamento
        ];

        if ($agendamentoModel->salvarAgendamento($dados)) {
            $_SESSION['sucesso_agendamento'] = 'Agendamento realizado com sucesso!';
        } else {
            $_SESSION['erro_agendamento'] = 'Não foi possível realizar o agendamento.';
        }

        header('Location: ' . BASE_URL . '/?url=agendamento');
        exit;
    }

    // Painel administrativo
    public function painel()
    {
        $this->verificarAdmin();

        $agendamentoModel = $this->model('Agendamento');

        $agendamentos = $agendamentoModel->getAgendamentos();
        $datasIndisponiveis = $agendamentoModel->getDisponibilidades();

        $this->view('agendamento/painel', [
            'agendamentos' => $agendamentos,
            'disponibilidades' => $datasIndisponiveis,
            'datasIndisponiveis' => $datasIndisponiveis
        ]);
    }

    // Cadastra uma data indisponível
    public function cadastrarDisponibilidade()
    {
        $this->verificarAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/?url=painelAgendamento');
            exit;
        }

        $data = $_POST['data'] ?? '';

        $dataObj = DateTime::createFromFormat('Y-m-d', $data);

        if (!$dataObj || $dataObj->format('Y-m-d') !== $data) {
            $_SESSION['erro_agendamento'] = 'Informe uma data válida.';
            header('Location: ' . BASE_URL . '/?url=painelAgendamento');
            exit;
        }

        $agendamentoModel = $this->model('Agendamento');

        $idUsuario = $_SESSION['user_id_usuario'];

        if ($agendamentoModel->bloquearData($data, $idUsuario)) {
            $_SESSION['sucesso_agendamento'] = 'Data marcada como indisponível.';
        } else {
            $_SESSION['erro_agendamento'] = 'Essa data já está bloqueada.';
        }

        header('Location: ' . BASE_URL . '/?url=painelAgendamento');
        exit;
    }

    // Mantém o nome do método usado anteriormente
    public function bloquear()
    {
        $this->cadastrarDisponibilidade();
    }

    // Libera uma data
    public function liberar()
    {
        $this->verificarAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/?url=painelAgendamento');
            exit;
        }

        $data = $_POST['data'] ?? '';

        $agendamentoModel = $this->model('Agendamento');

        if ($agendamentoModel->liberarData($data)) {
            $_SESSION['sucesso_agendamento'] = 'Data liberada com sucesso.';
        } else {
            $_SESSION['erro_agendamento'] = 'Não foi possível liberar a data.';
        }

        header('Location: ' . BASE_URL . '/?url=painelAgendamento');
        exit;
    }

    // Cancela um agendamento
    public function cancelar()
    {
        $this->verificarAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/?url=painelAgendamento');
            exit;
        }

        $id = $_POST['id_agendamento'] ?? '';

        $agendamentoModel = $this->model('Agendamento');

        if ($agendamentoModel->excluirAgendamento($id)) {
            $_SESSION['sucesso_agendamento'] = 'Agendamento cancelado.';
        } else {
            $_SESSION['erro_agendamento'] = 'Não foi possível cancelar o agendamento.';
        }

        header('Location: ' . BASE_URL . '/?url=painelAgendamento');
        exit;
    }
}
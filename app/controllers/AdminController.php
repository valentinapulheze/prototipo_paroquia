<?php

class AdminController extends Controller
{
    private function exigirAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            !isset($_SESSION['logged']) ||
            $_SESSION['logged'] !== true
        ) {
            header('Location: ' . BASE_URL . '/?url=login');
            exit;
        }

        if (
            (string) ($_SESSION['user_tipo_acesso'] ?? '') !== '0'
        ) {
            header('Location: ' . BASE_URL . '/?url=home');
            exit;
        }
    }

    public function index()
    {
        $this->exigirAdmin();

        // Carrega o modelo de agendamentos
        $agendamentoModel = $this->model('Agendamento');

        // Busca os agendamentos cadastrados
        $agendamentos = $agendamentoModel->getAgendamentos();

        // Envia os dados para o Dashboard
        $this->view('admin/dashboard', [
            'agendamentos' => $agendamentos
        ]);
    }
}
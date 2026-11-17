
<?php

require_once __DIR__ . '/../models/Aviso.php';

class SiteController extends Controller
{
    // Página inicial
    public function index()
    {
        // Buscar avisos
        $avisoModel = new Aviso();
        $avisos = $avisoModel->listar();

        // Buscar produtos da lojinha
        $produtoModel = $this->model('Produto');
        $produtos = $produtoModel->getAll();

        // Enviar os dados para a página inicial
        $this->view('site/home', [
            'avisos' => $avisos,
            'produtos' => $produtos
        ]);
    }

    // Página sobre
    public function sobre()
    {
        $this->view('site/sobre');
    }

    // Página de contato
    public function contato()
    {
        $this->view('site/contato');
    }

    // Dashboard administrativo
    public function dashboard()
    {
        require_once __DIR__ . '/../core/auth.php';

        $db = new Database();

        $totalUsuarios = $db->query(
            "SELECT COUNT(*) FROM usuarios"
        )->fetchColumn();

        $totalAvisos = $db->query(
            "SELECT COUNT(*) FROM avisos"
        )->fetchColumn();

        $totalEventos = $db->query(
            "SELECT COUNT(*) FROM eventos"
        )->fetchColumn();

        $totalProdutos = $db->query(
            "SELECT COUNT(*) FROM lojas"
        )->fetchColumn();

        $proximosEventos = $db->query(
            "SELECT titulo, tipo, data_inicio
             FROM eventos
             WHERE data_inicio >= CURDATE()
             ORDER BY data_inicio ASC
             LIMIT 5"
        )->fetchAll(PDO::FETCH_ASSOC);

        $this->view('site/dashboard', [
            'totalUsuarios' => $totalUsuarios,
            'totalAvisos' => $totalAvisos,
            'totalEventos' => $totalEventos,
            'totalProdutos' => $totalProdutos,
            'proximosEventos' => $proximosEventos
        ]);
    }

    // Página do dízimo
    public function dizimo()
    {
        $this->view('site/dizimo');
    }

    // Listar avisos
    public function avisos()
    {
        $avisoModel = new Aviso();
        $avisos = $avisoModel->listar();

        $this->view('site/avisos', [
            'avisos' => $avisos
        ]);
    }

    // Listar eventos
    public function eventos()
    {
        $db = new Database();

        $eventos = $db->query(
            "SELECT id_evento, tipo, titulo, data_inicio, data_fim, foto
             FROM eventos
             WHERE data_fim >= CURDATE()
             ORDER BY data_inicio ASC"
        )->fetchAll(PDO::FETCH_ASSOC);

        $this->view('site/eventos', [
            'eventos' => $eventos
        ]);
    }

    // Recuperar login
    public function recuperarLogin()
    {
        $this->view('site/recuperarLogin');
    }

    // Página de erro 404
    public function erro404()
    {
        $this->view('site/404');
    }

    // Logout
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();

        header('Location: ?url=login');
        exit;
    }

    // Página do padroeiro
    public function padroeiro()
    {
        $this->view('site/padroeiro');
    }
}

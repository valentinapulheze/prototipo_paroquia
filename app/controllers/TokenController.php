<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

// Geração do PDF
require_once __DIR__ . '/../../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class TokenController extends Controller
{

    public function list()
    {
        require_once __DIR__ . '/../core/auth.php';
        $tokenModel = $this->model('Token');
        $tokens = $tokenModel->getAll();
        $this->view('token/listToken', ['tokens' => $tokens]);
    }

    public function save()
    {
        require_once __DIR__ . '/../core/auth.php';
        $tokenModel = $this->model('Token');

        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;

            // Salva no banco (via model)
            $tokenModel->save($data);
            header('Location: ./listToken');
            exit;
        } else {
            $userModel = $this->model('User');
            $users = $userModel->getAll();
            $this->view('token/saveToken', ['users' => $users]);
        }
    }

    public function edit()
    {
        require_once __DIR__ . '/../core/auth.php';
        $tokenModel = $this->model('Token');
        $userModel = $this->model('User'); // model de usuários

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;

            $tokenModel->update($dados);
            header('Location: ./listToken');
            exit;
        } else if (isset($_GET['id'])) {
            $token = $tokenModel->getById($_GET['id']);
            $users = $userModel->getAll(); // buscar usuários
            $this->view('token/editToken', ['tokens' => $token, 'users' => $users]);
        }
    }

    public function delete()
    {
        require_once __DIR__ . '/../core/auth.php';
        if (isset($_GET['id'])) {
            $tokenModel = $this->model('Token');
            $tokenModel->delete($_GET['id']);
        }
        header('Location: ./listToken');
    }

   public function listRelatorio()
    {
        require_once __DIR__ . '/../core/auth.php';
        $tokenModel = $this->model('Token');
        $tokens = $tokenModel->getAll();
        $this->view('token/relToken', ['tokens' => $tokens]);
    }

}
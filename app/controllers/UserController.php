
<?php

class UserController extends Controller
{
    private function iniciarSessao()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // VERIFICA SE O USUÁRIO ESTÁ LOGADO
    private function exigirLogin()
    {
        $this->iniciarSessao();

        if (
            !isset($_SESSION['logged']) ||
            $_SESSION['logged'] !== true
        ) {
            header('Location: ?url=login');
            exit;
        }
    }

    // VERIFICA SE O USUÁRIO É ADMINISTRADOR
    private function exigirAdmin()
    {
        $this->exigirLogin();

        if (
            !isset($_SESSION['user_tipo_acesso']) ||
            (string) $_SESSION['user_tipo_acesso'] !== '0'
        ) {
            header('Location: ?url=home');
            exit;
        }
    }

    // LOGIN
    public function login()
    {
        $this->iniciarSessao();

        if (
            isset($_SESSION['logged']) &&
            $_SESSION['logged'] === true
        ) {
            $destino = (
                (string) ($_SESSION['user_tipo_acesso'] ?? '') === '0'
            ) ? 'dashboard' : 'home';

            header('Location: ?url=' . $destino);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = $_POST['senha'] ?? '';

            $userModel = $this->model('User');

            if ($userModel->login([
                'email' => $email,
                'senha' => $senha
            ])) {
                $userData = $userModel->getUserByEmail($email);

                if ($userData) {
                    session_regenerate_id(true);

                    $_SESSION = [];
                    $_SESSION['logged'] = true;

                    foreach ($userData as $key => $value) {
                        $_SESSION['user_' . $key] = $value;
                    }

                    $destino = (
                        (string) ($userData['tipo_acesso'] ?? '') === '0'
                    ) ? 'dashboard' : 'home';

                    header('Location: ?url=' . $destino);
                    exit;
                }
            }

            $this->view('user/login', [
                'error' => 'E-mail ou senha inválidos.'
            ]);

            return;
        }

        $this->view('user/login');
    }

    // LOGOUT
    public function logout()
    {
        $this->iniciarSessao();

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

        header('Location: ?url=home');
        exit;
    }

    // PERFIL DO PRÓPRIO USUÁRIO
    public function editPerfil()
    {
        $this->exigirLogin();

        $userModel = $this->model('User');

        $id = $_SESSION['user_id_usuario'] ?? null;
        $email = $_SESSION['user_email'] ?? null;

        if (!empty($id)) {
            $usuario = $userModel->getById($id);
        } elseif (!empty($email)) {
            $usuario = $userModel->getUserByEmail($email);
        } else {
            $usuario = false;
        }

        if (!$usuario) {
            $this->view('user/login', [
                'error' => 'Não foi possível localizar sua conta. Entre novamente.'
            ]);

            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $senha = trim($_POST['senha'] ?? '');

            if (
                $senha !== '' &&
                (strlen($senha) < 6 || strlen($senha) > 20)
            ) {
                $this->view('user/perfil', [
                    'users' => $usuario,
                    'error' => 'A senha deve ter entre 6 e 20 caracteres.'
                ]);

                return;
            }

            $dados = [
                'idusuario' => $usuario['id_usuario'],
                'senha' => $senha
            ];

            if ($userModel->update($dados)) {
                $usuarioAtualizado = $userModel->getById(
                    $usuario['id_usuario']
                );

                if ($usuarioAtualizado) {
                    foreach ($usuarioAtualizado as $key => $value) {
                        $_SESSION['user_' . $key] = $value;
                    }

                    $usuario = $usuarioAtualizado;
                }

                $this->view('user/perfil', [
                    'users' => $usuario,
                    'sucesso' => 'Perfil atualizado com sucesso!'
                ]);

                return;
            }

            $this->view('user/perfil', [
                'users' => $usuario,
                'error' => 'Não foi possível atualizar o perfil.'
            ]);

            return;
        }

        $this->view('user/perfil', [
            'users' => $usuario
        ]);
    }

    // LISTAR USUÁRIOS — SOMENTE ADMINISTRADOR
    public function list()
    {
        $this->exigirAdmin();

        $userModel = $this->model('User');
        $users = $userModel->getAll();

        $this->view('user/listUser', [
            'users' => $users
        ]);
    }

    // CADASTRO PÚBLICO DE CLIENTES
    public function register()
    {
        $this->iniciarSessao();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->view('user/register');
            return;
        }

        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $telefone = trim($_POST['telefone'] ?? '');
        $senha = $_POST['senha'] ?? '';
        $confirmarSenha = $_POST['confirmar_senha'] ?? '';

        if (
            $nome === '' ||
            !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            $senha === '' ||
            $senha !== $confirmarSenha
        ) {
            $this->view('user/register', [
                'error' => 'Confira os campos e confirme a senha corretamente.'
            ]);

            return;
        }

        if (strlen($senha) < 6 || strlen($senha) > 20) {
            $this->view('user/register', [
                'error' => 'A senha deve ter entre 6 e 20 caracteres.'
            ]);

            return;
        }

        $foto = null;

        if (
            isset($_FILES['foto']) &&
            $_FILES['foto']['error'] === UPLOAD_ERR_OK
        ) {
            $pasta = 'app/views/fotos/';

            if (!is_dir($pasta)) {
                mkdir($pasta, 0755, true);
            }

            $extensao = strtolower(
                pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION)
            );

            $permitidas = ['jpg', 'jpeg', 'png', 'webp'];

            if (in_array($extensao, $permitidas, true)) {
                $nomeFoto = uniqid('foto_', true) . '.' . $extensao;

                if (
                    move_uploaded_file(
                        $_FILES['foto']['tmp_name'],
                        $pasta . $nomeFoto
                    )
                ) {
                    $foto = $nomeFoto;
                }
            }
        }

        $userModel = $this->model('User');

        try {
            $userModel->save([
                'nome' => $nome,
                'email' => $email,
                'telefone' => $telefone,
                'tipo_acesso' => '1',
                'senha' => password_hash($senha, PASSWORD_DEFAULT),
                'foto' => $foto
            ]);

            header('Location: ?url=login');
            exit;
        } catch (PDOException $e) {
            $this->view('user/register', [
                'error' => 'Não foi possível cadastrar. Verifique se o e-mail já está registrado.'
            ]);
        }
    }

    // EDITAR USUÁRIO — SOMENTE ADMINISTRADOR
    public function edit()
    {
        $this->exigirAdmin();

        $userModel = $this->model('User');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['idusuario'] ?? null;

            if (!$id) {
                header('Location: ?url=listUser');
                exit;
            }

            $dados = [
                'idusuario' => $id,
                'nome' => trim($_POST['nome'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'telefone' => trim($_POST['telefone'] ?? ''),
                'tipo_acesso' => $_POST['tipo_acesso'] ?? '1',
                'senha' => $_POST['senha'] ?? ''
            ];

            $userModel->update($dados);

            header('Location: ?url=listUser');
            exit;
        }

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: ?url=listUser');
            exit;
        }

        $usuario = $userModel->getById($id);

        if (!$usuario) {
            header('Location: ?url=listUser');
            exit;
        }

        $this->view('user/editUser', [
            'users' => $usuario
        ]);
    }

    // EXCLUIR USUÁRIO — SOMENTE ADMINISTRADOR
    public function delete()
    {
        $this->exigirAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?url=listUser');
            exit;
        }

        $id = $_POST['idusuario'] ?? null;

        if ($id) {
            // Impede o administrador de excluir a própria conta por engano.
            $idLogado = $_SESSION['user_id_usuario'] ?? null;

            if ((string) $id !== (string) $idLogado) {
                $userModel = $this->model('User');
                $userModel->delete($id);
            }
        }

        header('Location: ?url=listUser');
        exit;
    }


    // Importação de usuários por CSV — somente administrador.
    public function importCsv()
    {
        $this->exigirAdmin();

        $dados = [];
        $sucesso = '';
        $erro = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_FILES['arquivo']) || $_FILES['arquivo']['error'] !== UPLOAD_ERR_OK) {
                $erro = 'Selecione um arquivo CSV válido.';
            } elseif (strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION)) !== 'csv') {
                $erro = 'O arquivo precisa ter a extensão .csv.';
            } else {
                $handle = fopen($_FILES['arquivo']['tmp_name'], 'r');
                if ($handle === false) {
                    $erro = 'Não foi possível ler o arquivo enviado.';
                } else {
                    $cabecalho = fgetcsv($handle, 0, ';');
                    if ($cabecalho === false) {
                        $erro = 'O arquivo CSV está vazio.';
                    } else {
                        $cabecalho[0] = preg_replace('/^\xEF\xBB\xBF/', '', (string) $cabecalho[0]);
                        $cabecalho = array_map(static function ($item) {
                            return strtolower(trim((string) $item));
                        }, $cabecalho);

                        $indice = array_flip($cabecalho);
                        $obrigatorios = ['nome', 'email', 'senha', 'tipo_acesso'];
                        $faltantes = array_diff($obrigatorios, array_keys($indice));

                        if ($faltantes) {
                            $erro = 'Cabeçalho inválido. Colunas obrigatórias: Nome, Email, Senha e Tipo_Acesso.';
                        } else {
                            $userModel = $this->model('User');
                            $inseridos = 0;
                            $linha = 1;

                            while (($colunas = fgetcsv($handle, 0, ';')) !== false) {
                                $linha++;
                                if (count($colunas) === 1 && trim((string) $colunas[0]) === '') {
                                    continue;
                                }

                                $get = static function ($campo) use ($indice, $colunas) {
                                    return isset($indice[$campo]) ? trim((string) ($colunas[$indice[$campo]] ?? '')) : '';
                                };

                                $nome = $get('nome');
                                $email = $get('email');
                                $senha = $get('senha');
                                $tipo = $get('tipo_acesso');
                                $telefone = $get('whatsapp') ?: $get('telefone');
                                $ativoTexto = $get('ativo');
                                $ativo = ($ativoTexto === '') ? 1 : (int) $ativoTexto;
                                $mensagem = '';

                                if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($senha) < 6 || !in_array($tipo, ['0', '1'], true) || !in_array($ativo, [0, 1], true)) {
                                    $mensagem = 'Dados obrigatórios inválidos.';
                                } elseif ($userModel->getUserByEmail($email)) {
                                    $mensagem = 'E-mail já cadastrado.';
                                } else {
                                    try {
                                        $userModel->save([
                                            'nome' => $nome,
                                            'email' => $email,
                                            'telefone' => $telefone,
                                            'tipo_acesso' => $tipo,
                                            'senha' => password_hash($senha, PASSWORD_DEFAULT),
                                            'foto' => '',
                                            'ativo' => $ativo
                                        ]);
                                        $inseridos++;
                                        $mensagem = 'Importado com sucesso.';
                                    } catch (Throwable $e) {
                                        $mensagem = 'Não foi possível importar este registro.';
                                    }
                                }

                                $dados[] = [
                                    'nome' => $nome,
                                    'email' => $email,
                                    'ativo' => $ativo,
                                    'tipo_acesso' => $tipo,
                                    'whatsapp' => $telefone,
                                    'email_responsavel' => $get('email_responsavel'),
                                    'nome_responsavel' => $get('nome_responsavel'),
                                    'msg' => 'Linha ' . $linha . ': ' . $mensagem
                                ];
                            }
                            $sucesso = $inseridos . ' usuário(s) importado(s) com sucesso.';
                        }
                    }
                    fclose($handle);
                }
            }
        }

        $this->view('user/saveMassa', [
            'dados' => $dados,
            'sucesso' => $sucesso,
            'erro' => $erro
        ]);
    }

    // RECUPERAR SENHA
    public function recuperarSenha()
    {
        $this->view('user/login', ['error' => 'Para recuperar o acesso, entre em contato com a secretaria da paróquia.']);
    }

    // REDEFINIR SENHA
    public function resetarSenha()
    {
        $this->view('user/login', ['error' => 'O link de redefinição de senha não está configurado. Entre em contato com a secretaria.']);
    }
}

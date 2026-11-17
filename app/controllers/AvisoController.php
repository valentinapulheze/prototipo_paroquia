<?php

require_once __DIR__ . '/../models/Aviso.php';

class AvisoController extends Controller {

    private $avisoModel;

    public function __construct() {
        $this->avisoModel = new Aviso();
    }

    private function exigirAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            ($_SESSION['logged'] ?? false) !== true ||
            (string) ($_SESSION['user_tipo_acesso'] ?? '') !== '0'
        ) {
            header('Location: ' . BASE_URL . '/?url=login');
            exit;
        }
    }

    // Página principal dos avisos
    public function index()
    {
        $this->exigirAdmin();

        $avisos = $this->avisoModel->listar();

        $this->view('aviso/index', [
            'avisos' => $avisos
        ]);
    }

    // Formulário de criação
    public function create()
    {
        $this->exigirAdmin();

        $this->view('aviso/create');
    }

    // Salvar novo aviso
    public function store()
    {
        $this->exigirAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/?url=aviso');
            exit;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $idUsuario = (int) ($_SESSION['user_id_usuario'] ?? 0);

        if ($idUsuario <= 0) {
            $_SESSION['erro'] = 'Sessão inválida. Entre novamente.';
            header('Location: ' . BASE_URL . '/?url=login');
            exit;
        }

        $titulo = trim($_POST['titulo'] ?? '');
        $detalhamento = trim($_POST['detalhamento'] ?? '');
        $mensagem = trim($_POST['mensagem'] ?? '');
        $categoria = $_POST['categoria'] ?? 'geral';
        $destaque = isset($_POST['destaque']) ? 1 : 0;
        $dataExpiracao = $_POST['data_expiracao'] ?? '';

        $categoriasValidas = ['missa', 'evento', 'pastoral', 'geral'];

        if ($titulo === '' || $detalhamento === '') {
            $_SESSION['erro'] = 'Preencha os campos obrigatórios.';
            header('Location: ' . BASE_URL . '/?url=novoAviso');
            exit;
        }

        if (
            mb_strlen($titulo) > 45 ||
            mb_strlen($detalhamento) > 100 ||
            !in_array($categoria, $categoriasValidas, true)
        ) {
            $_SESSION['erro'] = 'Confira o título, o detalhamento e a categoria.';
            header('Location: ' . BASE_URL . '/?url=novoAviso');
            exit;
        }

        if (
            $dataExpiracao !== '' &&
            !$this->dataValida($dataExpiracao)
        ) {
            $_SESSION['erro'] = 'A data de expiração é inválida.';
            header('Location: ' . BASE_URL . '/?url=novoAviso');
            exit;
        }

        $foto = '';

        try {
            // A foto é opcional. Se enviada, ela é salva em img/avisos/.
            $fotoEnviada = $this->salvarFoto($_FILES['foto'] ?? null);

            if ($fotoEnviada !== null) {
                $foto = $fotoEnviada;
            }

            $dados = [
                'id_usuario' => $idUsuario,
                'titulo' => $titulo,
                'detalhamento' => $detalhamento,
                'mensagem' => $mensagem !== '' ? $mensagem : null,
                'categoria' => $categoria,
                'destaque' => $destaque,
                'data_expiracao' => $dataExpiracao !== '' ? $dataExpiracao : null,
                'foto' => $foto
            ];

            if (!$this->avisoModel->criar($dados)) {
                throw new RuntimeException('Não foi possível salvar o aviso.');
            }

            $_SESSION['sucesso'] = 'Aviso criado com sucesso!';
            header('Location: ' . BASE_URL . '/?url=aviso');
            exit;

        } catch (Throwable $e) {
            if ($foto !== '') {
                $this->excluirArquivoFoto($foto);
            }

            error_log($e->getMessage());

            $_SESSION['erro'] = $e instanceof RuntimeException
                ? $e->getMessage()
                : 'Não foi possível salvar o aviso.';

            header('Location: ' . BASE_URL . '/?url=novoAviso');
            exit;
        }
    }

    // Formulário de edição
    public function edit($id = null)
    {
        $this->exigirAdmin();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = $id ?? ($_GET['id'] ?? null);

        if (!$id || !ctype_digit((string) $id)) {
            $_SESSION['erro'] = 'Identificador do aviso inválido.';
            header('Location: ' . BASE_URL . '/?url=aviso');
            exit;
        }

        $aviso = $this->avisoModel->buscarPorId((int) $id);

        if (!$aviso) {
            $_SESSION['erro'] = 'Aviso não encontrado.';
            header('Location: ' . BASE_URL . '/?url=aviso');
            exit;
        }

        $this->view('aviso/edit', [
            'aviso' => $aviso
        ]);
    }

    // Atualizar aviso
    public function update()
    {
        $this->exigirAdmin();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/?url=aviso');
            exit;
        }

        $id = $_POST['id_aviso'] ?? '';
        $titulo = trim($_POST['titulo'] ?? '');
        $detalhamento = trim($_POST['detalhamento'] ?? '');
        $mensagem = trim($_POST['mensagem'] ?? '');
        $categoria = $_POST['categoria'] ?? 'geral';
        $destaque = isset($_POST['destaque']) ? 1 : 0;
        $dataExpiracao = $_POST['data_expiracao'] ?? '';

        $categoriasValidas = ['missa', 'evento', 'pastoral', 'geral'];

        if (!$id || !ctype_digit((string) $id)) {
            $_SESSION['erro'] = 'Identificador do aviso inválido.';
            header('Location: ' . BASE_URL . '/?url=aviso');
            exit;
        }

        if (
            $titulo === '' ||
            $detalhamento === '' ||
            mb_strlen($titulo) > 45 ||
            mb_strlen($detalhamento) > 100 ||
            !in_array($categoria, $categoriasValidas, true)
        ) {
            $_SESSION['erro'] = 'Confira os campos obrigatórios.';
            header('Location: ' . BASE_URL . '/?url=editAviso&id=' . $id);
            exit;
        }

        if (
            $dataExpiracao !== '' &&
            !$this->dataValida($dataExpiracao)
        ) {
            $_SESSION['erro'] = 'A data de expiração é inválida.';
            header('Location: ' . BASE_URL . '/?url=editAviso&id=' . $id);
            exit;
        }

        $avisoAtual = $this->avisoModel->buscarPorId((int) $id);

        if (!$avisoAtual) {
            $_SESSION['erro'] = 'Aviso não encontrado.';
            header('Location: ' . BASE_URL . '/?url=aviso');
            exit;
        }

        $novaFoto = null;

        try {
            // Se não escolher outra foto, a foto atual continua.
            $novaFoto = $this->salvarFoto($_FILES['foto'] ?? null);

            $dados = [
                'id_aviso' => (int) $id,
                'titulo' => $titulo,
                'detalhamento' => $detalhamento,
                'mensagem' => $mensagem !== '' ? $mensagem : null,
                'categoria' => $categoria,
                'destaque' => $destaque,
                'data_expiracao' => $dataExpiracao !== '' ? $dataExpiracao : null
            ];

            if ($novaFoto !== null) {
                $dados['foto'] = $novaFoto;
            }

            if (!$this->avisoModel->atualizar($dados)) {
                throw new RuntimeException('Não foi possível atualizar o aviso.');
            }

            // Só apaga a foto antiga depois que o banco foi atualizado.
            if (
                $novaFoto !== null &&
                !empty($avisoAtual['foto']) &&
                $avisoAtual['foto'] !== $novaFoto
            ) {
                $this->excluirArquivoFoto($avisoAtual['foto']);
            }

            $_SESSION['sucesso'] = 'Aviso atualizado com sucesso!';
            header('Location: ' . BASE_URL . '/?url=aviso');
            exit;

        } catch (Throwable $e) {
            if ($novaFoto !== null) {
                $this->excluirArquivoFoto($novaFoto);
            }

            error_log($e->getMessage());

            $_SESSION['erro'] = $e instanceof RuntimeException
                ? $e->getMessage()
                : 'Não foi possível atualizar o aviso.';

            header('Location: ' . BASE_URL . '/?url=editAviso&id=' . $id);
            exit;
        }
    }

    // Excluir aviso
    public function delete()
    {
        $this->exigirAdmin();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/?url=aviso');
            exit;
        }

        $id = $_POST['id_aviso'] ?? '';

        if (!$id || !ctype_digit((string) $id)) {
            $_SESSION['erro'] = 'Identificador do aviso inválido.';
            header('Location: ' . BASE_URL . '/?url=aviso');
            exit;
        }

        try {
            $aviso = $this->avisoModel->buscarPorId((int) $id);

            if (!$aviso) {
                $_SESSION['erro'] = 'Aviso não encontrado.';
            } else {
                if (!$this->avisoModel->excluir((int) $id)) {
                    throw new RuntimeException('Não foi possível excluir o aviso.');
                }

                if (!empty($aviso['foto'])) {
                    $this->excluirArquivoFoto($aviso['foto']);
                }

                $_SESSION['sucesso'] = 'Aviso excluído com sucesso!';
            }

        } catch (Throwable $e) {
            error_log($e->getMessage());
            $_SESSION['erro'] = 'Não foi possível excluir o aviso.';
        }

        header('Location: ' . BASE_URL . '/?url=aviso');
        exit;
    }

    // Salvar foto enviada pelo formulário
    private function salvarFoto($arquivo)
    {
        if (
            empty($arquivo) ||
            !isset($arquivo['error']) ||
            $arquivo['error'] === UPLOAD_ERR_NO_FILE
        ) {
            return null;
        }

        if ($arquivo['error'] !== UPLOAD_ERR_OK) {
            throw new RuntimeException('Erro ao enviar a imagem.');
        }

        if (($arquivo['size'] ?? 0) > 5 * 1024 * 1024) {
            throw new RuntimeException('A imagem deve ter no máximo 5 MB.');
        }

        $imagem = @getimagesize($arquivo['tmp_name']);

        if ($imagem === false) {
            throw new RuntimeException('O arquivo enviado não é uma imagem válida.');
        }

        $extensoesPermitidas = [
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG  => 'png',
            IMAGETYPE_GIF  => 'gif',
            IMAGETYPE_WEBP => 'webp'
        ];

        $tipo = $imagem[2];

        if (!isset($extensoesPermitidas[$tipo])) {
            throw new RuntimeException('Formato de imagem não permitido. Use JPG, PNG, GIF ou WEBP.');
        }

        $pasta = dirname(__DIR__, 2) . '/img/avisos/';

        if (!is_dir($pasta) && !mkdir($pasta, 0777, true)) {
            throw new RuntimeException('Não foi possível criar a pasta de imagens dos avisos.');
        }

        $extensao = $extensoesPermitidas[$tipo];
        $novoNome = uniqid('aviso_', true) . '.' . $extensao;
        $destino = $pasta . $novoNome;

        if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {
            throw new RuntimeException('Não foi possível salvar a imagem.');
        }

        return 'img/avisos/' . $novoNome;
    }

    // Apagar somente arquivos que pertencem à pasta de avisos
    private function excluirArquivoFoto($foto)
    {
        $foto = ltrim((string) $foto, '/');

        if (strpos($foto, 'img/avisos/') !== 0) {
            return;
        }

        $arquivo = dirname(__DIR__, 2) . '/' . $foto;

        if (is_file($arquivo)) {
            @unlink($arquivo);
        }
    }

    // Validar data no formato YYYY-MM-DD
    private function dataValida($data)
    {
        $dataObj = DateTime::createFromFormat('!Y-m-d', $data);

        return $dataObj && $dataObj->format('Y-m-d') === $data;
    }
}

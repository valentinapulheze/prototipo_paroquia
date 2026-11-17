
<?php

class LojaController extends Controller
{
    // Listar produtos
    public function list()
    {
        require_once __DIR__ . '/../core/auth.php';

        $produtoModel = $this->model('Produto');
        $produtos = $produtoModel->getAll();

        $this->view('produto/listProduto', [
            'produtos' => $produtos
        ]);
    }

    // Cadastrar produto
    public function save()
    {
        require_once __DIR__ . '/../core/auth.php';

        $produtoModel = $this->model('Produto');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $idUsuario = $_SESSION['user_id_usuario'] ?? null;

            if (!$idUsuario) {
                die('Usuário não identificado na sessão.');
            }

            $titulo = trim($_POST['titulo'] ?? '');
            $preco = $_POST['preco'] ?? '';

            if ($titulo === '' || !is_numeric($preco) || $preco < 0) {
                die('Preencha corretamente o nome e o preço do produto.');
            }

            if (
                !isset($_FILES['foto']) ||
                $_FILES['foto']['error'] !== UPLOAD_ERR_OK
            ) {
                die('É necessário selecionar uma imagem.');
            }

            $extensao = strtolower(
                pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION)
            );

            $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (!in_array($extensao, $extensoesPermitidas, true)) {
                die('Formato de imagem não permitido.');
            }

            $pasta = 'img/lojinha/';

            if (!is_dir($pasta)) {
                mkdir($pasta, 0777, true);
            }

            $novoNome = uniqid('produto_', true) . '.' . $extensao;
            $destino = $pasta . $novoNome;

            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                die('Erro ao enviar a imagem.');
            }

            $dados = [
                'id_usuario' => $idUsuario,
                'titulo' => $titulo,
                'preco' => $preco,
                'foto' => $destino
            ];

            $produtoModel->save($dados);

            header('Location: ' . BASE_URL . '/?url=listProduto');
            exit;
        }

        $this->view('produto/saveProduto');
    }

    // Editar produto
    public function edit()
    {
        require_once __DIR__ . '/../core/auth.php';

        $produtoModel = $this->model('Produto');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id_loja'] ?? null;

            if (!$id || !ctype_digit((string)$id)) {
                die('Produto inválido.');
            }

            $produtoAtual = $produtoModel->getById($id);

            if (!$produtoAtual) {
                die('Produto não encontrado.');
            }

            $titulo = trim($_POST['titulo'] ?? '');
            $preco = $_POST['preco'] ?? '';

            if ($titulo === '' || !is_numeric($preco) || $preco < 0) {
                die('Preencha corretamente o nome e o preço.');
            }

            $foto = $produtoAtual['foto'];

            if (
                isset($_FILES['foto']) &&
                $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE
            ) {
                if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
                    die('Erro ao enviar a imagem.');
                }

                $extensao = strtolower(
                    pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION)
                );

                $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (!in_array($extensao, $extensoesPermitidas, true)) {
                    die('Formato de imagem não permitido.');
                }

                $pasta = 'img/lojinha/';

                if (!is_dir($pasta)) {
                    mkdir($pasta, 0777, true);
                }

                $novoNome = uniqid('produto_', true) . '.' . $extensao;
                $destino = $pasta . $novoNome;

                if (!move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                    die('Erro ao enviar a nova imagem.');
                }

                $fotoAntiga = $produtoAtual['foto'];
                $foto = $destino;

                if (
                    !empty($fotoAntiga) &&
                    is_file($fotoAntiga) &&
                    strpos($fotoAntiga, 'img/lojinha/') === 0
                ) {
                    unlink($fotoAntiga);
                }
            }

            $dados = [
                'id_loja' => $id,
                'titulo' => $titulo,
                'preco' => $preco,
                'foto' => $foto
            ];

            $produtoModel->update($dados);

            header('Location: ' . BASE_URL . '/?url=listProduto');
            exit;
        }

        $id = $_GET['id'] ?? null;

        if (!$id || !ctype_digit((string)$id)) {
            die('Produto inválido.');
        }

        $produto = $produtoModel->getById($id);

        if (!$produto) {
            die('Produto não encontrado.');
        }

        $this->view('produto/editProduto', [
            'produto' => $produto
        ]);
    }

    // Excluir produto
    public function delete()
    {
        require_once __DIR__ . '/../core/auth.php';

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/?url=listProduto');
            exit;
        }

        $id = $_POST['id_loja'] ?? null;

        if (!$id || !ctype_digit((string)$id)) {
            die('Produto inválido.');
        }

        $produtoModel = $this->model('Produto');
        $produto = $produtoModel->getById($id);

        if ($produto) {
            $produtoModel->delete($id);

            if (
                !empty($produto['foto']) &&
                is_file($produto['foto']) &&
                strpos($produto['foto'], 'img/lojinha/') === 0
            ) {
                unlink($produto['foto']);
            }
        }

        header('Location: ' . BASE_URL . '/?url=listProduto');
        exit;
    }

    // Relatório
    public function listRelatorio()
    {
        require_once __DIR__ . '/../core/auth.php';

        $produtoModel = $this->model('Produto');
        $produtos = $produtoModel->getAll();

        $this->view('produto/relProduto', [
            'produtos' => $produtos
        ]);
    }

    // Loja pública
    public function loja()
    {
        $produtoModel = $this->model('Produto');
        $produtos = $produtoModel->getAll();

        $this->view('loja/index', [
            'produtos' => $produtos
        ]);
    }

    // Detalhes do produto
    public function detalhe()
    {
        $id = $_GET['id'] ?? null;

        if (!$id || !ctype_digit((string)$id)) {
            header('Location: ' . BASE_URL . '/?url=loja');
            exit;
        }

        $produtoModel = $this->model('Produto');
        $produto = $produtoModel->getById($id);

        if (!$produto) {
            header('Location: ' . BASE_URL . '/?url=loja');
            exit;
        }

        $this->view('loja/detalhe', [
            'produto' => $produto
        ]);
    }

    public function padroeiro()
{
    $this->view('site/padroeiro');
}
}

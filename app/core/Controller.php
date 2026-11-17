
<?php

class Controller
{
    public function model($model)
    {
        $arquivo = __DIR__ . '/../models/' . basename($model) . '.php';

        if (!is_file($arquivo)) {
            throw new RuntimeException(
                'Modelo não encontrado: ' .
                htmlspecialchars($model, ENT_QUOTES, 'UTF-8')
            );
        }

        require_once $arquivo;

        if (!class_exists($model)) {
            throw new RuntimeException('Classe do modelo não encontrada.');
        }

        return new $model();
    }

    public function view($view, $data = [])
    {
        extract($data, EXTR_SKIP);

        $arquivoView = __DIR__ . '/../views/' . $view . '.php';

        if (!is_file($arquivoView)) {
            throw new RuntimeException(
                'Visualização não encontrada: ' .
                htmlspecialchars($view, ENT_QUOTES, 'UTF-8')
            );
        }

        require_once __DIR__ . '/../views/layout/header.php';

        require $arquivoView;

        require_once __DIR__ . '/../views/layout/footer.php';
    }
}

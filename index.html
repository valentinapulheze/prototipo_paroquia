
<?php

// Configurações principais
if (!defined('BASE_URL')) {
    define('BASE_URL', '/paroquia_prototipo');
}

if (!defined('APP_DEBUG')) {
    define('APP_DEBUG', false);
}

// Inicia a sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carrega dependências
require_once __DIR__ . '/vendor/autoload.php';

// Depuração
if (APP_DEBUG) {
    require_once __DIR__ . '/debug/init.php';
}

require_once __DIR__ . '/debug/SysPDODebug.php';
require_once __DIR__ . '/app/core/Controller.php';
require_once __DIR__ . '/app/core/Database.php';
require_once __DIR__ . '/routes/routes.php';

// Identifica a rota
$uri = trim($_GET['url'] ?? 'home', '/');

// Verifica se a rota existe
if (!isset($routes[$uri])) {
    http_response_code(404);

    $controllerPath = __DIR__ . '/app/controllers/ErrorController.php';

    if (is_file($controllerPath)) {
        require_once $controllerPath;

        if (class_exists('ErrorController')) {
            $controller = new ErrorController();

            if (is_callable([$controller, 'erro404'])) {
                $controller->erro404();
                exit;
            }
        }
    }

    exit('Erro 404: página não encontrada.');
}

// Obtém informações da rota
$controllerName = $routes[$uri]['controller'];
$method = $routes[$uri]['method'];

$controllerPath = __DIR__ . '/app/controllers/' . $controllerName . '.php';

// Verifica o arquivo
if (!is_file($controllerPath)) {
    http_response_code(500);
    exit('Arquivo do controlador não encontrado: ' . htmlspecialchars($controllerName));
}

require_once $controllerPath;

// Verifica a classe
if (!class_exists($controllerName)) {
    http_response_code(500);
    exit('Classe não encontrada: ' . htmlspecialchars($controllerName));
}

// Instancia o controlador
$controller = new $controllerName();

// Verifica o método
if (!is_callable([$controller, $method])) {
    http_response_code(500);
    exit(
        'Método não encontrado: ' .
        htmlspecialchars($controllerName . '::' . $method)
    );
}

// Executa a rota
$controller->$method();

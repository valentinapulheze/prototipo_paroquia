<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/DebugPDO/SqlErrorContext.php";

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

error_reporting(E_ALL);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$whoops = new Run();

$handler = new PrettyPageHandler();

/*
 * Permite abrir o arquivo diretamente no Visual Studio Code
 * quando houver um erro.
 */
$handler->setEditor('vscode');

$handler->addDataTableCallback(
    'Operação SQL que gerou o erro',
    static function (): array {
        return SqlErrorContext::getLastError();
    }
);

// $whoops->pushHandler($handler);

$whoops->pushHandler($handler);
$whoops->register();

<?php
class ErrorController extends Controller {

    public function erro404() {
        http_response_code(404);
        require_once __DIR__ . '/../views/site/404.php';
    }
}
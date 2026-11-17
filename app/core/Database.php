<?php
class Database extends SysPDO {
    public function __construct() {
        $host     = 'localhost';
        $dbname   = 'paroquia_prototipo';
        $username = 'root';
        $password = '';

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        parent::__construct($dsn, $username, $password);

        // Define o charset da conexão para suportar acentos e emojis
        $this->exec("SET NAMES utf8mb4");
        $this->exec("SET CHARACTER SET utf8mb4");
        $this->exec("SET collation_connection = 'utf8mb4_unicode_ci'");
    }
}
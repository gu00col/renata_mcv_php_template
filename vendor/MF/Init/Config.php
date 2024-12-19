<?php

namespace MF\Init;

/* Credenciais do banco de dados. Supondo que você esteja rodando o MySQL 
com configuração padrão (usuário 'root' sem senha) */
define('DB_TYPE', 'mysql');
define('DB_URL', 'DB_URL');
define('DB_PORT', '3306');
define('DB_USERNAME', 'DB_USERNAME');
define('DB_PASSWORD', 'DB_PASSWORD');
define('DB_NAME', 'DB_NAME');

class Config {
    public $db_type;
    public $db_url;
    public $db_port;
    public $db_userName;
    public $db_password;
    public $db_name;

    public function __construct() {
        $this->db_type = DB_TYPE;
        $this->db_url = DB_URL; 
        $this->db_port = DB_PORT; 
        $this->db_userName = DB_USERNAME;
        $this->db_password = DB_PASSWORD; 
        $this->db_name = DB_NAME;  
    }
}

?>

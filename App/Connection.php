<?php

namespace App;

use MF\Init\Config;

class Connection extends Config {

    public static function getDb() {
        try {
            // Instanciar a classe Connection para acessar as propriedades herdadas
            $config = new self();
            $conn = new \PDO(
                sprintf("%s:host=%s;port=%s;dbname=%s;charset=utf8", $config->db_type, $config->db_url, $config->db_port, $config->db_name),
                $config->db_userName,
                $config->db_password
            );

            return $conn;

        } catch (\PDOException $e) {
            // Tratamento de exceção
            echo "Erro de conexão: " . $e->getMessage();
            return null;
        }
    }
}

?>

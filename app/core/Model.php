<?php

class Model
{
    protected $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=upsa', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->create_users_accounts_table();
        } catch (PDOException $e) {
            echo '<h1>Error Connecting The Database</h1>';
            echo $e->getMessage();
            die();
        }
    }

    private function create_users_accounts_table()
    {
        $this->pdo->query("CREATE TABLE IF NOT EXISTS users_accounts (
                    id int(4) AUTO_INCREMENT PRIMARY KEY UNIQUE,
                    name varchar(255) NOT NULL,
                    email varchar(255) NOT NULL UNIQUE,
                    password varchar(255) NOT NULL,
                    card_number varchar(255) NOT NULL,
                    created_at timestamp NULL,
                    updated_at timestamp NULL
                )");
    }
}
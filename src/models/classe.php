<?php
    require_once __DIR__ . '/../../coon/banco.php';

    class classe extends banco {
    protected $db;

    public function __construct() {
        $this->db = new banco();
        $resultado = $this->db->connect();
        if($resultado !== true){
            die($resultado);
        }
    }

    public function __destruct() {
    }
}
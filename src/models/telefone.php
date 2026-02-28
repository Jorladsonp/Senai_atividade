<?php

    require_once __DIR__ . '/classe.php';

    class telefone extends classe {
        
        protected $db;

        private int $id;
        private int $contato_id;
        private string $tipo;
        private string $numero;

        
        public function __construct() {
            $this->db = new banco();

            $resultado = $this->db->connect();

            if($resultado !== true){
                die($resultado);
            }
        }

        public function __destruct() {
        }
        public function setId($id) {
            $this->id = $id;
        }
        public function setContato_ID($contato_id) {
            $this->contato_id = $contato_id;
        }
        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }
        public function setNumero($numero) {
            $this->numero = $numero;
        }
        public function getId():int {
            return $this->id;
        }
        public function getContato_ID():int {
            return $this->contato_id;
        }
        public function getTipo():string {
            return $this->tipo;
        }
        public function getNumero():string {
            return $this->numero;
        }
        
        public function getDados(){
            $stmt = "SELECT * FROM telefones";

            $resultado = $this->db->executeQuery($stmt);
            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

            if(empty($dados)){
                print_r ("Nenhum contato encontrado.");
            } else {
                foreach ($dados as $dado) {
                    echo "Contato_ID: " . $dado['CONTATO_ID']."<br>";
                    echo "Tipo......: " . $dado['TIPO']."<br>";
                    echo "Numero....: " . $dado['NUMERO']."<br>";
                }
            }
        }

        public function getDadosComID($id){
            $stmt = "SELECT * FROM telefones WHERE id = $id";

            $resultado = $this->db->executeQuery($stmt);
            $dados = $resultado->fetch(PDO::FETCH_ASSOC);

            if(empty($dados)){
                print_r('Registro não encontrado.');
            }else{
                $this->setContato_ID($dados['CONTATO_ID']);
                $this->setTipo($dados['TIPO']);
                $this->setNumero($dados['NUMERO']);

                echo "Contato_ID: ". $this->getContato_ID()."<br>";
                echo "Tipo......: ". $this->getTipo()."<br>";
                echo "Numero....: ". $this->getNumero()."<br>";
            }

        }

        public function inserir() {
            $stmt = "INSERT INTO telefones (CONTATO_ID, TIPO, NUMERO) 
                    VALUES ('$this->contato_id', '$this->tipo', '$this->numero')";

            $this->db->executeQuery($stmt);
            echo "Telefone inserido!<br>";
        }

        public function editar(){
            $stmt = "UPDATE telefones SET 
                CONTATO_ID = '$this->contato_id',
                TIPO = '$this->tipo',
                NUMERO = '$this->numero'
            WHERE ID = '$this->id'";

            $this->db->executeQuery($stmt);
            echo "Telefone atualizado!<br>";
        }
    }

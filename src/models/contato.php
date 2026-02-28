<?php

    require_once __DIR__ . '/classe.php';

    class contato extends classe {
        
        protected $db;

        private int $id;
        private string $nome;
        private string $empresa;
        private string $cargo;
        private string $email;
        private int $ativo = 1;
        
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
        public function setNome($nome) {
            $this->nome = $nome;
        }
        public function setEmpresa($empresa) {
            $this->empresa = $empresa;
        }
        public function setCargo($cargo) {
            $this->cargo = $cargo;
        }
        public function setEmail($email) {
            $this->email = $email;
        }
        public function setAtivo($ativo) {
            $this->ativo = $ativo;
        }
        public function getId() {
            return $this->id;
        }
        public function getNome():string {
            return $this->nome;
        }
        public function getEmpresa():string {
            return $this->empresa;
        }
        public function getCargo():string {
            return $this->cargo;
        }
        public function getEmail():string {
            return $this->email;
        }
        public function getAtivo():int {
            return $this->ativo;
        }
        
        public function getDados(){
            $stmt = "SELECT * FROM contatos";

            $resultado = $this->db->executeQuery($stmt);
            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

            if(empty($dados)){
                print_r ("Nenhum contato encontrado.");
            } else {
                foreach ($dados as $dado) {
                    echo "Nome...: " . $dado['NOME']."<br>";
                    echo "Empresa: " . $dado['EMPRESA']."<br>";
                    echo "Cargo..: " . $dado['CARGO']."<br>";
                    echo "Email..: " . $dado['EMAIL']."<br>";
                    echo "Ativo..: " . $dado['ATIVO']."<br>";
                }
            }
        }

        public function getDadosComID($id){
            $stmt = "SELECT * FROM contatos WHERE id = $id";

            $resultado = $this->db->executeQuery($stmt);
            $dados = $resultado->fetch(PDO::FETCH_ASSOC);

            if(empty($dados)){
                print_r('Registro não encontrado.');
            }else{
                $this->setNome($dados['NOME']);
                $this->setEmpresa($dados['EMPRESA']);
                $this->setCargo($dados['CARGO']);
                $this->setEmail($dados['EMAIL']);
                $this->setAtivo($dados['ATIVO']);

                echo "Nome...:". $this->getNome()."<br>";
                echo "Empresa:". $this->getEmpresa()."<br>";
                echo "Cargo..:". $this->getCargo()."<br>";
                echo "Email..:". $this->getEmail()."<br>";
                echo "Ativo..:". $this->getAtivo()."<br>";
            }

        }

        public function inserir(){
            $stmt = "INSERT INTO contatos (NOME, EMPRESA, CARGO, EMAIL, ATIVO)
                    VALUES ('$this->nome', '$this->empresa', '$this->cargo', '$this->email', '$this->ativo')";

            $this->db->executeQuery($stmt);
            echo "Contato inserido!<br>";
        }

        public function editar(){
            $stmt = "UPDATE contatos SET 
                NOME = '$this->nome',
                EMPRESA = '$this->empresa',
                CARGO = '$this->cargo',
                EMAIL = '$this->email',
                ATIVO = '$this->ativo'
             WHERE ID = '$this->id'";
        
            $this->db->executeQuery($stmt);
            echo "Contato atualizado!<br>";
        }
    }

<?php

    require_once __DIR__ . '/classe.php';

    class endereco extends classe {
        
        protected $db;

        private int $id;
        private int $contato_id;
        private string $tipo;
        private string $logradouro;
        private string $numero;
        private string $complemento;
        private string $bairro;
        private string $cidade;
        private string $uf;
        private string $cep;
        private string $pais;
        
        public function __construct() {
            $this->db = new banco();

            $resultado = $this->db->connect();

            if($resultado !== true){
                die($resultado);
            }
        }

        public function __destruct() {
        }

        public function setContato_ID($contato_id) {
            $this->contato_id = $contato_id;
        }
        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }
        public function setLogradouro($logradouro) {
            $this->logradouro = $logradouro;
        }
        public function setNumero($numero) {
            $this->numero = $numero;
        }
        public function setComplemento($complemento) {
            $this->complemento = $complemento;
        }
        public function setBairro($bairro) {
            $this->bairro = $bairro;
        }
        public function setCidade($cidade) {
            $this->cidade = $cidade;
        }
        public function setUF($uf) {
            $this->uf = $uf;
        }
        public function setCEP($cep) {
            $this->cep = $cep;
        }
        public function setPais($pais) {
            $this->pais = $pais;
        }
        public function getContato_ID(): int {
            return $this->contato_id;
        }
        public function getTipo(): string {
            return $this->tipo;
        }
        public function getLogradouro(): string {
            return $this->logradouro;
        }
        public function getNumero(): string {
            return $this->numero;
        }
        public function getComplemento(): string {
            return $this->complemento;
        }
        public function getBairro(): string {
            return $this->bairro;
        }
        public function getCidade(): string {
            return $this->cidade;
        }
        public function getUF(): string {
            return $this->uf;
        }
        public function getCEP(): string {
            return $this->cep;
        }
        public function getPais(): string {
            return $this->pais;
        }
        
        public function getDados(){
            $stmt = "SELECT * FROM enderecos";

            $resultado = $this->db->executeQuery($stmt);
            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

            if(empty($dados)){
                print_r ("Nenhum contato encontrado.");
            } else {
                foreach ($dados as $dado) {
                    echo "Contato_ID...: " . $dado['CONTATO_ID']."<br>";
                    echo "Tipo: " . $dado['TIPO']."<br>";
                    echo "Logradouro..: " . $dado['LOGRADOURO']."<br>";
                    echo "Número..: " . $dado['NUMERO']."<br>";
                    echo "Complemento..: " . $dado['COMPLEMENTO']."<br>";
                    echo "Bairro...: " . $dado['BAIRRO']."<br>";
                    echo "Cidade: " . $dado['CIDADE']."<br>";
                    echo "UF..: " . $dado['UF']."<br>";
                    echo "CEP..: " . $dado['CEP']."<br>";
                    echo "País..: " . $dado['PAIS']."<br>";
                }
            }
        }

        public function getDadosComID($id){
            $stmt = "SELECT * FROM enderecos WHERE id = $id";

            $resultado = $this->db->executeQuery($stmt);
            $dados = $resultado->fetch(PDO::FETCH_ASSOC);

            if(empty($dados)){
                print_r('Registro não encontrado.');
            }else{
                $this->setContato_ID($dados['CONTATO_ID']);
                $this->setTipo($dados['TIPO']);
                $this->setLogradouro($dados['LOGRADOURO']);
                $this->setNumero($dados['NUMERO']);
                $this->setComplemento($dados['COMPLEMENTO']);
                $this->setBairro($dados['BAIRRO']);
                $this->setCidade($dados['CIDADE']);
                $this->setUF($dados['UF']);
                $this->setCEP($dados['CEP']);
                $this->setPais($dados['PAIS']);

                echo "Contato_ID.:" . $this->getContato_ID() . "<br>";
                echo "Tipo.......:" . $this->getTipo() . "<br>";
                echo "Logradouro.:" . $this->getLogradouro() . "<br>";
                echo "Numero.....:" . $this->getNumero() . "<br>";
                echo "Complemento:" . $this->getComplemento() . "<br>";
                echo "Bairro.....:" . $this->getBairro() . "<br>";
                echo "Cidade.....:" . $this->getCidade() . "<br>";
                echo "UF.........:" . $this->getUF() . "<br>";
                echo "CEP........:" . $this->getCEP() . "<br>";
                echo "País.......:" . $this->getPais() . "<br>";

            }

        }

        public function inserir() {
            $stmt = "INSERT INTO enderecos (CONTATO_ID, TIPO, LOGRADOURO, NUMERO, COMPLEMENTO, BAIRRO, CIDADE, UF, CEP, PAIS) 
                    VALUES ('$this->contato_id', '$this->tipo', '$this->logradouro', '$this->numero', '$this->complemento', '$this->bairro', '$this->cidade', '$this->uf', '$this->cep', '$this->pais')";

            $this->db->executeQuery($stmt);
            echo "Endereço inserido!<br>";
        }
    }

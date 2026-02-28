<?php

    require_once __DIR__ . '/classe.php';

    class visita extends classe {
        
        protected $db;

        private int $id;
        private int $contato_id;
        private string $data_visita;
        private string $hora_visita;
        private string $assunto;
        private string $observacoes;
        private string $status;
        
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
        public function setDataVisita($data_visita) {
            $this->data_visita = $data_visita;
        }   
        public function setHoraVisita($hora_visita) {
            $this->hora_visita = $hora_visita;
        }
        public function setAssunto($assunto) {
            $this->assunto = $assunto;
        }
        public function setObservacoes($observacoes) {
            $this->observacoes = $observacoes;
        }
        public function setStatus($status) {
            $this->status = $status;    
        }
        public function getContato_ID(): int {
            return $this->contato_id;
        }
        public function getDataVisita(): string {
            return $this->data_visita;
        }
        public function getHoraVisita(): string {
            return $this->hora_visita;
        }
        public function getAssunto(): string {
            return $this->assunto;
        }
        public function getObservacoes(): string {
            return $this->observacoes;
        }
        public function getStatus(): string {
            return $this->status;
        }
        
        public function getDados(){
            $stmt = "SELECT * FROM visitas";

            $resultado = $this->db->executeQuery($stmt);
            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

            if(empty($dados)){
                print_r ("Nenhum contato encontrado.");
            } else {
                foreach ($dados as $dado) {
                    echo "Contato_ID.: " . $dado['CONTATO_ID']."<br>";
                    echo "Data_Visita: " . $dado['DATA_VISITA']."<br>";
                    echo "Hora_Visita: " . $dado['HORA_VISITA']."<br>";
                    echo "Assunto....: " . $dado['ASSUNTO']."<br>";
                    echo "Observações: " . $dado['OBSERVACOES']."<br>";
                    echo "Status.....: " . $dado['STATUS']."<br>";
                }
            }
        }

        public function getDadosComID($id){
            $stmt = "SELECT * FROM visitas WHERE id = $id";

            $resultado = $this->db->executeQuery($stmt);
            $dados = $resultado->fetch(PDO::FETCH_ASSOC);

            if(empty($dados)){
                print_r('Registro não encontrado.');
            }else{
                $this->setContato_ID($dados['CONTATO_ID']);
                $this->setDataVisita($dados['DATA_VISITA']);
                $this->setHoraVisita($dados['HORA_VISITA']);
                $this->setAssunto($dados['ASSUNTO']);
                $this->setobservacoes($dados['OBSERVACOES']);
                $this->setStatus($dados['STATUS']);

                echo "Contato_ID..:" . $this->getContato_ID() . "<br>";
                echo "Data_Visita.:" . $this->getDataVisita() . "<br>";
                echo "Hora_Visita.:" . $this->getHoraVisita() . "<br>";
                echo "Assunto.....:" . $this->getAssunto() . "<br>";
                echo "Observações.:" . $this->getobservacoes() . "<br>";
                echo "Status......:" . $this->getStatus() . "<br>";
            }

        }

        public function inserir (){
            $stmt = "INSERT INTO visitas (CONTATO_ID, DATA_VISITA, HORA_VISITA, ASSUNTO, OBSERVACOES, `STATUS`)
                    VALUES ('$this->contato_id', '$this->data_visita', '$this->hora_visita', '$this->assunto', '$this->observacoes', '$this->status')";

            $this->db->executeQuery($stmt);
            echo "Visita inserida!<br>";
        }
    }

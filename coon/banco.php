<?php

    class banco {

        // define as configurações do banco que irei usar
        private string $driver = 'mysql';
        private string $host = '127.0.0.1';
        private int $port = 3306;
        private string $database = 'sistema';
        private string $username = 'root';
        private string $password = 'root123';

        //armazenar o pdo em uma variavel que é a "conexão" ao banco
        protected $pdo;

        //tentativa de coneção do banco
        public function connect():bool|string{

            //cria o dsn, a depender do tipo do banco. Junta o host, porta e database
            if($this->getDriver() == 'mysql'){
                $dsn = 'mysql:host='.$this->getHostWithPort().';dbname='.$this->getDatabase();
            }else if($this->getDriver() == 'postgres'){
                $dsn = 'pgsql:host='.$this->getHost().';port='.$this->getPort().';dbname='.$this->getDatabase();
            }else{
                return 'Não configurado driver de conexão';
            }

            //cria o pdo para conetar ao banco, precisa do DSN, user e password
            try{
                $this->pdo = new PDO($dsn, 
                                    $this->getUsername(), 
                                    $this->getPassword(), 
                                    [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);

                return true;
            }catch (PDOException $e) {
                return 'Erro ao conectar: '. $e->getMessage();
            }
            
        }

        public function executeQuery($stmt):bool|PDOStatement{
            $dados = $this->pdo->query($stmt);
            return $dados;
        }
    
        private function getDriver(): string {
            return $this->driver;
        }
        private function getDatabase() : string {
            return $this->database;
        }
        private function getHostWithPort():string{
            return $this->host.':'.$this->port;
        }

        private function getHost():string{
            return $this->host;
        }

        private function getPort():string{
            return $this->port;
        }

        private function getUsername():string{
            return $this->username;
        }

        private function getPassword():string{
            return $this->password;
        } 
    }
    
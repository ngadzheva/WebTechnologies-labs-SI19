<?php
    //require_once "../config/config.php";

    class Database {
        private $connection;
        private $insertUser;
        private $updateUser;
        private $selectUser;

        public function __construct(){
            // Config::_init();

            // $host = CONFIG['db']['host'];
            // $database = CONFIG['db']['name'];
            // $userName = CONFIG['db']['user'];
            // $password = CONFIG['db']['password'];

            $this->init("localhost", "www", "root", "");
            $this->prepareStatements();
        }

        private function init($host, $database, $userName, $password) {
            try {
                $this->connection = new PDO("mysql:host=$host;dbname=$database", $userName, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                
                $this->prepareStatements();
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        private function prepareStatements() {
            $sql = "INSERT INTO users(userName, password, email) VALUES (:user, :pass, :email)";
            $this->insertUser = $this->connection->prepare($sql);

            $sql = "UPDATE users SET userName=:userName, password=:pass, email=:email WHERE userName=:user";
            $this->updateUser = $this->connection->prepare($sql);

            $sql = "SELECT * FROM users WHERE userName=:user";
            $this->selectUser = $this->connection->prepare($sql);
        }

        public function insertUserQuery($data) {
            try{
                $this->connection->beginTransaction();

                foreach($data as $value) {
                    $this->insertUser->execute($value);
                }

                $this->connection->commit();

                return array("success" => true);
            } catch(PDOException $e){
                $this->connection->rollBack();
                echo "Connection failed: " . $e->getMessage();
                return array("success" => false, "error" => $e->getMessage());
            }
        }

        public function updateUserQuery($data) {
            try{
                $this->connection->beginTransaction();

                foreach($data as $value) {
                    $this->updateUser->execute($value);
                }

                $this->connection->commit();

                return array("success" => true);
            } catch(PDOException $e){
                $this->connection->rollBack();
                echo "Connection failed: " . $e->getMessage();
                return array("success" => false, "error" => $e->getMessage());
            }
        }

        public function selectUserQuery($data) {
            try{
                $this->selectUser->execute($data);

                return array("success" => true, "data" => $this->selectUser);
            } catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();

                return array("success" => false, "error" => $e->getMessage());
            }
        }

        function __destruct() {
            $this->connection = null;
        }
    }
?>
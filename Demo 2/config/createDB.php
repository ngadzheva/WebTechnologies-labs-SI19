<?php
    require_once "config.php";

    class CreateDatabase {
        private $connection;

        public function __construct(){
            // Config::_init();

            // $host = CONFIG["db"]["host"];
            // $database = CONFIG["db"]["name"];
            // $userName = CONFIG["db"]["user"];
            // $password = CONFIG["db"]["password"];

            $this->init("localhost", "www", "root", "");
        }

        private function init($host, $database, $userName, $password) {
            try {
                $this->connection = new PDO("mysql:host=$host", $userName, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                
                $sql = "CREATE DATABASE $database CHARACTER SET utf8 COLLATE utf8_general_ci";
                $this->connection->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        function __destruct() {
            $this->connection = null;
        }
    }
?>
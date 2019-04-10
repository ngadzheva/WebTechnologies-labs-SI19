<?php
    require_once "config.php";

    /**
     * Use this class to create a database
     */
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

        /**
         * Create connection to MariaDB on given host, user name and password
         * Then create a database with given name and UTF8 encoding
         */
        private function init($host, $database, $userName, $password) {
            try {
                $this->connection = new PDO("mysql:host=$host", $userName, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                
                $sql = "CREATE DATABASE $database CHARACTER SET utf8 COLLATE utf8_general_ci";
                $this->connection->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        /**
         * Close the connection to the DB
         */
        function __destruct() {
            $this->connection = null;
        }
    }
?>
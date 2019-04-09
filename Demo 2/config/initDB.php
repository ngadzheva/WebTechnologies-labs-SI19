<?php
    require_once "config.php";

    class InitDatabase {
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
                $this->connection = new PDO("mysql:host=$host;dbname=$database", $userName, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                
                $this->createTables();
                $this->fillTables();
            } catch(PDOExceprion $e) {
                echo $e->getMessage();
            }
        }

        private function createTables() {
            try {
                $sql = "CREATE TABLE users(
                    userName VARCHAR(30) NOT NULL PRIMARY KEY,
                    password VARCHAR(60) NOT NULL,
                    email VARCHAR(50),
                    reg_date TIMESTAMP
                )";
                $this->connection->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        private function fillTables() {
            try {
                $sql = "INSERT INTO users(userName, password, email) VALUES (?, ?, ?)";
                $statement = $this->connection->prepare($sql);

                $this->connection->beginTransaction();
                $statement->execute(["ivgerves", password_hash("s0m3Rand0mPa$$", PASSWORD_DEFAULT), "ivgerves@gmail.com"]);
                $statement->execute(["randomUser", password_hash("an0th3rRand0mPa$$", PASSWORD_DEFAULT), "randomUser@gmail.com"]);
                $this->connection->commit();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        function __destruct() {
            $this->connection = null;
        }
    }
?>
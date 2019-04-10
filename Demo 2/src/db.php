<?php
    //require_once "../config/config.php";

    /**
     * Use this class to work with a database
     * Only this class will have direct access to the database
     */
    class Database {
        /**
         * This is a PDO object, which holds the connection to the DB
         */
        private $connection;

        /**
         * These are prepared statements
         */
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
        }

        /**
         * Create connection to the database on given host, database name, user name and password
         * Then create some prepared statements, which we will use frequently
         */
        private function init($host, $database, $userName, $password) {
            try {
                $this->connection = new PDO("mysql:host=$host;dbname=$database", $userName, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                
                $this->prepareStatements();
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        /**
         * Create some prepared statements, which we will use frequently
         */
        private function prepareStatements() {
            $sql = "INSERT INTO users(userName, password, email) VALUES (:user, :pass, :email)";
            $this->insertUser = $this->connection->prepare($sql);

            $sql = "UPDATE users SET userName=:userName, password=:pass, email=:email WHERE userName=:user";
            $this->updateUser = $this->connection->prepare($sql);

            $sql = "SELECT * FROM users WHERE userName=:user";
            $this->selectUser = $this->connection->prepare($sql);
        }

        /**
         * We use this method to execute insert queries
         * We only execute the created prepared statement for inserting user in DB with new database
         * We use transaction, because we may have more than one elements in the $data array
         */
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

        /**
         * We use this method to execute update queries
         * We only execute the created prepared statement for updating user in DB with new database
         * We use transaction, because we may have more than one elements in the $data array
         */
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

        /**
         * We use this method to execute select queries
         * We only execute the created prepared statement for selecting user in DB with new database
         * If the query was executed successfully, we return the result of the executed query
         */
        public function selectUserQuery($data) {
            try{
                $this->selectUser->execute($data);

                return array("success" => true, "data" => $this->selectUser);
            } catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();

                return array("success" => false, "error" => $e->getMessage());
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
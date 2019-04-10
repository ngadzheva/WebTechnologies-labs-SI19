<?php
    require_once "config.php";

    /**
     * Use this class to initialize a database
     */
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

        /**
         * Create connection to the database on given host, database name, user name and password
         * Then create the database structure and fill it with data
         */
        private function init($host, $database, $userName, $password) {
            try {
                $this->connection = new PDO("mysql:host=$host;dbname=$database", $userName, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                
                $this->createTables();
                $this->fillTables();
            } catch(PDOExceprion $e) {
                echo $e->getMessage();
            }
        }

        /**
         * Create the database structure
         * We use standard SQL queries for creating tables, which we execute with connection->exec($sql),
         * where connection is the PDO object, which holds the connection with our database
         */
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

        /**
         * Fill the database with database
         * We use standard SQL queries for inserting data to DB tables and prepared statements
         * Also we insert the data in transaction, because we want all the data to be inserted only if
         * all the queries were executed successfully
         */
        private function fillTables() {
            try {
                $sql = "INSERT INTO users(userName, password, email) VALUES (?, ?, ?)";
                /**
                 * Prepare the sql statemant
                 */
                $statement = $this->connection->prepare($sql);

                /**
                 * Insert data in transaction
                 * The data will be inserted in the DB only if the connection->commit() method is executed
                 */
                $this->connection->beginTransaction();
                $statement->execute(["ivgerves", password_hash("s0m3Rand0mPa$$", PASSWORD_DEFAULT), "ivgerves@gmail.com"]);
                $statement->execute(["randomUser", password_hash("an0th3rRand0mPa$$", PASSWORD_DEFAULT), "randomUser@gmail.com"]);
                $this->connection->commit();
            } catch(PDOException $e) {
                /**
                 * If there was a problem with some query we call connection->rollBack(),
                 * because we don't want in this case any changes to be made in the DB
                 */
                $this->connection->rollBack();
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
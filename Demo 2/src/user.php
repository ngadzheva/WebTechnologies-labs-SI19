<?php
    require_once "db.php";

    class User {
        private $userName;
        private $password;
        private $email;
        private $db;

        public function __construct($userName, $password) {
            $this->userName = $userName;
            $this->password = $password;
            $this->db = new Database();
        }

        public function isValid() {
            $query = $this->db->selectUserQuery(array("user" => $this->userName));

            if($query["success"]) { 
                $user = $query["data"]->fetch(PDO::FETCH_ASSOC);

                if($user) {
                    if(password_verify($this->password, $user["password"])) {
                        $this->password = $user["password"];
                        $this->email = $user["email"];

                        return array("success" => true);
                    } else {
                        return array("success" => false, "error" => "Грешна парола.");
                    }
                } else {
                    return array("success" => false, "error" => "Грешно потребителско име.");
                }
            } else {
                return array("success" => false, "error" => $query["error"]);
            }
        }

        public function getUsername() {
            return $this->userName;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getEmail() {
            return $this->email;
        }

        public function updateUserInfo($userName, $password, $email) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $query = $this->db->updateUserQuery(array("userName" => $userName, "pass" => $passwordHash, "email" => $email, "user" => $this->userName));

            if($qeury["success"]) {
                $this->userName = $userName;
                $this->password = $passwordHash;
                $this->email = $email;

                return array("success" => true);
            } else {
                return array("success" => false, "error" => $query["error"]);
            }
        }

        public function insertUser($userName, $password, $email) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $query = $this->db->insertUserQuery(array("user" => $userName, "pass" => $passwordHash, "email" => $email));

            if($qeury["success"]) {
                $this->password = $passwordHash;
                $this->email = $email;

                return array("success" => true);
            } else {
                return array("success" => false, "error" => $query["error"]);
            }
        }
    }
?>
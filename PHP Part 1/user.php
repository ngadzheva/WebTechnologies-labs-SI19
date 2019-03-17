<?php
    class User {
        private $userName;
        private $password;

        public function __construct($userName, $password) {
            $this->userName = $userName;
            $this->password = $password;
        }

        public function getUserName() {
            return $this->userName;
        }

        public function setUserName($userName) {
            $this->userName = $userName;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($password) {
            $this->password = $password;
        }
    }

    /*
        // Hash the password
        $hash = password_hash('10xFor@llTheFi$h', PASSWORD_DEFAULT);
        echo $hash . "<br/>";

        // Make new user
        $user = new User('ivgerves', $hash);

        // Get the user name of the user
        echo $user->getUserName() . "<br/>"; // ivgerves

        // Verify the password of the user
        $hash = $user->getPassword();
        echo (password_verify('10xFor@llTheFi$h', $hash) ? 'Password verified' : 'Wrong password') . "<br/>"; // Password verified
        
        // Change the user name of the user
        $user->setUserName('newUser');
        echo $user->getUserName() . "<br/>"; // newUser
    */
?>
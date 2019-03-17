<?php
    // Include script from the file user.php
    require_once 'user.php';

    // Extend class User
    class Student extends User {
        private $firstName;
        private $lastName;
        private $fn;

        public function __construct($userName, $password, $firstName, $lastName, $fn) {
            // Call the parent's constructor (the constructor of class User)
            parent::__construct($userName, $password);

            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->fn = $fn;
        }

        public function getFirstName() {
            return $this->firstName;
        }

        public function setFirstName($firstName) {
            $this->firstName = $firstName;
        }

        public function getLastName() {
            return $this->lastName;
        }

        public function setLastName($lastName) {
            $this->lastName = $lastName;
        }

        public function getFn() {
            return $this->fn;
        }

        public function setFn($fn) {
            $this->fn = $fn;
        }

        public function studentInfo() {
            // parent::getUserName() calls the parent's class method getUserName()
            $studentInfo = parent::getUserName() . ': ' . $this->getFirstName() . ' ' . $this->getLastName() . ' ' . $this->getFn();

            return $studentInfo;
        }
    }

    $hash = password_hash('10xFor@llTheFi$h', PASSWORD_DEFAULT);
    // Create new student
    $student = new Student('ivgerves', $hash, 'Ivan', 'Ivanov', 62589);
    // Get student's info
    echo $student->studentInfo() . "<br/>"; // ivgerves: Ivan Ivanov 62589
    // We can access the public methods of the parent's class
    echo $student->getPassword();
?>
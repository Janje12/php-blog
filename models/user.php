<?php
require_once("db/dbconnect.php");

    class User {
        
        private $userID;
        private $firstName, $lastName, $username, $password, $email;

        function __construct($fn, $ln, $un, $pass, $email) {
            $this->firstName = $fn;
            $this->lastName = $ln;
            $this->username = $un;
            $this->password = $pass;
            $this->email = $email;
        }

        public function getFirstName() {
            return $this->firstName;
        }
        public function getLastName() {
            return $this->lastName;
        }
        public function getUsername() {
            return $this->username;
        }
        public function getPassword() {
            return $this->password;
        }
        public function getEmail() {
            return $this->email;
        }

        public static function login($username, $password) {
           $db = new Database();
           $user = $db->findUser('username', $username);
           if ($user !== null && $user['password'] === $password) 
                return $user;
            else
                return null;
        }

        public static function register($user) {
            $db = new Database();
            $user = $db->insertUser($user);
            if ($user)
                return true;
            else 
                return false;
        }
    }

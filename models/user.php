<?php
    class User {
        
        private $firstName, $lastName, $username, $password, $email;

        function __construct($fn, $ln, $un, $pass, $email) {
            $this->firstName = $fn;
            $this->lastName = $ln;
            $this->username = $un;
            $this->password = $pass;
            $this->email = $email;
        }

        public static function login($username, $password) {
            if ($username === 'test' && $password === 'test')
                return true;
            else
                return false;
        }

        public static function logout($username) {
            if (true)
                return true;
            else
                return false;
        }

        public static function register($user) {
            if (true)
                return true;
            else
                return false;
        }
    }
?>
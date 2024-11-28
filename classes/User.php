<?php 
    class User {
        private $firstname;
        private $lastname;
        private $email;
        private $username;
        private $password;

        public function setFirstname($firstname) {
            if(empty($firstname)) {
                throw new Exception("Firstname cannot be empty");
            }

            $this->firstname = $firstname;
        }

        public function getFirstname() {
            return $this->firstname;
        }



        /**
         * Get the value of lastname
         */ 
        public function getLastname()
        {
                return $this->lastname;
        }

        /**
         * Set the value of lastname
         *
         * @return  self
         */ 
        public function setLastname($lastname)
        {
                $this->lastname = $lastname;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of username
         */ 
        public function getUsername()
        {
                return $this->username;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */ 
        public function setUsername($username)
        {
                $this->username = $username;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $options = [
                    'cost' => 14,
                ];
                $this->password = password_hash($password, PASSWORD_DEFAULT, $options);

                return $this;
        }

        public function save() {
            //connect to the database
            $conn = new PDO("mysql:host=localhost;dbname=pacific_boardshop", "root", "");

            //insert query
            $statement = $conn->prepare("INSERT INTO users (firstname, lastname, email, username, password) VALUES (:firstname, :lastname, :email, :username, :password)");
            $firstname = $this->getFirstname();
            $lastname = $this->getLastname();
            $email = $this->getEmail();
            $username = $this->getUsername();
            $password = $this->getPassword();

            $statement->bindValue(":firstname", $firstname);
            $statement->bindValue(":lastname", $lastname);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":username", $username);
            $statement->bindValue(":password", $password);

            //return true or false
            $result = $statement->execute();
            return $result;

        }


        
}
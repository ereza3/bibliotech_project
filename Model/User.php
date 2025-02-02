<?php
class User {
    private $id;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $role;
    private $password;

    public function __construct($name, $surname, $email, $phone, $password) {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->role = "client";
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getName() {
        return $this->name;
    }

    public function getRole() {
        return $this->role;
    }

    public function getSurname() {
        return $this->surname;
    }
    
    public function getPhone() {
        return $this->phone;
    }


    
}
?>

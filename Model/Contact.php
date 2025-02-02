<?php
class Contact {
    private $id;
    private $name;
    private $email;
    private $message;

    public function __construct($name, $email, $message, $id = null) {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMessage() {
        return $this->message;
    }
}
?>

<?php
class Book {
    private $id;
    private $name;
    private $author;
    private $image;
    private $category;
    private $price;

    public function __construct($name, $author, $image, $category, $price, $id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->author = $author;
        $this->image = $image;
        $this->category = $category;
        $this->price = $price;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getImage() {
        return $this->image;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getPrice() {
        return $this->price;
    }
}
?>

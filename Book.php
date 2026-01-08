<?php


class Book {
    private $id;
    private $title;
    private $author;
    private $price;
    private $stock;

    public function __construct ($id, $title, $author, $price, $stock) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
        $this->stock = $stock;

    }


}
<?php


class Book {
    private $id;
    private $title;
    private $authorId;
    private $price;
    private $stock;

    public function __construct ($id, $title, $authorId, $price, $stock) {
        $this->id = $id;
        $this->title = $title;
        $this->authorId = $authorId;
        $this->price = $price;
        $this->stock = $stock;

    }

    public function getId() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getauthorId() {
        return $this->authorId;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getStock() {
        return $this->stock;
    }
}
<?php

require_once "../Models/Book.php";

interface BookRepositoryInterface {
    public function getAllBooks() : void;
    public function addBook($book) : void;
    public function getBookByTitle($title) : ?Book;
}
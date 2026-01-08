<?php

require_once "../Models/Book.php";

interface BookRepositoryInterface {
    public function getAllBooks() : array;
    public function addBook($book) : void;
    public function getBookByTitle($title) : ?Book;
}
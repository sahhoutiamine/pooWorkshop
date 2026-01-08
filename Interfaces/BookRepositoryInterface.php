<?php

require_once "../Models/Book.php";

interface BookRepositoryInterface {
    public function getAllBooks() : array;
    public function addBook($book) : void;
    public function getAuthorId($title) : ?Book;
    public function getAuthorId ($bookId) : int;
    public function getAuthorTitle ($bookId) :string;
}`
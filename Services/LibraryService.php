<?php

require_once "../Models/Book.php";
require_once "../Models/Author.php";
require_once "../Repositories/BookRepository.php";

class LibraryService {
    $books = [];

    public function desplayAllBooks () {
        $books = BookRepository::getAllBooks();
        foreach ($books as $book) {
            $authorName = BookRepository::getAuthorName($book->id);
            echo `${$book->title} by ${$authorName}, price : ${$book->price}, stock : ${$book->stock}`;
        }

    }
    public function desplayBookByTitle ($title) {
        $book = BookRepository::getBookByTitle($title);
        echo `${$book->title} by ${$authorName}, price : ${$book->price}, stock : ${$book->stock}`;
    }
    public function addBook ($book) {
        BookRepository::addBook($book);
    }




}
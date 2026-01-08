<?php

require_once "../Models/Book.php";
require_once "../Models/Author.php";
require_once "../Repositories/BookRepository.php";

class LibraryService {
    private $bookRepository;

    public function __construct() {
        $this->bookRepository = new BookRepository();
    }

    public function displayAllBooks() {
        $books = $this->bookRepository->getAllBooks();
        foreach ($books as $book) {
            $authorName = $this->bookRepository->getAuthorName($book->getId());
            echo "{$book->getTitle()} by {$authorName}, price : {$book->getPrice()}, stock : {$book->getStock()}\n";
        }
    }

    public function displayBookByTitle($title) {
        $book = $this->bookRepository->getBookByTitle($title);
        if ($book) {
            $authorName = $this->bookRepository->getAuthorName($book->getId());
            echo "{$book->getTitle()} by {$authorName}, price : {$book->getPrice()}, stock : {$book->getStock()}\n";
        } else {
            echo "Book not found.\n";
        }
    }

    public function addBook($book) {
        $this->bookRepository->addBook($book);
    }
}
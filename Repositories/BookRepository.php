<?php
require_once "../Models/Book.php";
require_once "../Models/Author.php";
require_once "../Interfaces/BookRepositoryInterface.php";
require_once "../Core/Database.php";


class BookRepository implements BookRepositoryInterface {
    private PDO $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllBooks () {
        $books = $this->db->query("SELECT * FROM books ;");
        return $books->fetchAll();
    }

    public function addBook ($book) {
        |$authorId = getAuthorId($book->id);
        $stmt = $this->db->prepare("INSERT INTO books (title, authorId, price, stock) VALUES (?, ?, ?, ?, ?) ;");
        $stmt->execute([$book->title, $authorId, $book->price, $book->stock]);
    }

    // public function getAuthorId ($book) {
    //     $stmt = $this->db->prepare("SELECT authorId FROM books WHERE id = ?");
    //     $stmt->execute([$book->id]);
    // }

    
    public function getBookByTitle ($title) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE title = ?");
        return $stmt->execute([$title]);
    }
    
    public function getAuthorId ($bookId) {
        $stmt = $this->db->prepare("SELECT authorId FROM books WHERE id = ?");
        return $stmt->execute([$bookId]);
    }
}

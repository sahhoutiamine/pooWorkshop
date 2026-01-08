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

    public function getAllBooks() : array {
        $stmt = $this->db->query("SELECT * FROM books");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $books = [];
        foreach ($results as $row) {
            $books[] = new Book($row['id'], $row['title'], $row['authorId'], $row['price'], $row['stock']);
        }
        return $books;
    }

    public function addBook($book) : void {
        $stmt = $this->db->prepare("INSERT INTO books (title, authorId, price, stock) VALUES (?, ?, ?, ?)");
        $stmt->execute([$book->getTitle(), $book->getauthorId(), $book->getPrice(), $book->getStock()]);
    }

    // public function getAuthorId ($book) {
    //     $stmt = $this->db->prepare("SELECT authorId FROM books WHERE id = ?");
    //     $stmt->execute([$book->id]);
    // }

    
    public function getBookByTitle($title) : ?Book {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE title = ?");
        $stmt->execute([$title]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Book($row['id'], $row['title'], $row['authorId'], $row['price'], $row['stock']);
        }
        return null;
    }
    
    public function getAuthorId($bookId) : int {
        $stmt = $this->db->prepare("SELECT authorId FROM books WHERE id = ?");
        $stmt->execute([$bookId]);
        $result = $stmt->fetchColumn();
        return $result ? (int)$result : 0;
    }

    public function getAuthorName($bookId) : string {
        $stmt = $this->db->prepare("SELECT a.name FROM author a INNER JOIN books b ON a.id = b.authorId WHERE b.id = ?");
        $stmt->execute([$bookId]);
        $result = $stmt->fetchColumn();
        return $result ? (string)$result : "Unknown";
    }

}

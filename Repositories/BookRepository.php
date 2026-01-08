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

   

}

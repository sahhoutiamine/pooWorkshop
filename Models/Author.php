<?php



class Author {
    private $id;
    private $name;
    private $books;


    public function __construct ($id, $name, $books) {
        $this->id = $id;
        $this->name = $name;
        $this->books = $books;
    }

}
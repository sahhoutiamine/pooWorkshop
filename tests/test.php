<?php

require_once __DIR__ . '/../Repositories/BookRepository.php';
require_once __DIR__ . '/../Services/LibraryService.php';
require_once __DIR__ . '/../Models/Book.php';
require_once __DIR__ . '/../Models/Author.php';

echo "=== INITIALIZING TESTS ===\n";

try {
    $repo = new BookRepository();
    echo "BookRepository instantiated successfully.\n";

    echo "\n--- Testing addBook ---\n";
    $testTitle = "Test Book " . rand(1000, 9999);
    // null for ID as it is auto-increment
    $newBook = new Book(null, $testTitle, 1, 19.99, 10); 
    $repo->addBook($newBook);
    echo "Book '{$testTitle}' added successfully.\n";

    echo "\n--- Testing getAllBooks ---\n";
    $books = $repo->getAllBooks();
    echo "Total books found: " . count($books) . "\n";
    if (count($books) > 0) {
        $firstBook = $books[0];
        echo "First book: " . $firstBook->getTitle() . "\n";
    }

    echo "\n--- Testing getBookByTitle ---\n";
    $fetchedBook = $repo->getBookByTitle($testTitle);
    if ($fetchedBook) {
        echo "Found book by title: " . $fetchedBook->getTitle() . "\n";
        echo "Author ID: " . $fetchedBook->getauthorId() . "\n";
    } else {
        echo "Book not found by title.\n";
    }
    
    echo "\n--- Testing getAuthorName (via Repository) ---\n";
    if ($fetchedBook) {
        $authorName = $repo->getAuthorName($fetchedBook->getId());
        echo "Author Name for book ID {$fetchedBook->getId()}: {$authorName}\n";
    }

    echo "\n--- Testing LibraryService ---\n";
    $service = new LibraryService();
    echo "LibraryService instantiated.\n";
    
    echo "Displaying all books (first 3 to avoid spam):\n";
    // We can't limit easily without modifying service, but output is buffered.
    // Actually standard output will just print all.
    // I'll wrap the service test in output capture or just let it run.
    // Use output buffering to capture displayAllBooks output
    ob_start();
    $service->displayAllBooks();
    $output = ob_get_clean();
    $lines = explode("\n", trim($output));
    echo "Service output " . count($lines) . " lines.\n";
    for($i=0; $i<min(3, count($lines)); $i++) {
        echo $lines[$i] . "\n";
    }
    
    echo "\nDisplaying specific book:\n";
    $service->displayBookByTitle($testTitle);

} catch (Exception $e) {
    echo "An unexpected error occurred: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}

echo "\n=== TESTS COMPLETED ===\n";

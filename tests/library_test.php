<?php
// tests/library_test.php

require_once __DIR__ . '/../src/Models/Book.php';
require_once __DIR__ . '/../src/Models/Member.php';
require_once __DIR__ . '/../src/Models/StudentMember.php';
require_once __DIR__ . '/../src/Models/FacultyMember.php';
require_once __DIR__ . '/../src/Models/BorrowRecord.php';
require_once __DIR__ . '/../src/Repositories/DatabaseConnection.php';
require_once __DIR__ . '/../src/Repositories/BookRepository.php';
require_once __DIR__ . '/../src/Repositories/MemberRepository.php';
require_once __DIR__ . '/../src/Repositories/BorrowRepository.php';
require_once __DIR__ . '/../src/Services/LibraryService.php';

echo "=== TEST DU SYSTÈME DE BIBLIOTHÈQUE ===\n\n";

$service = new LibraryService();

// Test 1: Étudiant emprunte un livre
echo "Test 1: Étudiant emprunte 'Clean Code'\n";
$result = $service->borrowBook(1, 1);
echo "Résultat: " . ($result['success'] ? "✓ SUCCÈS" : "✗ ÉCHEC") . "\n";
echo "Message: {$result['message']}\n";
if (isset($result['due_date'])) {
    echo "Date de retour: {$result['due_date']}\n";
}
echo "\n";

// Test 2: Professeur emprunte un livre
echo "Test 2: Professeur emprunte 'Design Patterns'\n";
$result = $service->borrowBook(2, 2);
echo "Résultat: " . ($result['success'] ? "✓ SUCCÈS" : "✗ ÉCHEC") . "\n";
echo "Message: {$result['message']}\n";
if (isset($result['due_date'])) {
    echo "Date de retour: {$result['due_date']}\n";
}
echo "\n";

// Test 3: Retour d'un livre (simuler un retard en modifiant la date d'échéance)
echo "Test 3: Retour du livre par l'étudiant\n";
$result = $service->returnBook(1, 1);
echo "Résultat: " . ($result['success'] ? "✓ SUCCÈS" : "✗ ÉCHEC") . "\n";
echo "Message: {$result['message']}\n";
if (isset($result['late_fee'])) {
    echo "Frais de retard: $" . number_format($result['late_fee'], 2) . "\n";
}
echo "\n";

// Test 4: Tentative d'emprunt d'un livre indisponible
echo "Test 4: Tentative d'emprunt d'un livre avec ID invalide\n";
$result = $service->borrowBook(1, 999);
echo "Résultat: " . ($result['success'] ? "✓ SUCCÈS" : "✗ ÉCHEC") . "\n";
echo "Message: {$result['message']}\n";
echo "\n";

// Test 5: Recherche de livres
echo "Test 5: Recherche de livres par titre\n";
$bookRepo = new BookRepository();
$books = $bookRepo->searchByTitle('Clean');
echo "Livres trouvés: " . count($books) . "\n";
foreach ($books as $book) {
    echo "- {$book->getTitle()} ({$book->getIsbn()}) - {$book->getAvailableCopies()} copies disponibles\n";
}
echo "\n";

echo "=== FIN DES TESTS ===\n";
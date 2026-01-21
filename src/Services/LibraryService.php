<?php

namespace App\Services;

class LibraryService {
    private BookRepository $bookRepo;
    private MemberRepository $memberRepo;
    private BorrowRepository $borrowRepo;

    public function __construct() {
        $this->bookRepo = new BookRepository();
        $this->memberRepo = new MemberRepository();
        $this->borrowRepo = new BorrowRepository();
    }

    public function borrowBook(int $memberId, int $bookId): array {
        try {
            $member = $this->memberRepo->findById($memberId);
            if (!$member) {
                throw new Exception("Membre introuvable");
            }
            if ($member->isExpired()) {
                throw new Exception("Adhésion expirée");
            }
            $activeCount = $this->borrowRepo->countActiveBorrows($memberId);
            if ($activeCount >= $member->getMaxBooks()) {
                throw new Exception("Limite d'emprunts atteinte ({$member->getMaxBooks()} max)");
            }
            $book = $this->bookRepo->findById($bookId);
            if (!$book || !$book->isAvailable()) {
                throw new Exception("Livre non disponible");
            }
            $borrowDate = new DateTime();
            $dueDate = (clone $borrowDate)->modify("+{$member->getLoanDays()} days");
            $record = new BorrowRecord($memberId, $bookId, $borrowDate, $dueDate);
            $db = DatabaseConnection::getInstance();
            $db->beginTransaction();

            if (!$this->borrowRepo->save($record)) {
                throw new Exception("Erreur lors de la création de l'emprunt");
            }

            $newCopies = $book->getAvailableCopies() - 1;
            if (!$this->bookRepo->updateAvailableCopies($bookId, $newCopies)) {
                throw new Exception("Erreur lors de la mise à jour du stock");
            }

            $db->commit();

            return [
                'success' => true,
                'message' => 'Emprunt effectué avec succès',
                'due_date' => $dueDate->format('Y-m-d')
            ];

        } catch (Exception $e) {
            if (isset($db) && $db->inTransaction()) {
                $db->rollBack();
            }
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    public function returnBook(int $memberId, int $bookId): array {
        try {
            
            $borrowData = $this->borrowRepo->findActiveByMemberAndBook($memberId, $bookId);
            if (!$borrowData) {
                throw new Exception("Aucun emprunt actif trouvé");
            }
            $member = $this->memberRepo->findById($memberId);
            $book = $this->bookRepo->findById($bookId);
            $returnDate = new DateTime();
            $dueDate = new DateTime($borrowData['due_date']);
            $borrowDate = new DateTime($borrowData['borrow_date']);
            
            $record = new BorrowRecord($memberId, $bookId, $borrowDate, $dueDate);
            $record->setReturnDate($returnDate);
            
            $lateFee = $record->calculateLateFee($member->getDailyLateFee());
            $db = DatabaseConnection::getInstance();
            $db->beginTransaction();

            if (!$this->borrowRepo->returnBook($borrowData['id'], $returnDate, $lateFee)) {
                throw new Exception("Erreur lors du retour");
            }

            $newCopies = $book->getAvailableCopies() + 1;
            if (!$this->bookRepo->updateAvailableCopies($bookId, $newCopies)) {
                throw new Exception("Erreur lors de la mise à jour du stock");
            }

            $db->commit();

            return [
                'success' => true,
                'message' => 'Livre retourné avec succès',
                'late_fee' => $lateFee,
                'is_late' => $lateFee > 0
            ];

        } catch (Exception $e) {
            if (isset($db) && $db->inTransaction()) {
                $db->rollBack();
            }
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
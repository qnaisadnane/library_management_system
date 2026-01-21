<?php

namespace App\Repositories;

 Class BorrowRepository {
    private PDO $db;

    public function __construct() {
        $this->db = DatabaseConnection::getInstance();
    }

    public function save(BorrowRecord $record): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO borrow_records (member_id, book_id, borrow_date, due_date) 
             VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([
            $record->getMemberId(),
            $record->getBookId(),
            $record->getBorrowDate()->format('Y-m-d'),
            $record->getDueDate()->format('Y-m-d')
        ]);
    }

    public function countActiveBorrows(int $memberId): int {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM borrow_records 
             WHERE member_id = ? AND return_date IS NULL"
        );
        $stmt->execute([$memberId]);
        return (int) $stmt->fetchColumn();
    }

    public function returnBook(int $recordId, DateTime $returnDate, float $lateFee): bool {
        $stmt = $this->db->prepare(
            "UPDATE borrow_records SET return_date = ?, late_fee = ? WHERE id = ?"
        );
        return $stmt->execute([
            $returnDate->format('Y-m-d'),
            $lateFee,
            $recordId
        ]);
    }

    public function findActiveByMemberAndBook(int $memberId, int $bookId): ?array {
        $stmt = $this->db->prepare(
            "SELECT * FROM borrow_records 
             WHERE member_id = ? AND book_id = ? AND return_date IS NULL"
        );
        $stmt->execute([$memberId, $bookId]);
        return $stmt->fetch() ?: null;
    }
}
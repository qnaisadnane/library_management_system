<?php


namespace App\Repositories;

use Repositories\DatabaseConnection;
use Models\Book;

Class BookRepository{
    private PDO $db;

    public function __construct(){
    $this->db = Database::getconnection();
    }

    public function findById($id) :Book{
        $this->db->prepare("SELECT * from book where id=?");
        $stmt = $this->db->execute([$id]);
       $data = $stmt->fetch(); 
    }

    public function findByTitle($title) :Book{
        $this->db->prepare("SELECT * from book where title=:title");
        $result = $this->db->execute([':title'=>$id]);
        return $result->fetch(PDO::FETCH_ASSOC); 
    }

      public function updateAvailableCopies(int $bookId, int $copies): bool {
        $stmt = $this->db->prepare("UPDATE books SET available_copies = ? WHERE id = ?");
        return $stmt->execute([$copies, $bookId]);
    }

    public function create($id) :array{
        $this->db->prepare("SELECT * from book where id=:id");
        $result = $this->db->execute([':id'=>$id]);
        return $result->fetch(PDO::FETCH_ASSOC); 
    }
}
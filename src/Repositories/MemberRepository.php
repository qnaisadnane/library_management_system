<?php

namespace App\Repositories;

class MemberRepository {
    private PDO $db;

    public function __construct() {
        $this->db = DatabaseConnection::getInstance();
    }

    public function findById(int $id): ?Member {
        $stmt = $this->db->prepare("SELECT * FROM members WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        
        if (!$data) return null;
        
        $expiry = new DateTime($data['membership_expiry']);
        $member = $data['type'] === 'student' 
            ? new StudentMember($data['name'], $data['email'], $expiry)
            : new FacultyMember($data['name'], $data['email'], $expiry);
        
        $member->setId($data['id']);
        return $member;
    }

    public function save(Member $member): bool {
        $type = $member instanceof StudentMember ? 'student' : 'faculty';
        $stmt = $this->db->prepare(
            "INSERT INTO members (name, email, type, membership_expiry) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([
            $member->getName(),
            $member->getEmail(),
            $type,
            $member->getMembershipExpiry()->format('Y-m-d')
        ]);
    }

    public function getUnpaidFees(int $memberId): float {
        $stmt = $this->db->prepare("SELECT unpaid_fees FROM members WHERE id = ?");
        $stmt->execute([$memberId]);
        $result = $stmt->fetch();
        return $result ? (float) $result['unpaid_fees'] : 0.0;
    }

    public function addUnpaidFees(int $memberId, float $amount): bool {
        $stmt = $this->db->prepare(
            "UPDATE members SET unpaid_fees = unpaid_fees + ? WHERE id = ?"
        );
        return $stmt->execute([$amount, $memberId]);
    }
}

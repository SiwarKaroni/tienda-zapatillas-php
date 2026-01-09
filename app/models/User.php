<?php
require_once __DIR__ . '/../../config/Database.php';

class User {

    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database;
    }

    public function getByEmail($email) {
        $stmt = $this->db->connect()->prepare(
            "SELECT * FROM users WHERE email = :email"
        );
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $stmt = $this->db->connect()->query(
            "SELECT id, name, email, role FROM users"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $email, $password, $role) {
        $stmt = $this->db->connect()->prepare(
            "INSERT INTO users (name, email, password, role)
             VALUES (:name, :email, :password, :role)"
        );

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);

        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->connect()->prepare(
            "DELETE FROM users WHERE id = :id"
        );
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

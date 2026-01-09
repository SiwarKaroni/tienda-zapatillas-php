<?php
require_once dirname(__DIR__) . '/../config/Database.php';

class Product {

    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $conn = $this->db->connect();
        $stmt = $conn->query("SELECT * FROM products ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $description, $price, $image = null) {
        $conn = $this->db->connect();
        $stmt = $conn->prepare(
            "INSERT INTO products (name, description, price, image)
             VALUES (:name, :description, :price, :image)"
        );
        return $stmt->execute([
            ':name'=>$name,
            ':description'=>$description,
            ':price'=>$price,
            ':image'=>$image
        ]);
    }

    public function delete($id) {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute([':id'=>$id]);
    }

    public function getById($id) {
        $stmt = $this->db->connect()->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id'=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

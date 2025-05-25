<?php
include_once "../helpers/Database.php";

class Department
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create($name)
    {
        $stmt = $this->db->prepare("INSERT INTO departments (name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    public function update($id, $name)
    {
        $stmt = $this->db->prepare("UPDATE departments SET name = ? WHERE id = ?");
        return $stmt->execute([$name, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM departments WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM departments");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
<?php

class Ticket
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function submit($title, $description, $userId, $departmentId)
    {
        $stmt = $this->db->prepare("INSERT INTO tickets (title, description, user_id, department_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $userId, $departmentId]);
    }

    public function uploadAttachment($ticketId, $file)
    {
        $targetDir = "../uploads/";
        $fileName = basename($file["name"]);
        $targetPath = $targetDir . $fileName;

        if (move_uploaded_file($file["tmp_name"], $targetPath)) {
            return json_encode(["message" => "File uploaded", "path" => $targetPath]);
        }
        return json_encode(["message" => "Upload failed"]);
    }
}
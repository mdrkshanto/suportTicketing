<?php
require_once "../models/Ticket.php";
require_once "../helpers/Auth.php";

class TicketController {
    public function submitTicket() {
        $data = json_decode(file_get_contents("php://input"), true);
        $userId = $data["user_id"];
        $token = $data["token"];

        if (!Auth::verifyToken($userId, $token)) {
            echo json_encode(["message" => "Unauthorized"]);
            exit(401);
        }

        $ticket = new Ticket();
        if ($ticket->submit($data["title"], $data["description"], $userId, $data["department_id"])) {
            echo json_encode(["message" => "Ticket submitted successfully"]);
            exit(200);
        } else {
            echo json_encode(["message" => "Ticket submission failed"]);
            exit(400);
        }
    }
}
<?php
require_once "../controllers/UserController.php";
require_once "../controllers/TicketController.php";
require_once "../controllers/DepartmentController.php";
require_once "../helpers/AuthMiddleware.php";

$uri = trim($_SERVER["REQUEST_URI"], "/");
$method = $_SERVER["REQUEST_METHOD"];
$userController = new UserController();
$ticketController = new TicketController();
$departmentController = new DepartmentController();

if ($method === "POST" && $uri === "register") {
    $userController->register();
    exit;
} elseif ($method === "POST" && $uri === "login") {
    $userController->login();
    exit;
} elseif ($method === "POST" && $uri === "submit-ticket") {
    AuthMiddleware::checkAuth();
    $ticketController->submitTicket();
    exit;
} elseif ($method === "POST" && $uri === "departments/create") {
    $departmentController->create();
    exit;
} elseif ($method === "GET" && $uri === "departments") {
    $departmentController->index();
    exit;
} else {
    http_response_code(404);
    echo json_encode(["message" => "Route not found"]);
    exit;
}
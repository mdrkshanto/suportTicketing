<?php
require_once "../models/Department.php";
require_once "../helpers/Auth.php";

class DepartmentController
{
    private $departmentModel;

    public function __construct()
    {
        $this->departmentModel = new Department();
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $adminId = $data["user_id"];
        $token = $data["token"];

        if (!Auth::verifyToken($adminId, $token)) {
            echo json_encode(["message" => "Unauthorized"]);
            return;
        }

        if ($this->departmentModel->create($data["name"])) {
            echo json_encode(["message" => "Department created successfully"]);
        } else {
            echo json_encode(["message" => "Failed to create department"]);
        }
    }
}
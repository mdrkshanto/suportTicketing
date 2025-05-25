<?php
require_once "../models/User.php";
require_once "../helpers/Auth.php";

class UserController
{
    public function register()
    {
//        echo json_encode(["message" => "Register function called"]);
//        exit;
        $data = json_decode(file_get_contents("php://input"), true);
        $user = new User();
        if ($user->register($data['name'], $data['email'], $data['password'], $data['role'])) {
            echo json_encode(["message" => "User registered successfully"]);
        } else {
            echo json_encode(["message" => "Registration failed"]);
        }
    }

    public function login()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $user = new User();
        $findUser = $user->first($data['email']);
        $token = $user->login($data['email'], $data['password']);
        if ($token) {
            echo json_encode([
                "token" => $token,
                "user" => $findUser,
            ]);
        } else {
            echo json_encode(["message" => "Login failed"]);
        }
    }
}
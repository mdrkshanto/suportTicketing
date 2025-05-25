<?php
require_once "Auth.php";

class AuthMiddleware {
    public static function checkAuth() {
        $headers = function_exists("apache_request_headers") ? apache_request_headers() : getallheaders();
        file_put_contents("../logs/debug_headers.txt", json_encode($headers, JSON_PRETTY_PRINT));
        if (!isset($headers["Authorization"])) {
            http_response_code(401);
            echo json_encode(["message" => "Unauthorized"]);
            exit;
        }

//        $token = isset($headers["Authorization"]) ? trim(str_replace("Bearer ", "", $headers["Authorization"])) : null;
        $token = isset($headers["Authorization"]) ? trim($headers["Authorization"]) : null;
        $userId = self::getUserIdFromToken($token);

        if (!$userId || !Auth::verifyToken($userId, $token)) {
            http_response_code(403);
            echo json_encode(["message" => "Invalid token"]);
            exit;
        }

        return $userId;
    }

    private static function getUserIdFromToken($token) {
        foreach (glob("../tokens/*.txt") as $file) {
            $storedToken = file_get_contents($file);
            if ($storedToken === $token) {
                return basename($file, ".txt");
            }
        }
        return null;
    }
}
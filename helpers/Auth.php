<?php
class Auth {
    public static function verifyToken($userId, $token) {
        $storedToken = @file_get_contents("../tokens/{$userId}.txt");
        return $storedToken === $token;
    }
}
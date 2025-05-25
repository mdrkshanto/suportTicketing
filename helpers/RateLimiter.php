<?php

class RateLimiter
{
    private static $file = "../storage/rate_limit.json";

    public static function checkLimit($userId)
    {
        if (!file_exists(self::$file)) {
            file_put_contents(self::$file, json_encode([]));
        }

        $data = json_decode(file_get_contents(self::$file), true);
        $currentTime = time();

        if (isset($data[$userId]) && ($currentTime - $data[$userId] < 60)) {
            return false; // Limit exceeded
        }

        $data[$userId] = $currentTime;
        file_put_contents(self::$file, json_encode($data));
        return true;
    }
}
<?php
class CookieManager {
    // Set cookie with options
    public static function set($name, $value, $days = 30) {
        $expiry = time() + ($days * 24 * 60 * 60);
        setcookie($name, $value, [
            'expires' => $expiry,
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }

    // Set array in cookie
    public static function setArray($name, array $value, $days = 30) {
        self::set($name, json_encode($value), $days);
    }

    // Get cookie value
    public static function get($name) {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    // Get array from cookie
    public static function getArray($name) {
        $value = self::get($name);
        return $value ? json_decode($value, true) : [];
    }

    // Delete cookie
    public static function delete($name) {
        setcookie($name, '', time() - 3600, '/');
    }

    // Check if cookie exists
    public static function exists($name) {
        return isset($_COOKIE[$name]);
    }
}
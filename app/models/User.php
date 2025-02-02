<?php
require_once __DIR__ . '/../../config/config.php';

class User
{
    public static function findByUsername($username)
    {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public static function create($name, $username, $password)
    {
        $pdo = getPDO();
        $stmt = $pdo->prepare("INSERT INTO users (name, username, password) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $username, $password]);
    }
}

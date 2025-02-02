<?php
require_once __DIR__ . '/../../config/config.php';

class Event
{
    public static function create($user_id, $name, $description, $location, $event_date, $max_capacity)
    {
        $pdo = getPDO();
        $stmt = $pdo->prepare("INSERT INTO events (created_by, name, description, location, event_date, max_capacity) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$user_id, $name, $description, $location, $event_date, $max_capacity]);
    }

    public static function getAll()
    {
        $pdo = getPDO();
        $stmt = $pdo->query("SELECT * FROM events ORDER BY event_date DESC");
        return $stmt->fetchAll();
    }

    public static function findById($id)
    {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function update($id, $name, $description, $location, $event_date, $max_capacity)
    {
        $pdo = getPDO();
        $stmt = $pdo->prepare("UPDATE events SET name = ?, description = ?, location = ?, event_date = ?, max_capacity = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $location, $event_date, $max_capacity, $id]);
    }

    public static function delete($id)
    {
        $pdo = getPDO();
        $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

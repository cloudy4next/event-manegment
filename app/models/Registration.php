<?php
require_once __DIR__ . '/../../config/config.php';

class Registration
{
    public static function create($user_id, $event_id, $name, $email, $address, $mobile)
    {
        $pdo = getPDO();
        $stmt = $pdo->prepare("INSERT INTO registrations (user_id, event_id, name, email, address, mobile) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$user_id, $event_id, $name, $email, $address, $mobile]);
    }

    public static function findByEventId($event_id)
    {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM registrations WHERE event_id = ?");
        $stmt->execute([$event_id]);
        return $stmt->fetchAll();
    }

    public static function countByEventId($event_id)
    {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM registrations WHERE event_id = ?");
        $stmt->execute([$event_id]);
        $row = $stmt->fetch();
        return $row ? (int) $row['count'] : 0;
    }

    public static function getAll()
    {
        $pdo = getPDO();
        $stmt = $pdo->query("
        SELECT 
            r.id, 
            r.name AS user_name, 
            r.email, 
            r.address, 
            r.mobile, 
            r.registered_at, 
            e.name AS ev_name, 
            e.event_date, 
            e.location 
        FROM registrations r
        INNER JOIN events e ON r.event_id = e.id
        ORDER BY r.registered_at DESC
    ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPaginatedByEventId($event_id, $limit, $offset) {
        $db = getPDO();
        $stmt = $db->prepare("
            SELECT 
                id, 
                name, 
                email, 
                address, 
                mobile, 
                registered_at 
            FROM registrations 
            WHERE event_id = :event_id 
            ORDER BY registered_at DESC 
            LIMIT :limit OFFSET :offset
        ");
        
        $stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public static function getByEventId($event_id)
    {
        $pdo = getPDO(); 
        $stmt = $pdo->prepare("SELECT * FROM registrations WHERE event_id = ?");
        $stmt->execute([$event_id]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }


}

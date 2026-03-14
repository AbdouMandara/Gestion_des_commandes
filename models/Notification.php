<?php

class Notification extends Model {
    public function create($client_id, $commande_id, $message) {
        $stmt = $this->db->prepare("INSERT INTO notifications (client_id, commande_id, message) VALUES (?, ?, ?)");
        return $stmt->execute([$client_id, $commande_id, $message]);
    }

    public function getUnreadByClient($client_id) {
        $stmt = $this->db->prepare("SELECT * FROM notifications WHERE client_id = ? AND is_read = FALSE ORDER BY created_at DESC");
        $stmt->execute([$client_id]);
        return $stmt->fetchAll();
    }

    public function getAllByClient($client_id, $limit = 10) {
        $stmt = $this->db->prepare("SELECT * FROM notifications WHERE client_id = ? ORDER BY created_at DESC LIMIT ?");
        $stmt->execute([$client_id, (int)$limit]);
        return $stmt->fetchAll();
    }

    public function markAsRead($id) {
        $stmt = $this->db->prepare("UPDATE notifications SET is_read = TRUE WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function markAsReadAll($client_id) {
        $stmt = $this->db->prepare("UPDATE notifications SET is_read = TRUE WHERE client_id = ?");
        return $stmt->execute([$client_id]);
    }
}

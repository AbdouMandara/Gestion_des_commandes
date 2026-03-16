<?php

class Client extends Model {
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM clients ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM clients WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO clients (name, email, phone, address) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$data['name'], $data['email'], $data['phone'], $data['address']]);
    }



    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM clients WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getCount() {
        return $this->db->query("SELECT COUNT(*) FROM clients")->fetchColumn();
    }
}

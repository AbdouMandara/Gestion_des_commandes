<?php

class Produit extends Model {
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM produits ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM produits WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO produits (name, price, quantity, description) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$data['name'], $data['price'], $data['quantity'], $data['description']]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE produits SET name = ?, price = ?, quantity = ?, description = ? WHERE id = ?");
        return $stmt->execute([$data['name'], $data['price'], $data['quantity'], $data['description'], $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM produits WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getCount() {
        return $this->db->query("SELECT COUNT(*) FROM produits")->fetchColumn();
    }
}

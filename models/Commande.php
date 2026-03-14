<?php

class Commande extends Model {
    public function getAll($client_id = null) {
        $sql = "SELECT c.*, cl.name as client_name FROM commandes c JOIN clients cl ON c.client_id = cl.id";
        if ($client_id) {
            $sql .= " WHERE c.client_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$client_id]);
        } else {
            $sql .= " ORDER BY c.created_at DESC";
            $stmt = $this->db->query($sql);
        }
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT c.*, cl.name as client_name FROM commandes c JOIN clients cl ON c.client_id = cl.id WHERE c.id = ?");
        $stmt->execute([id]);
        return $stmt->fetch();
    }

    public function getItems($commande_id) {
        $stmt = $this->db->prepare("SELECT cp.*, p.name as product_name FROM commande_produits cp JOIN produits p ON cp.produit_id = p.id WHERE cp.commande_id = ?");
        $stmt->execute([$commande_id]);
        return $stmt->fetchAll();
    }

    public function create($client_id, $items) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("INSERT INTO commandes (client_id, total_amount, status) VALUES (?, ?, ?)");
            $stmt->execute([$client_id, 0, 'en attente']);
            $commande_id = $this->db->lastInsertId();

            $total = 0;
            foreach ($items as $item) {
                $product_id = $item['id'];
                $quantity = $item['quantity'];

                // Get product info for price and stock check
                $stmt = $this->db->prepare("SELECT price, quantity FROM produits WHERE id = ?");
                $stmt->execute([$product_id]);
                $product = $stmt->fetch();

                if (!$product || $product['quantity'] < $quantity) {
                    throw new Exception("Stock insuffisant pour le produit ID $product_id");
                }

                $price = $product['price'];
                $subtotal = $price * $quantity;
                $total += $subtotal;

                // Add to pivot table
                $stmt = $this->db->prepare("INSERT INTO commande_produits (commande_id, produit_id, quantity, price_at_purchase) VALUES (?, ?, ?, ?)");
                $stmt->execute([$commande_id, $product_id, $quantity, $price]);
            }

            // Update total amount
            $stmt = $this->db->prepare("UPDATE commandes SET total_amount = ? WHERE id = ?");
            $stmt->execute([$total, $commande_id]);

            $this->db->commit();
            return $commande_id;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function updateStatus($id, $status) {
        try {
            $this->db->beginTransaction();

            // Check current status before update
            $stmt = $this->db->prepare("SELECT status FROM commandes WHERE id = ?");
            $stmt->execute([$id]);
            $currentStatus = $stmt->fetchColumn();
            
            // Deduct stock if moving from "en attente" to "en cours" or "livrée"
            if ($currentStatus === 'en attente' && in_array($status, ['en cours', 'livrée'])) {
                $items = $this->getItems($id);
                foreach ($items as $item) {
                    $product_id = $item['produit_id'];
                    $quantity = $item['quantity'];

                    // Strict stock check again at validation time
                    $stmtCheck = $this->db->prepare("SELECT quantity, name FROM produits WHERE id = ?");
                    $stmtCheck->execute([$product_id]);
                    $productVal = $stmtCheck->fetch();

                    if (!$productVal || $productVal['quantity'] < $quantity) {
                        throw new Exception("Stock insuffisant pour le produit: " . htmlspecialchars($productVal['name'] ?? 'Inconnu') . ". Impossible de valider.");
                    }

                    // Deduct stock
                    $stmtUpdate = $this->db->prepare("UPDATE produits SET quantity = quantity - ? WHERE id = ?");
                    $stmtUpdate->execute([$quantity, $product_id]);
                }
            }
            
            $stmt = $this->db->prepare("UPDATE commandes SET status = ? WHERE id = ?");
            $stmt->execute([$status, $id]);

            // Get client_id for notification
            $stmt = $this->db->prepare("SELECT client_id FROM commandes WHERE id = ?");
            $stmt->execute([$id]);
            $res = $stmt->fetch();
            
            if ($res) {
                $client_id = $res['client_id'];
                $message = "";
                switch($status) {
                    case 'en cours':
                        $message = "Votre commande #$id a été prise en compte et est en cours de traitement.";
                        break;
                    case 'livrée':
                        $message = "Votre commande #$id a été livrée. Merci de votre confiance !";
                        break;
                    case 'rejetée':
                        $message = "Désolé, votre commande #$id a été rejetée. Contactez le support pour plus d'informations.";
                        break;
                }

                if ($message) {
                    require_once 'models/Notification.php';
                    $notifModel = new Notification();
                    $notifModel->create($client_id, $id, $message);
                }
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function delete($id) {
        return $this->db->prepare("DELETE FROM commandes WHERE id = ?")->execute([$id]);
    }

    public function getCount($status = null) {
        if ($status) {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM commandes WHERE status = ?");
            $stmt->execute([$status]);
            return $stmt->fetchColumn();
        }
        return $this->db->query("SELECT COUNT(*) FROM commandes")->fetchColumn();
    }
}

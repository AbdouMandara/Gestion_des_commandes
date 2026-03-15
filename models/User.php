<?php

class User extends Model {
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create($username, $email, $password, $role = 'client') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Assuming we still want to keep 'username' as well for some reason, maybe set it same as email if needed.
        // Wait, the client said: "add the email column" but didn't explicitly say remove username.
        // I will just insert email where username was inserted previously, if username is required, or just both as email.
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword, $role]);
    }
}

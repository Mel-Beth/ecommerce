<?php
class Utilisateur {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getById($id) {
        $query = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getByEmail($email) {
        $query = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nom, $email, $password, $role = 'client') {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = $this->pdo->prepare("INSERT INTO utilisateurs (nom, email, password, role) VALUES (?, ?, ?, ?)");
        $query->execute([$nom, $email, $hashedPassword, $role]);
    }
}
?>

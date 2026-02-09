<?php
class UserModel {
    private PDO $bdd;

    public function __construct(PDO $bdd) {
        $this->bdd = $bdd;
    }

    // --- SIGN UP: Add a new user ---
    public function addUser(string $firstname, string $lastname, string $email, string $login, string $password): bool {
        $query = "INSERT INTO user (firstname, lastname, email, login, psswrd) VALUES (?, ?, ?, ?, MD5(?))";
        $req = $this->bdd->prepare($query);
        return $req->execute([$firstname, $lastname, $email, $login, $password]);
    }

    // --- SIGN IN: Find a user by email and password (MD5) ---
    public function getUserByEmailAndPassword(string $email, string $password) {
        $query = "SELECT * FROM user WHERE email = ? AND psswrd = MD5(?)";
        $req = $this->bdd->prepare($query);
        $req->execute([$email, $password]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    
    // Check if an email already exists (to avoid duplicates)
    public function emailExists(string $email): bool {
        $query = "SELECT id_user FROM user WHERE email = ?";
        $req = $this->bdd->prepare($query);
        $req->execute([$email]);
        return (bool)$req->fetch();
    }

    // --- GET USER BY ID ---
    public function getUserById(int $id) {
        $query = "SELECT * FROM user WHERE id_user = ?";
        $req = $this->bdd->prepare($query);
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    // --- UPDATE USER INFO ---
    public function updateUserInfo(int $id, string $email, string $password = null): bool {
        if ($password) {
            $query = "UPDATE user SET email = ?, psswrd = MD5(?) WHERE id_user = ?";
            $req = $this->bdd->prepare($query);
            return $req->execute([$email, $password, $id]);
        } else {
            $query = "UPDATE user SET email = ? WHERE id_user = ?";
            $req = $this->bdd->prepare($query);
            return $req->execute([$email, $id]);
        }
    }
}
?>
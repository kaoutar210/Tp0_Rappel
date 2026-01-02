<?php
class Developer {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function lister(){
        $stmt = $this->pdo->query("SELECT * FROM developpeurs");
        return $stmt->fetchAll();
    }

    public function ajouter($nom, $email, $image = null){
        $stmt = $this->pdo->prepare("INSERT INTO developpeurs (nom,email,image) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $email, $image]);
        return $this->pdo->lastInsertId();
    }

    public function obtenirParId($id){
        $stmt = $this->pdo->prepare("SELECT * FROM developpeurs WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function modifier($id, $nom, $email, $image){
        $stmt = $this->pdo->prepare("UPDATE developers SET nom=?, email=?, image=? WHERE id=?");
        $stmt->execute([$nom,$email,$image,$id]);
    }

    public function supprimer($id){
        $stmt = $this->pdo->prepare("DELETE FROM developers WHERE id=?");
        $stmt->execute([$id]);
    }
}
?>

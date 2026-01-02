<?php
class Projet {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    // 1️⃣ Lister tous les projets
    public function lister(){
        $stmt = $this->pdo->query("SELECT * FROM projets");
        return $stmt->fetchAll();
    }

    // 2️⃣ Ajouter un projet
    public function ajouter($titre, $description){
        $stmt = $this->pdo->prepare("INSERT INTO projets (titre, description) VALUES (?, ?)");
        $stmt->execute([$titre,$description]);
        return $this->pdo->lastInsertId();
    }

    // 3️⃣ Obtenir un projet par son ID
    public function obtenirParId($id){
        $stmt = $this->pdo->prepare("SELECT * FROM projets WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // 4️⃣ Modifier un projet
    public function modifier($id, $titre, $description){
        $stmt = $this->pdo->prepare("UPDATE projets SET titre=?, description=? WHERE id=?");
        $stmt->execute([$titre,$description,$id]);
    }

    // 5️⃣ Supprimer un projet
    public function supprimer($id){
        $stmt = $this->pdo->prepare("DELETE FROM projets WHERE id=?");
        $stmt->execute([$id]);
    }
}
?>

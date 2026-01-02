<?php
class Technologie {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function lister() {
        $stmt = $this->pdo->query("SELECT * FROM technologies ORDER BY nom ASC");
        return $stmt->fetchAll();
    }

   
    public function ajouter($nom, $description = null) {
       
        $stmt = $this->pdo->prepare("SELECT id FROM technologies WHERE nom = ?");
        $stmt->execute([$nom]);
        if ($stmt->fetch()) {
            throw new Exception("La technologie '$nom' existe déjà !");
        }

       
        $stmt = $this->pdo->prepare("INSERT INTO technologies (nom, description) VALUES (?, ?)");
        $stmt->execute([$nom, $description]);
        return $this->pdo->lastInsertId();
    }

    
    public function obtenirParId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM technologies WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

 
    public function modifier($id, $nom, $description = null) {
       
        $stmt = $this->pdo->prepare("SELECT id FROM technologies WHERE nom = ? AND id != ?");
        $stmt->execute([$nom, $id]);
        if ($stmt->fetch()) {
            throw new Exception("La technologie '$nom' existe déjà !");
        }

        $stmt = $this->pdo->prepare("UPDATE technologies SET nom = ?, description = ? WHERE id = ?");
        $stmt->execute([$nom, $description, $id]);
    }

  
    public function supprimer($id) {
        $stmt = $this->pdo->prepare("DELETE FROM technologies WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>

<?php
class Technologie {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // ✅ Lister toutes les technologies
    public function lister() {
        $stmt = $this->pdo->query("SELECT * FROM technologies ORDER BY nom ASC");
        return $stmt->fetchAll();
    }

    // ✅ Ajouter une technologie (nom + description optionnelle)
    public function ajouter($nom, $description = null) {
        // Vérifier si le nom existe déjà
        $stmt = $this->pdo->prepare("SELECT id FROM technologies WHERE nom = ?");
        $stmt->execute([$nom]);
        if ($stmt->fetch()) {
            throw new Exception("La technologie '$nom' existe déjà !");
        }

        // Insérer
        $stmt = $this->pdo->prepare("INSERT INTO technologies (nom, description) VALUES (?, ?)");
        $stmt->execute([$nom, $description]);
        return $this->pdo->lastInsertId();
    }

    // ✅ Obtenir une technologie par ID
    public function obtenirParId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM technologies WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // ✅ Modifier une technologie
    public function modifier($id, $nom, $description = null) {
        // Vérifier si le nom existe déjà pour un autre ID
        $stmt = $this->pdo->prepare("SELECT id FROM technologies WHERE nom = ? AND id != ?");
        $stmt->execute([$nom, $id]);
        if ($stmt->fetch()) {
            throw new Exception("La technologie '$nom' existe déjà !");
        }

        $stmt = $this->pdo->prepare("UPDATE technologies SET nom = ?, description = ? WHERE id = ?");
        $stmt->execute([$nom, $description, $id]);
    }

    // ✅ Supprimer une technologie
    public function supprimer($id) {
        $stmt = $this->pdo->prepare("DELETE FROM technologies WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>

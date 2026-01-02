<?php
require_once('../db.php');
require_once('../classes/Technologie.php');

$techno = new Technologie($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $description = $_POST['description'] ?? '';

     try {
        $techno->ajouter($nom, $description);
        header("Location: lister.php");
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage(); 
    }
}
?>

<h2>Ajouter une technologie</h2>
<form method="post">
    <label>Nom :</label><br>
    <input type="text" name="nom" required><br><br>
    <label>Description</label><br>
    <textarea name="description" required></textarea><br><br>

    <button type="submit">Ajouter</button>
    <a href="lister.php">Annuler</a>
</form>

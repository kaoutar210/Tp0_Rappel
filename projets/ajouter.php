<?php
require_once('../db.php');
require_once('../classes/Projet.php');

$projet = new Projet($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';

    $projet->ajouter($titre, $description);

    header("Location: lister.php");
    exit();
}
?>

<h2>Ajouter un projet</h2>
<form method="post">
    <label>Titre :</label><br>
    <input type="text" name="titre" required><br><br>

    <label>Description :</label><br>
    <textarea name="description"></textarea><br><br>

    <button type="submit">Ajouter</button>
    <a href="lister.php">Annuler</a>
</form>

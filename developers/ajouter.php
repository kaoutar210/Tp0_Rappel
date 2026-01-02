<?php
require_once('../db.php');
require_once('../classes/Developer.php');

$developer = new Developer($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $image = null;

    if (!empty($_FILES['image']['name'])) {
        $imageName = time().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/'.$imageName);
        $image = $imageName;
    }

    $developer->ajouter($nom, $email, $image);
    header("Location: lister.php");
    exit();
}
?>

<h2>Ajouter un développeur</h2>

<form method="post" enctype="multipart/form-data">
    <label>Nom :</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <label>Image :</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit" class="btn btn-success">Ajouter</button>
    <a href="lister.php" class="btn btn-secondary">Annuler</a>
</form>

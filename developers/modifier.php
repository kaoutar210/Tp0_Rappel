<?php
require_once('../db.php');
require_once('../classes/Developer.php');

$developer = new Developer($pdo);

if (!isset($_GET['id']) || empty($_GET['id'])) die("ID manquant");
$id = (int) $_GET['id'];
$data = $developer->obtenirParId($id);
if (!$data) die("Développeur introuvable");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $image = $data['image'];

    if (!empty($_FILES['image']['name'])) {
        $imageName = time().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/'.$imageName);
        $image = $imageName;
    }

    $developer->modifier($id, $nom, $email, $image);
    header("Location: lister.php");
    exit();
}
?>

<h2>Modifier un développeur</h2>

<form method="post" enctype="multipart/form-data">
    <label>Nom :</label><br>
    <input type="text" name="nom" value="<?= htmlspecialchars($data['nom']) ?>" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required><br><br>

    <label>Image actuelle :</label><br>
    <?php if($data['image']): ?>
        <img src="../uploads/<?= htmlspecialchars($data['image']) ?>" width="100"><br>
    <?php endif; ?>

    <label>Changer l’image (optionnel) :</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit" class="btn btn-success">Modifier</button>
    <a href="lister.php" class="btn btn-secondary">Annuler</a>
</form>

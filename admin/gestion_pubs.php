<?php
session_start(); 
require('../config.php');
if (!isset($_SESSION["admin_id"])) header("Location: login.php");

// Ajouter pub
if (isset($_POST["ajouter"])) {
    $titre = $_POST["titre"];
    $image = $_POST["image"];
    $stmt = $conn->prepare("INSERT INTO pubs (titre, image) VALUES (?, ?)");
    $stmt->execute([$titre, $image]);
}

// Supprimer pub
if (isset($_GET["supprimer"])) {
    $id = $_GET["supprimer"];
    $conn->prepare("DELETE FROM pubs WHERE id=?")->execute([$id]);
}

// Liste
$pubs = $conn->query("SELECT * FROM pubs ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion pubs</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "includes/header.php"; ?>
<div class="container">
    <?php include "includes/sidebar.php"; ?>
    <main>
        <h2>📢 Gestion des Pubs</h2>
        <form method="post" class="form-add">
            <input type="text" name="titre" placeholder="Titre" required>
            <input type="text" name="image" placeholder="Lien image" required>
            <button type="submit" name="ajouter">Ajouter</button>
        </form>

        <table>
            <tr><th>ID</th><th>Titre</th><th>Image</th><th>Actions</th></tr>
            <?php foreach ($pubs as $pub): ?>
            <tr>
                <td><?= $pub["id"] ?></td>
                <td><?= $pub["titre"] ?></td>
                <td><img src="<?= $pub["image"] ?>" width="100"></td>
                <td>
                    <a href="?supprimer=<?= $pub["id"] ?>" class="btn-delete">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>


<?php
session_start(); 
require('../config.php');
if (!isset($_SESSION["admin_id"])) header("Location: login.php");

// Ajouter image
if (isset($_POST["ajouter"])) {
    $titre = $_POST["titre"];
    $image = $_POST["image"];
    $stmt = $conn->prepare("INSERT INTO galerie (titre, image) VALUES (?, ?)");
    $stmt->execute([$titre, $image]);
}

// Supprimer
if (isset($_GET["supprimer"])) {
    $id = $_GET["supprimer"];
    $conn->prepare("DELETE FROM galerie WHERE id=?")->execute([$id]);
}

// Liste
$galerie = $conn->query("SELECT * FROM galerie ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion Galerie</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "includes/header.php"; ?>
<div class="container">
    <?php include "includes/sidebar.php"; ?>
    <main>
        <h2>🖼️ Gestion de la galerie</h2>
        <form method="post" class="form-add">
            <input type="text" name="titre" placeholder="Titre">
            <input type="text" name="image" placeholder="Lien image" required>
            <button type="submit" name="ajouter">Ajouter</button>
        </form>

        <table>
            <tr><th>ID</th><th>Titre</th><th>Image</th><th>Actions</th></tr>
            <?php foreach ($galerie as $g): ?>
            <tr>
                <td><?= $g["id"] ?></td>
                <td><?= htmlspecialchars($g["titre"]) ?></td>
                <td><img src="<?= $g["image"] ?>" width="100"></td>
                <td>
                    <a href="?supprimer=<?= $g["id"] ?>" class="btn-delete">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>
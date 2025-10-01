<?php
session_start(); 
require('../config.php');
if (!isset($_SESSION["admin_id"])) header("Location: login.php");

// Changer statut
if (isset($_GET["approuver"])) {
    $id = $_GET["approuver"];
    $conn->prepare("UPDATE temoignages SET statut='approuve' WHERE id=?")->execute([$id]);
}

// Supprimer
if (isset($_GET["supprimer"])) {
    $id = $_GET["supprimer"];
    $conn->prepare("DELETE FROM temoignages WHERE id=?")->execute([$id]);
}

// Liste
$temoignages = $conn->query("SELECT * FROM temoignages ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion Témoignages</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "includes/header.php"; ?>
<div class="container">
    <?php include "includes/sidebar.php"; ?>
    <main>
        <h2>💬 Gestion des témoignages</h2>
        <table>
            <tr><th>ID</th><th>Nom</th><th>Message</th><th>Statut</th><th>Actions</th></tr>
            <?php foreach ($temoignages as $t): ?>
            <tr>
                <td><?= $t["id"] ?></td>
                <td><?= htmlspecialchars($t["nom"]) ?></td>
                <td><?= htmlspecialchars($t["message"]) ?></td>
                <td><?= $t["statut"] ?></td>
                <td>
                    <?php if ($t["statut"] === "en_attente"): ?>
                        <a href="?approuver=<?= $t["id"] ?>" class="btn">Approuver</a>
                    <?php endif; ?>
                    <a href="?supprimer=<?= $t["id"] ?>" class="btn-delete">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>



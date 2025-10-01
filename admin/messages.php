<?php
session_start(); 
require('../config.php');
if (!isset($_SESSION["admin_id"])) header("Location: login.php");

// Marquer comme lu
if (isset($_GET["lu"])) {
    $id = $_GET["lu"];
    $conn->prepare("UPDATE messages SET statut='lu' WHERE id=?")->execute([$id]);
}

// Supprimer
if (isset($_GET["supprimer"])) {
    $id = $_GET["supprimer"];
    $conn->prepare("DELETE FROM messages WHERE id=?")->execute([$id]);
}

// Liste
$messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Messages</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "includes/header.php"; ?>
<div class="container">
    <?php include "includes/sidebar.php"; ?>
    <main>
        <h2>📩 Messages de contact</h2>
        <table>
            <tr><th>ID</th><th>Nom</th><th>Email</th><th>Téléphone</th><th>Sujet</th><th>Message</th><th>Statut</th><th>Actions</th></tr>
            <?php foreach ($messages as $m): ?>
            <tr>
                <td><?= $m["id"] ?></td>
                <td><?= htmlspecialchars($m["nom"]) ?></td>
                <td><?= htmlspecialchars($m["email"]) ?></td>
                <td><?= htmlspecialchars($m["telephone"]) ?></td>
                <td><?= htmlspecialchars($m["sujet"]) ?></td>
                <td><?= nl2br(htmlspecialchars($m["message"])) ?></td>
                <td><?= $m["statut"] ?></td>
                <td>
                    <?php if ($m["statut"] === "non_lu"): ?>
                        <a href="?lu=<?= $m["id"] ?>" class="btn">Marquer comme lu</a>
                    <?php endif; ?>
                    <a href="?supprimer=<?= $m["id"] ?>" class="btn-delete">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>



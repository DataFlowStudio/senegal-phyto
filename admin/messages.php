<?php
session_start(); 
require('../config.php');
if (!isset($_SESSION["admin_id"])) header("Location: login.php");

// Marquer comme lu
if (isset($_GET["lu"])) {
    $id = $_GET["lu"];
    $conn->prepare("UPDATE messages SET statut='lu' WHERE id=?")->execute([$id]);
    header("Location: messages.php"); // évite le rechargement double
    exit;
}

// Supprimer
if (isset($_GET["supprimer"])) {
    $id = $_GET["supprimer"];
    $conn->prepare("DELETE FROM messages WHERE id=?")->execute([$id]);
    header("Location: messages.php");
    exit;
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
<!-- Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-family: Arial, sans-serif;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #4CAF50;
        color: white;
    }
    tr:nth-child(even) { background-color: #f9f9f9; }

    .action-icons a {
        margin: 0 6px;
        text-decoration: none;
        font-size: 18px;
        padding: 6px;
        border-radius: 6px;
        transition: background 0.2s ease;
    }
    .mark-read {
        color: #007bff;
    }
    .mark-read:hover {
        background: #e7f0ff;
    }
    .delete {
        color: #e74c3c;
    }
    .delete:hover {
        background: #fdecea;
    }
</style>
</head>
<body>
<?php include "includes/header.php"; ?>
<div class="container">
    <?php include "includes/sidebar.php"; ?>
    <main>
        <h2>📩 Messages de contact</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Sujet</th>
                <th>Message</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($messages as $m): ?>
            <tr>
                <td><?= $m["id"] ?></td>
                <td><?= htmlspecialchars($m["nom"]) ?></td>
                <td><?= htmlspecialchars($m["email"]) ?></td>
                <td><?= htmlspecialchars($m["telephone"]) ?></td>
                <td><?= htmlspecialchars($m["sujet"]) ?></td>
                <td><?= nl2br(htmlspecialchars($m["message"])) ?></td>
                <td><?= $m["statut"] === "non_lu" ? "📩 Non lu" : "✅ Lu" ?></td>
                <td class="action-icons">
                    <?php if ($m["statut"] === "non_lu"): ?>
                        <a href="?lu=<?= $m["id"] ?>" class="mark-read" title="Marquer comme lu">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </a>
                    <?php endif; ?>
                    <a href="?supprimer=<?= $m["id"] ?>" class="delete" title="Supprimer" onclick="return confirmDelete(event, <?= $m['id'] ?>)">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</div>
<?php include "includes/footer.php"; ?>

<script>
function confirmDelete(event, id) {
    event.preventDefault();
    if (confirm("⚠️ Voulez-vous vraiment supprimer ce message ?")) {
        window.location.href = "?supprimer=" + id;
    }
    return false;
}
</script>
</body>
</html>
